<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Processo;
use App\Models\User;
use Illuminate\Http\Request;
use Ddeboer\Imap\Server;
use Ddeboer\Imap\SearchExpression;
use Ddeboer\Imap\Search\Email\To;
use Ddeboer\Imap\Search\Text\Body;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;



class MailBoxController extends Controller
{
    private $server;
    private $serverOutlook;
    private $username;
    private $usernameOutlook;
    private $password;
    private $passwordOutlook;
    private $connection;
    private $connectionOutlook;
    private $mailbox;
    private $mailboxOutlook;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->server = new Server('imap.gmail.com');
        $this->serverOutlook = new Server('outlook.office365.com');

        $this->username = env('EMAIL', '');
        $this->password = env('PASSWORD', '');
        $this->usernameOutlook = env('EMAIL_OUTLOOK', '');
        $this->passwordOutlook = env('PASSWORD_OUTLOOK', '');

        // $connection is instance of \Ddeboer\Imap\Connection
        // $this->connection = $this->server->authenticate($this->username, $this->password);
        $this->connectionOutlook = $this->serverOutlook->authenticate($this->usernameOutlook, $this->passwordOutlook);

        //$this->mailbox = $this->connection->getMailbox('INBOX');
        $this->mailbox = $this->connectionOutlook->getMailbox('Inbox');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mailbox()
    {
        return view('mailbox');
    }

    public function emails()
    {
        $messages = collect($this->mailbox->getMessages(
            null,
            \SORTDATE,
            true));
        $messagesNumber = $messages->count();
        $perPage = 10;
        $page = request()->input('page', 1);
        $startIndex = ($page - 1) * $perPage;
        $endIndex = min($startIndex + $perPage, $messagesNumber);
        $batch = $messages->slice($startIndex, $endIndex - $startIndex)->values();
        $paginatedMessages = new LengthAwarePaginator($batch, $messagesNumber, $perPage, $page);
        return view('mailbox.emails', compact('paginatedMessages', 'messagesNumber'));
    }

    public function email($id)
    {
        $message = $this->mailbox->getMessage($id);
        $funcionarios = User::all();
        $departamentos = Departamento::all();

        $this->mailbox->setFlag('\\Seen', $id);
        $attachments = $message->getAttachments();

        return view('mailbox.email')->with(['message' => $message,
            'attachments' => $attachments,
            'funcionarios' => $funcionarios,
            'departamentos' => $departamentos
        ]);
    }


    public function emailsnew()
    {
        $search = new \Ddeboer\Imap\SearchExpression();
        $search->addCondition(new \Ddeboer\Imap\Search\Flag\UnSeen());
        $messages = collect($this->mailbox->getMessages(
            $search,
            \SORTDATE,
            true));
        $messagesNumber = $messages->count();
        $perPage = 10;
        $page = request()->input('page', 1);
        $startIndex = ($page - 1) * $perPage;
        $endIndex = min($startIndex + $perPage, $messagesNumber);
        $batch = $messages->slice($startIndex, $endIndex - $startIndex)->values();
        $paginatedMessages = new LengthAwarePaginator($batch, $messagesNumber, $perPage, $page);
        return view('mailbox.emails', compact('paginatedMessages', 'messagesNumber'));
    }


    public function emailsseen()
    {
        $search = new \Ddeboer\Imap\SearchExpression();
        $search->addCondition(new \Ddeboer\Imap\Search\Flag\Seen());
        $messages = collect($this->mailbox->getMessages(
            $search,
            \SORTDATE,
            true));
        $messagesNumber = $messages->count();
        $perPage = 10;
        $page = request()->input('page', 1);
        $startIndex = ($page - 1) * $perPage;
        $endIndex = min($startIndex + $perPage, $messagesNumber);
        $batch = $messages->slice($startIndex, $endIndex - $startIndex)->values();
        $paginatedMessages = new LengthAwarePaginator($batch, $messagesNumber, $perPage, $page);
        return view('mailbox.emails', compact('paginatedMessages', 'messagesNumber'));
    }

    public function emailsSearch($email = null)
    {
        $search = new SearchExpression();

        if ($email == null) {
            $messages = $this->mailbox->getMessages(
                null,
                \SORTDATE, // Sort criteria
                true // Descending order
            );
        } else {

            $search->addCondition(new Body($email));

            $messages = $this->mailbox->getMessages($search);
            dd($messages);
        }

        $messagesNumber = $messages->count();

        return view('mailbox.emailsSearch')->with(['messages' => $messages,
            'messagesNumber' => $messagesNumber
        ]);
    }



    public function emailsasseen($id)
    {
        $this->mailbox->setFlag('\\Seen', $id);
        return view('mailbox');
    }

    public function emailsasnotseen($id)
    {
        $this->mailbox->clearFlag('\\Seen', $id);
        return view('mailbox');
    }

    public function openAttachment(Request $request)
    {
        $email = $this->mailbox->getMessage($request->message_number);
        // retrieve attachment by filename
        $filename = $request->input('filename');
        $attachments = $email->getAttachments();
        foreach ($attachments as $attachment) {
            if ($attachment->getFilename() === $filename) {
                $path_parts = pathinfo($attachment->getFilename());
                $extension = $path_parts['extension'];
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    return '<img src="data:image/' . $extension . ';base64,' . base64_encode($attachment->getDecodedContent()) . '" />';
                } elseif (in_array($extension, ['pdf'])) {
                    return response()->streamDownload(function () use ($attachment) {
                        echo $attachment->getDecodedContent();
                    }, $attachment->getFilename(), ['Content-Type' => $attachment->getType()]);
                } elseif (in_array($extension, ['mp3', 'ogg', 'wav'])) {
                    return '<audio controls><source src="data:audio/' . $extension . ';base64,' . base64_encode($attachment->getDecodedContent()) . '"></audio>';
                } elseif (in_array($extension, ['mp4', 'mkv', 'webm'])) {
                    return '<video width="320" height="240" controls><source src="data:video/' . $extension . ';base64,' . base64_encode($attachment->getDecodedContent()) . '"></video>';
                } else {
                    // you can use Google Drive viewer to preview different file types
                    return '<iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=' . url('/attachment/open/' . $filename) . '" width="800" height="600"></iframe>';
                }
            }
        }
        //if attachment not found
        return response()->json(['error' => 'Attachment not found'], 404);
    }

    public function employees(Request $request)
    {
        $employees = User::where('departamento_id', $request->departamento_id)->get();
        return response()->json($employees);
    }
}

