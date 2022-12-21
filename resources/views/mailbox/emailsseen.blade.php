<div class="table-responsive mailbox-messages">
    <table class="table table-hover">
        <tbody>
        <tr>
            <td>id</td>
            <td>Email</td>
            <td>Subject</td>
            <td>content</td>
            <td>date</td>
        </tr>
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

                @foreach ($messages as $message)

                    <tr>
                        <td>
                            {{$message->getNumber()}}

                        </td>
                        <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a>
                        </td>
                        <td class="mailbox-name"><a style="cursor:pointer;" class="readEmail"
                                                    data-id="{{$message->getNumber()}}">
                                {{$message->getFrom()->getAddress()}}
                            </a></td>
                        <td class="mailbox-subject"><b>
                                {{$message->getSubject()}}
                            </b>

                        </td>
                        <td class="mailbox-date">
                            {{$message->getDate()->format('d/m/Y')}}
                        </td>
                    </tr>
        @endforeach
        </tbody>
    </table>
</div>
