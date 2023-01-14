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
        $this->passwordOutlook = ENV('PASSWORD_OUTLOOK', '');

        // $connection is instance of \Ddeboer\Imap\Connection
        $this->connection = $this->server->authenticate($this->username, $this->password);
        $this->connectionOutlook = $this->serverOutlook->authenticate($this->usernameOutlook, $this->passwordOutlook);

        $this->mailbox = $this->connection->getMailbox('INBOX');
        $this->mailboxOutlook = $this->connectionOutlook->getMailbox('Inbox');
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
        $paginatedMessages = $messages->slice(($page - 1) * $perPage, $perPage)->values();
        $paginatedMessages = new LengthAwarePaginator($paginatedMessages, $messagesNumber, $perPage, $page);
        return view('mailbox.emails', compact('paginatedMessages', 'messagesNumber'));
    }

    public function emailsnew()
    {

        $messages = $this->mailbox->getMessages(
            null,
            \SORTDATE, // Sort criteria
            true // Descending order
        );

        $messagesNumber = $messages->count();

        return view('mailbox.emailsnew')->with(['messages' => $messages,
            'messagesNumber' => $messagesNumber
        ]);
    }

    public function emailsseen()
    {

        $messages = $this->mailbox->getMessages(
            null,
            \SORTDATE, // Sort criteria
            true // Descending order
        );

        $messagesNumber = $messages->count();

        return view('mailbox.emailsseen')->with(['messages' => $messages,
            'messagesNumber' => $messagesNumber
        ]);
    }


    public function emailsSearch($email = null)
    {
        // dd($email);
        if ($email == null) {
            $messages = $this->mailbox->getMessages(
                null,
                \SORTDATE, // Sort criteria
                true // Descending order
            );
        } else {
            $search = new SearchExpression();

            $search->addCondition(new To($email));

            $messages = $this->mailbox->getMessages($search);
        }

        $messagesNumber = $messages->count();

        return view('mailbox.emailsSearch')->with(['messages' => $messages,
            'messagesNumber' => $messagesNumber
        ]);
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

    public function downloadAttachment(Request $request)
    {
        $emailId = $request->input('email_id');
        $attachmentContent = $request->input('attachment_content');
        $path = '/my/local/dir/';
        $message = $this->mailbox->getMessage($emailId);
        $attachments = $message->getAttachments();
        foreach ($attachments as $attachment) {
            if ($attachment->getParent()->getId() == $emailId && $attachment->getDecodedContent() == $attachmentContent) {
                $filename = $attachment->getFilename();
                file_put_contents($path . $filename, $attachment->getDecodedContent());
                return response()->download($path . $filename, $filename);
            }
        }
    }
}

