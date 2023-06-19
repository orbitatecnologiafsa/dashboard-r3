@extends('tamplate.main')
@section('ativo-caixa', 'active')
@section('titulo', 'Caixa - detalhes')
@section('caminho', 'Menu')
@section('atual-page', 'Caixa - detalhes')
@push('sidbar')
    @include('usuario.partial.sidbar')
@endpush
@push('navbar')
    @include('usuario.partial.navbar')
@endpush
@section('conteudo')
    <div class="container-fluid py-4" style="bottom: 100px;">

        @include('usuario.partial.nav_info_caixa')

        <div class="card" style="margin-top: 100px;">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-2">Detalhes</h6>
                </div>
            </div>

            <div class="col-md-8 pb-0 p-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            Codigo : {{ $caixa->codigo }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Codigo Venda: {{ $caixa->codigo_venda }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Codigo caixa : {{ $caixa->codcaixa }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Codigo operador : {{ $caixa->codoperador }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Emissão : {{ date('d/m/Y h:i:s', strtotime($caixa->data)) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Saida : R$ {{ number_format($caixa->saida, 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Entrada : R$ {{ number_format($caixa->entrada, 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Historico : {{ strtolower($caixa->historico) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Movimentação : {{ $caixa->movimento }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Valor : R$ {{ number_format($caixa->valor, 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Codgio NF saida : {{ strtolower($caixa->codnfsaida) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Posto : {{ $caixa->posto }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Hora : {{ date('d/m/Y h:i:s', strtotime($caixa->hora)) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 pb-0 p-3 me-2">
                <div class="form-group">
                    {{-- <a href="{{ route('user-lista-caixa') }}" class="btn btn-warning  active">
                        Voltar</a> --}}
                    <a onclick="history.go(-1);" class="btn btn-warning  active">
                        Voltar</a>
                </div>
            </div>
        </div>
        @if ($produtos)
            <div class="card" style="margin-top: 50px;">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Produtos</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" style="overflow: auto;">
                        <thead>
                            <tr>
                                {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Codigo</th> --}}
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Produto
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Unitario</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Quantidade</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Total
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Codigo da venda</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('/img/img-default.png') }}"
                                                    class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">Produto</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $item->produto }}</p>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Unitario</p>
                                        <p class="text-xs text-secondary mb-0">R$
                                            {{ number_format($item->unitario, 2, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Quantidade</p>
                                        <p class="text-xs text-secondary mb-0">R$
                                            {{ number_format($item->qtde, 2, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Total</p>
                                        <p class="text-xs text-secondary mb-0">R$
                                            {{ number_format($item->total, 2, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Codigo da venda</p>
                                        <p class="text-xs text-secondary mb-0">
                                            {{ $item->cod_nota }}
                                        </p>
                                    </td>

                                    {{-- <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                </td> --}}


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex me-2 justify-content-center mt-5">
                    {{ $produtos->links() }}
                    {{-- {{ $produtos->appends(['data_inicio' => request()->input('data_inicio'), 'data_fim' => request()->input('data_fim'), 'op_filtro_venda' => request()->input('op_filtro_venda'), 'filtro_vendas' => request()->input('filtro_vendas'), 'op_filtro_vendedor' => request()->input('op_filtro_vendedor')])->links() }} --}}
                </div>

            </div>
        @endif
        @include('tamplate.footer')
    </div>
@endsection
