@extends('tamplate.main')

@section('titulo', 'Adm- Lista Lojas')
@section('ativo-lista-loja', 'active')
@section('caminho', 'Menu')
@section('atual-page', 'Lista lojas')
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


            @if (count($lojas) > 0)
                <div class="card" style="margin-top: 100px;">
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
                                        Nome Loja</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        CNPJ Loja</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Loja CNPJ cliente</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nome Cliente</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        CNPJ Cliente</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        ID cliente</th>

                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Historico</th> --}}
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lojas as $item)
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
                                            <p class="text-xs text-secondary mb-0">{{ $item->loja_id }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Nome Loja
                                            </p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->nome_loja }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Cnpj Loja</p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->cnpj_loja }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Loja Cnpj Cliente</p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->cnpj_cliente }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Nome cliente</p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->u_nome_filial }}</p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Cnpj Cliente</p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->u_cnpj }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">ID Cliente</p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->u_id_cli }}</p>
                                        </td>


                                        {{-- <td>
                                    <p class="text-xs font-weight-bold mb-0">Historico</p>
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $item->historico }}</p>
                                </td> --}}
                                        {{-- <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                            </td> --}}
                                        {{-- <td class="align-middle">
                                            <a href="{{ route('adm-cliente-detalhes', $item->id) }}"
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Edit user">
                                                Detalhes
                                            </a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex me-2 justify-content-center mt-5">
                        {!! $lojas->links() !!}
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
