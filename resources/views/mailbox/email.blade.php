<div class="col-md-12">
    <div class="card card-primary card-outline">
        <h5 class="card-header">
            Remetente: {{$message->getFrom()->getAddress()}}
        </h5>
        <div class="card-body p-0">
            <div class="mailbox-read-info">
                <h5> Assunto: {{$message->getSubject()}}</h5>
                <span class="mailbox-read-time float-right"> {{$message->getDate()->format('d/m/Y')}}</span></h6>
            </div>
        </div>

        <div class="mailbox-read-message">
            <h5>Conteudo: </h5>
            <p> {{$message->getBodyText()}}</p>
        </div>
    </div>

    <div class="card-footer bg-white">
        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
            <li>
                <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> Sep2014-report.pdf</a>
                    <span class="mailbox-attachment-size clearfix mt-1">
    <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
    </span>
                </div>
            </li>
        </ul>
    </div>
</div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Criar
    Processo
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Nome:</label>
                        <input type="text" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Descrição:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Funcionário</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option selected>Default</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Departamento</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option selected>Default</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Remetente:</label>
                        <input type="text" class="form-control" id="recipient-name" placeholder="{{$message->getFrom()->getAddress()}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Assunto: </label>
                        <textarea class="form-control" id="message-text" placeholder="{{$message->getSubject()}}" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Conteudo: </label>
                        <textarea class="form-control" id="message-text"placeholder="{{$message->getBodyText()}}" disabled></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.2.min.js"
        integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script>
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    });

</script>
