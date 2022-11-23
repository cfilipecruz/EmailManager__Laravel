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
    if ($mailbox->getAttributes() & \LATT_NOSELECT) {
        continue;
    }

    // $mailbox is instance of \Ddeboer\Imap\Mailbox
   // printf('Mailbox "%s" has %s messages', $mailbox->getName(), $mailbox->count());
}
    $messages = $mailbox->getMessages();
    /*$messages = $mailbox->getMessages(
    new Ddeboer\Imap\Search\Date\Since($thirtyDaysAgo),
    \SORTDATE, // Sort criteria
    true // Descending order*/  
?>

 @section('content')
    <div class="row">
        <div class="col-md-3">
            <section class="content-header">
                <h1>
                    Mailbox
                    <small>13 new messages</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Mailbox</li>
                </ol>
            </section>
            <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Folders</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox
                                <span class="label label-primary pull-right">12</span></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                        <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                        <li><a href="#"><i class="fa fa-filter"></i> Junk <span
                                    class="label label-warning pull-right">65</span></a>
                        </li>
                        <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
                    </ul>
                </div>

            </div>

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Labels</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
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
                        <table class="table table-hover table-striped">

                           <?php foreach ($messages as $message) {
                            echo '
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false"
                                            style="position: relative;"><input type="checkbox"
                                                style="position: absolute; opacity: 0;"><ins class="iCheck-helper"
                                                style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                        </div>
                                    </td>
                                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a>
                                    </td>
                                    <td class="mailbox-name"><a href="read-mail.html">'./*$message->getFrom().*/'</a></td>
                                    <td class="mailbox-subject"><b>'.$message->getSubject().'</b> '.$message->getSubject().'
                                    </td>
                                    <td class="mailbox-attachment"></td>
                                    <td class="mailbox-date">'./*$message->getDate().*/'</td>
                                </tr>
                            </tbody>
                            ';
                        };
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

<?php
$mailboxes = $connection->getMailboxes();

/*foreach ($mailboxes as $mailbox) {
    // Skip container-only mailboxes
    // @see https://secure.php.net/manual/en/function.imap-getmailboxes.php
    if ($mailbox->getAttributes() & \LATT_NOSELECT) {
        continue;
    }

    // $mailbox is instance of \Ddeboer\Imap\Mailbox
    printf('Mailbox "%s" has %s messages', $mailbox->getName(), $mailbox->count());
}*/
?>
