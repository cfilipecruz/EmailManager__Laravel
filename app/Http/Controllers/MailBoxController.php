<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ddeboer\Imap\Server;
use Ddeboer\Imap\SearchExpression;
use Ddeboer\Imap\Search\Email\To;
use Ddeboer\Imap\Search\Text\Body;

class MailBoxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $server = new Server('imap.gmail.com');

        $username = env('EMAIL','');
        $password = ENV('PASSWORD','');

        // $connection is instance of \Ddeboer\Imap\Connection
        $connection = $server->authenticate($username, $password);

        $mailbox = $connection->getMailbox('INBOX');

        $messages = $mailbox->getMessages(
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
        $server = new Server('imap.gmail.com');

        $username = env('EMAIL','');
        $password = ENV('PASSWORD','');

        // $connection is instance of \Ddeboer\Imap\Connection
        $connection = $server->authenticate($username, $password);

        $mailbox = $connection->getMailbox('INBOX');

        $messages = $mailbox->getMessages(
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
        $server = new Server('imap.gmail.com');

        $username = env('EMAIL','');
        $password = ENV('PASSWORD','');

        // $connection is instance of \Ddeboer\Imap\Connection
        $connection = $server->authenticate($username, $password);

        $mailbox = $connection->getMailbox('INBOX');

        $messages = $mailbox->getMessages(
            null,
            \SORTDATE, // Sort criteria
            true // Descending order
        );

        $messagesNumber=$messages->count();

        return view('mailbox.emailsseen')->with(['messages'=>$messages,
            'messagesNumber'=>$messagesNumber
        ]);
    }


    public function emailssearch(){
        $server = new Server('imap.gmail.com');

        $username = env('EMAIL','');
        $password = ENV('PASSWORD','');

        // $connection is instance of \Ddeboer\Imap\Connection
        $connection = $server->authenticate($username, $password);

        $mailbox = $connection->getMailbox('INBOX');

        $search = new SearchExpression();

        $search->addCondition(new To('me@here.com'));
        $search->addCondition(new Body('contents'));

        $messages = $mailbox->getMessages($search);

        $messagesNumber=$messages->count();

        return view('mailbox.emailssearch')->with(['messages'=>$messages,
            'messagesNumber'=>$messagesNumber
        ]);
    }

    public function email($id){
        $server = new Server('imap.gmail.com');

        $username = env('EMAIL','');
        $password = ENV('PASSWORD','');

        // $connection is instance of \Ddeboer\Imap\Connection
        $connection = $server->authenticate($username, $password);

        $mailbox = $connection->getMailbox('INBOX');
        $message =  $mailbox->getMessage($id);

        return view('mailbox.email')->with(['message'=>$message]);
    }
}





