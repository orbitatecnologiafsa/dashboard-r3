@extends('tamplate.main')

@section('titulo', 'Adm- Lista clientes')
@section('ativo-lista', 'active')
@section('caminho', 'Menu')
@section('atual-page', 'Lista cliente')
@push('sidbar')
    @include('adm.partial.sidbar')
@endpush
@push('navbar')
    @include('adm.partial.navbar')
@endpush

@section('conteudo')

    <div class="container-fluid py-4" style="bottom: 100px;">
        @include('adm.partial.info_nav')
        <div class="row">


            @if (count($users) > 0)
                {{-- <form method="get" action=>
                    <div class="card" style="margin-top: 100px;">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">Buscar cliente</h6>
                            </div>
                        </div>
                        <div class="col-md-5 pb-0 p-3">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <input class="form-control form-control-alternative" name="busca_cliente"
                                        value="{{ request()->input('busca_cliente') ?? old('busca_cliente') }}"
                                        placeholder="Nome do cliente ou cnpj" type="text">

                                </div>
                            </div>
                            @error('busca_cliente')
                                <div class="error " style="color:red">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5 pb-0 p-3 me-2">
                            <div class="form-group">
                                <button class=" btn btn-primary  active">Buscar</button>
                                <a href="{{ route('adm-lista-cliente') }}" class="btn btn-warning  active">
                                    Atualizar lista</a>
                            </div>
                        </div>
                    </div>
                </form> --}}
                <div class="card" style="margin-top: 50px;">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Lista de usuarios</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" style="overflow: auto;">
                            <thead>
                                <tr>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Codigo
                                        id
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nome</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        CNPJ</th>

                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Historico</th> --}}
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        {{-- <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('/img/img-default.png') }}"
                                                    class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">Id</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $item->id }}</p>
                                            </div>
                                        </div>
                                    </td> --}}
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Id
                                            </p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->id }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Nome
                                            </p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->nome_filial }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Cnpj</p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->cnpj }}</p>
                                        </td>


                                        {{-- <td>
                                    <p class="text-xs font-weight-bold mb-0">Historico</p>
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $item->historico }}</p>
                                </td> --}}
                                        {{-- <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                            </td> --}}
                                        <td class="align-middle">
                                            <a href="{{ route('adm-cliente-detalhes', $item->id) }}"
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Edit user">
                                                Detalhes
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('adm-delete-cliente', $item->id) }}"
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Deletar user">
                                                Deletar clienter
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex me-2 justify-content-center mt-5">
                        {!! $users->links() !!}
                        {{-- {{ $users->appends(['data_inicio' => request()->input('data_inicio'), 'data_fim' => request()->input('data_fim')])->links() }} --}}
                    </div>
                </div>
            @else
                <p style="margin-top:200px;" class="text-center justfy-content-center">Não existem registros para serem
                    exbidos!
                </p>
            @endif
        </div>

        @include('tamplate.footer')
    </div>

@endsection
