@if( Auth::user()->nivelpermissao_id == 1)
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Identificador</th>
            <th scope="col">Criado a:</th>
        </tr>
        </thead>
        <tbody>
        @foreach($departamentos as $departamento)
            <tr>
                <th scope="row">{{$departamento->id}}</th>
                <td>
                    <a style="cursor:pointer;" class="verDepartamento"
                       data-id="{{$departamento->id}}"> {{$departamento->nome}}
                    </a>
                </td>
                <td>{{$departamento->identificador}}</td>
                <td>{{$departamento->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif







