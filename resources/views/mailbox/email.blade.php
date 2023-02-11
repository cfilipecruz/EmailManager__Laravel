<button type="button" class="btn btn-primary mt-2 mb-2 flex btn-block col-md-12" data-toggle="modal"
        data-target="#exampleModal" data-whatever="@mdo">Criar novo processo a partir deste e-mail
</button>

<div class="col-md-12">
    <div class="card border-primary">
        <div class="card-header bg-secondary text-white">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">{{$message->getSubject()}}</h5>
                <div class="ml-auto">
                    <p class=" mb-0">{{$message->getDate()->format('d/m/Y')}}</p>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <h5 class="mb-3">De: {{$message->getFrom()->getAddress()}}</h5>
            <hr>
            <h5>Conteúdo:</h5>
            <p class="mb-0">{!! $message->getBodyHtml() !!}</p>
        </div>
    </div>
    @if ($attachments != null)
        <div class="card-footer bg-white">
            <ul class="mailbox-attachments d-flex align-items-stretch clearfix"
                style=" display: flex; flex-wrap: wrap;">
                @foreach ($attachments as $attachment)
                    <li style="cursor: pointer; width: 150px; margin: 10px; text-align: center;"
                        class="d-flex align-items-center"
                        onclick="event.preventDefault(); document.getElementById('openAttachmentForm{{$loop->index}}').submit();">
                        <form method="POST" action="{{route('attachment.open')}}"
                              id="openAttachmentForm{{$loop->index}}">
                            @csrf
                            <input type="hidden" name="filename" value="{{$attachment->getFilename()}}">
                            <input type="hidden" name="message_number" value="{{$message->getNumber()}}">
                            @php
                                $path_parts = pathinfo($attachment->getFilename());
                                $extension = $path_parts['extension'];
                                switch ($extension) {
                                  case 'jpg':
                                  case 'jpeg':
                                  case 'png':
                                  case 'gif':
                                    echo '<span class="mailbox-attachment-icon mr-3"><img src="data:image/'.$extension.';base64, '.base64_encode($attachment->getDecodedContent()).'" width="50" height="50"/></span>';
                                    break;
                                  case 'pdf':
                                    echo '<span class="mailbox-attachment-icon mr-3"><i class="far fa-file-pdf"></i></span>';
                                    break;
                                  case 'mp4':
                                    echo '<span class="mailbox-attachment-icon mr-3"><i class="fas fa-file-video"></i></span>';
                                    break;
                                  case 'mp3':
                                    echo '<span class="mailbox-attachment-icon mr-3"><i class="fas fa-file-audio"></i></span>';
                                    break;
                                  default:
                                    echo '<span class="mailbox-attachment-icon mr-3"><i class="far fa-file"></i></span>';
                                    break;
                                }
                            @endphp
                            <p style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 120px;">{{ $attachment->getFilename() }}</p>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Novo Processo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('meusprocessos.save')}}">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label"> Nome:</label>
                        <input name="nome" type="text" class="form-control" value="" placeholder="Nome" id="nome"
                               required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"> Descrição:</label>
                        <textarea name="descricao" class="form-control" value="" id="descricao" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Departamento</label>
                        <select name="departamento" id="departamento" class="custom-select form-control"
                                aria-label="Default select example" required>
                            <option value="" selected>Selecionar Departamento</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Funcionário</label>
                        <select name="funcionario" id="employee" class="custom-select form-control"
                                aria-label="Default select example" required>
                            <option value="">Selecionar Funcionário</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Remetente:</label>
                        <input name="emailremetente" type="email" class="form-control" id="recipient-name"
                               value="{{$message->getFrom()->getAddress()}}"
                               placeholder="{{$message->getFrom()->getAddress()}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Assunto: </label>
                        <input name="assunto" class="form-control"
                               value="{{$message->getSubject()}}" placeholder="{{$message->getSubject()}}"
                               readonly>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Conteudo: </label>
                        <textarea name="desenvolvimento" class="form-control" id="message-text"
                                  value="{{$message->getBodyText()}}"
                                  readonly>{{$message->getBodyText()}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Criar Processo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<!--<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
    })
</script>-->

<script>
    $(document).ready(function () {
        $('#departamento').on('change', function () {
            let departmentId = $(this).val();
            $.ajax({
                url: "{{ route('employees') }}",
                type: 'GET',
                data: {departamento_id: departmentId},
                success: function (data) {
                    let employeeSelect = $('#employee');
                    employeeSelect.empty();
                    employeeSelect.append('<option value="">Selecionar Funcionário</option>');
                    $.each(data, function (index, employee) {
                        employeeSelect.append('<option value="' + employee.id + '">' + employee.username + '</option>');
                    });
                }
            });
        });
    });
</script>







