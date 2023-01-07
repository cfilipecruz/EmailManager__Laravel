<table class="table">
    <caption>Lista de processos</caption>
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Criado</th>
        <th scope="col">Alterado</th>
        <th scope="col">Departamento</th>
    </tr>
    </thead>
    <tbody>
    @foreach($processos as $processo)
        @if($processo->estado_id == 5)
            <tr class="bg-success">
                <td scope="row"> <a style="cursor:pointer;" class="readProcesso text-white" data-id="{{$processo->id}}"> {{$processo->id}}</a> </td>
                <td><a style="cursor:pointer;" class="readProcesso text-white" data-id="{{$processo->id}}">{{$processo->nome}}</a> </td>
                <td>{{$processo->created_at}}</td>
                <td>{{$processo->updated_at}}</td>
                <td>{{$processo->departamento->nome}}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
