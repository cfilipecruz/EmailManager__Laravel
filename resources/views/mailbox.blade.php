@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<!--{{ __('You are logged in!') }}-->

@extends('adminlte::page')

@section('title', 'Dashboard')

<?php
    use Ddeboer\Imap\Server;

    $server = new Server('imap.gmail.com');

    // $connection is instance of \Ddeboer\Imap\Connection
    $connection = $server->authenticate('mailmanagerprojeto@gmail.com', 'Carlos100..');

    
/* // Run the method list which will return the list of messages 
    $list = $gmail->users_messages->listUsersMessages('me');

    // Get the actual list 
    $messageList = $list->getMessages();

    // Create array where we will store our messages
    $messages = array();

    // iterate over all the elements retrieved by the method list
    foreach($messageList as $msg){

        // GET individual message
        $message = $gmail->users_messages->get('me',$msg->id);
        
        // Push the element into our array of messages
        array_push($messages,);
    }*/
$mailboxes = $connection->getMailboxes();

foreach ($mailboxes as $mailbox) {
    // Skip container-only mailboxes
    // @see https://secure.php.net/manual/en/function.imap-getmailboxes.php
    if ($mailbox->getAttributes() & \LATT_NOSELECT) {
        continue;
    }

    // $mailbox is instance of \Ddeboer\Imap\Mailbox
    printf('Mailbox "%s" has %s messages', $mailbox->getName(), $mailbox->count());
}
?>
