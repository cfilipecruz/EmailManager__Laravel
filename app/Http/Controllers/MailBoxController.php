<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\User;
use Illuminate\Http\Request;
use Ddeboer\Imap\Server;
use Ddeboer\Imap\SearchExpression;
use Ddeboer\Imap\Search\Email\To;
use Ddeboer\Imap\Search\Text\Body;


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
        $this->server =  new Server('imap.gmail.com');
        $this->serverOutlook = new Server('outlook.office365.com');

        $this->username =   env('EMAIL','');
        $this->password =   env('PASSWORD','');
        $this->usernameOutlook = env('EMAIL_OUTLOOK', '');
        $this->passwordOutlook = ENV('PASSWORD_OUTLOOK', '');

        // $connection is instance of \Ddeboer\Imap\Connection
        $this->connection =  $this->server->authenticate($this->username, $this->password);
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

    public function emails(){

        $messages = $this->mailbox->getMessages(
            null,
            \SORTDATE, // Sort criteria
            true // Descending order
        );

        $messagesNumber=$messages->count();

        return view('mailbox.emails')->with(['messages'=>$messages,
                                      'messagesNumber'=>$messagesNumber
                                        ]);
    }

    public function emailsnew(){

        $messages = $this->mailbox->getMessages(
            null,
            \SORTDATE, // Sort criteria
            true // Descending order
        );

        $messagesNumber=$messages->count();

        return view('mailbox.emailsnew')->with(['messages'=>$messages,
            'messagesNumber'=>$messagesNumber
        ]);
    }

    public function emailsseen(){

        $messages = $this->mailbox->getMessages(
            null,
            \SORTDATE, // Sort criteria
            true // Descending order
        );

        $messagesNumber=$messages->count();

        return view('mailbox.emailsseen')->with(['messages'=>$messages,
            'messagesNumber'=>$messagesNumber
        ]);
    }


    public function emailssearch($name){

        $search = new SearchExpression();

        $search->addCondition(new To('me@here.com'));
        $search->addCondition(new Body('contents'));

        $messages = $this->mailbox->getMessages($search);

        $messagesNumber=$messages->count();

        return view('mailbox.emailssearch')->with(['messages'=>$messages,
            'messagesNumber'=>$messagesNumber
        ]);
    }

    public function email($id){

        $message =  $this->mailbox->getMessage($id);
        $funcionarios = User::all();
        $departamentos = Departamento::all();
        $this->mailbox->setFlag('\\Seen', $id);
        $attachments = $message->getAttachments();

        return view('mailbox.email')->with(['message'=>$message,
                                                'attachments'=>$attachments,
                                                'funcionarios'=>$funcionarios,
                                                'departamentos'=>$departamentos
        ]);
    }
}





