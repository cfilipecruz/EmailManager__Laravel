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

$username = 'mailmanagerprojeto@gmail.com';
$password = 'affjbedmncgcdrsl';

// $connection is instance of \Ddeboer\Imap\Connection
$connection = $server->authenticate($username, $password);

$mailboxes = $connection->getMailboxes();

foreach ($mailboxes as $mailbox) {
    // Skip container-only mailboxes
    // @see https://secure.php.net/manual/en/function.imap-getmailboxes.php
    if ($mailbox->getAttributes()) {
        continue;
    }

    // $mailbox is instance of \Ddeboer\Imap\Mailbox
    // printf('Mailbox "%s" has %s messages', $mailbox->getName(), $mailbox->count());
}
$today = new DateTimeImmutable();
$TwoYearsAgo = $today->sub(new DateInterval('P2Y'));

$messages = $mailbox->getMessages(
    new Ddeboer\Imap\Search\Date\Since($TwoYearsAgo),
    \SORTDATE, // Sort criteria
    true // Descending order
);

foreach ($messages as $message) {
}
$number = $message->getNumber();
$numberOfmessages = 0;
$maxMessagesPerPage = 10;
?>

@section('content')
    <div class="row m-1 mt-3">
        <div class="col-md-3">
            <a href="compose.html" class="btn btn-primary btn-block mb-3">Refresh Emails</a>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Folders</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                <i class="far fa-envelope"></i> New
                                <span class="badge bg-primary float-right"><?php 
                                      foreach ($mailboxes as $mailbox) {
                                    // Skip container-only mailboxes
                                    // @see https://secure.php.net/manual/en/function.imap-getmailboxes.php
                                    if ($mailbox->getAttributes() & \LATT_MARKED) {
                                        continue;
                                    }
                                
                                    // $mailbox is instance of \Ddeboer\Imap\Mailbox
                                    
                                }
                                printf($mailbox->count());
                                     ?> </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-envelope-open"></i> Seen
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Labels</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle text-danger"></i>
                                Important
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle text-warning"></i> Promotions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle text-primary"></i>
                                Social
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Inbox</h3>
                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input type="text" class="form-control input-sm" placeholder="Search Mail">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>

                </div>
                <div class="box-body no-padding">
                    <div class="mailbox-controls">

                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                        </div>

                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                        <div class="pull-right">
                            1-50/200
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm"><i
                                        class="fa fa-chevron-left"></i></button>
                                <button type="button" class="btn btn-default btn-sm"><i
                                        class="fa fa-chevron-right"></i></button>
                            </div>

                        </div>

                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td>read</td>
                                    <td>Email</td>
                                    <td>Subject</td>
                                    <td>content</td>
                                    <td>date</td>
                                </tr>
                                <?php
                                
                                foreach ($messages as $message) {
                                    $numberOfmessages++;

                                    if ($numberOfmessages <= $maxMessagesPerPage) {
                                        // $id = $message->getId();
                                        $number = $message->getNumber();
                                        echo '
                                                                                            
                                                                                            <tr>
                                                                                               
                                                                                            <td>
                                                                                                ' .
                                            $number .
                                            '
                                                                                            </td>
                                                                                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a>
                                                                                            </td>
                                                                                            <td class="mailbox-name"><a href="read-mail.html">' .
                                            $message->getFrom()->getAddress() .
                                            '</a></td>
                                                                                            <td class="mailbox-subject"><b>' .
                                            $message->getSubject() .
                                            '</b> ' .
                                            $message->getSubject() .
                                            '
                                                                                            </td>
                                                                                            <td class="mailbox-date">' .
                                            $message->getDate()->format('d/m/Y') .
                                            '</td>
                                                                                                </tr>
                                                                                                                                    
                                                                                        ';
                                    }
                                }
                              
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
