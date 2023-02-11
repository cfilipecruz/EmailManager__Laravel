<div class="table-responsive mailbox-messages">
    <table class="table table-hover">
        <tbody>
        <tr>
            <td>ID</td>
            <td>Estado</td>
            <td>Email</td>
            <td>Assunto</td>
            <td>Data</td>
        </tr>
        <div class="box box-primary">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-secondary">Caixa de Entrada</h3>
            </div>
        </div>
        @foreach($paginatedMessages as $message)
            @if(!$message->isSeen())
                <tr class="list-group-item-action">
                    <td>
                        {{$message->getNumber()}}
                    </td>
                    <td>
                        <a data-id="{{$message->getNumber()}}"  style="cursor:pointer;" class="markasseen text-dark"
                           data-toggle="tooltip" data-html="true" title="Marcar Lido">
                            <i class="far fa-envelope"></i> </a>
                    </td>
                    <td class="mailbox-name">
                        <a style="cursor:pointer;" class="readEmail"
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
                        <a data-id="{{$message->getNumber()}}" style="cursor:pointer;" class="markasnotseen text-white"
                           data-toggle="tooltip" data-html="true" title="Marcar como não Lido">
                            <i class="far fa-envelope-open"></i> </a>
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

<div class="container mt-5" >
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item
                        @if($paginatedMessages->currentPage() === 1)
                            disabled
                        @endif
                        ">
                        <a class="page-link changePage" style="cursor:pointer" data-href="{{ url()->current() }}?page={{ $paginatedMessages->currentPage() - 1 }}" tabindex="-1">Previous</a>
                    </li>

                    @for($i = 1; $i <= $paginatedMessages->lastPage(); $i++)
                        <li class="page-item
                            @if($i === $paginatedMessages->currentPage())
                                active
                            @endif
                            ">
                            <a class="page-link changePage" style="cursor:pointer" data-href="{{ url()->current() }}?page={{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <li class="page-item
                        @if($paginatedMessages->currentPage() === $paginatedMessages->lastPage())
                            disabled
                        @endif
                        ">
                        <a  class="page-link changePage" style="cursor:pointer" data-href="{{ url()->current() }}?page={{ $paginatedMessages->currentPage() + 1 }}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>



