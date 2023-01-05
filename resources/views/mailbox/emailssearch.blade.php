<div class="table-responsive mailbox-messages">
    <table class="table table-hover">
        <tbody>
        <tr>
            <td>id</td>
            <td>status</td>
            <td>Email</td>
            <td>Subject</td>
            <td>date</td>
        </tr>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Inbox</h3>
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
        </div>
        @foreach ($messages as $message)
            @if(!$message->isSeen())
                <tr class="list-group-item-action">
                    <td>
                        {{$message->getNumber()}}
                    </td>
                    <td>
                        <i style="cursor: pointer;" class="far fa-envelope"></i>
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
            @endif
            @if($message->isSeen())
                <tr class="bg-secondary text-white list-group-item-action">
                    <td>
                        {{$message->getNumber()}}
                    </td>
                    <td>
                        <i style="cursor: pointer;" class="far fa-envelope-open"></i>
                    </td>
                    <td class="mailbox-name text-white"><a style="cursor:pointer;" class="readEmail text-white"
                                                           data-id="{{$message->getNumber()}}">
                            {{$message->getFrom()->getAddress()}}
                        </a>
                    </td>
                    <td class="mailbox-subject"><b>
                            {{$message->getSubject()}}
                        </b>
                    </td>
                    <td class="mailbox-date">
                        {{$message->getDate()->format('d/m/Y')}}
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
