<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Departamento</th>
    </tr>
    </thead>
    <tbody>
    @foreach($funcionarios as $funcionario)

    <tr class="list-group-item-action">
        <th scope="row">{{$funcionario->id}}</th>
        <td><a style="cursor:pointer;" class="verFuncionario"
               data-id="{{$funcionario->id}}">
                {{$funcionario->name}}
            </a></td>
        <td>{{$funcionario->email}}</td>
        <td>{{$funcionario->departamento_id}}</td>
    </tr>
    @endforeach
    </tbody>
</table>


