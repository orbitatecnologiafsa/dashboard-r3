@extends('tamplate.main')
@section('ativo-estoque', 'active')
@section('titulo', 'Estoque - detalhes')
@section('caminho', 'Menu')
@section('atual-page', 'Estoque - detalhes')
@push('sidbar')
    @include('usuario.partial.sidbar')
@endpush
@push('navbar')
    @include('usuario.partial.navbar')
@endpush
@section('conteudo')
    <div class="container-fluid py-4" style="bottom: 100px;">

        @include('usuario.partial.nav_info_estoque')

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
                            Codigo : {{ $estoque->codigo }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Codigo grupo: {{ $estoque->codgrupo }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Codigo barra : {{ $estoque->codigobarra }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Codigo fornecedor : {{ $estoque->codfornecedor }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                           Produto : {{ strtolower( $estoque->produto) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Data ultima compra : {{ date('d/m/Y h:i:s', strtotime($estoque->data_ultimacompra)) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Nota fiscal :  {{ $estoque->notafiscal }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Estoque :  {{ $estoque->estoque }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Preço de custo : R$ {{ number_format($estoque->precocusto, 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                           Preço de venda : R$ {{ number_format($estoque->precovenda, 2, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Unidade : {{ strtolower($estoque->unidade) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Unidade atacado : {{ strtolower($estoque->unidade_atacado) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Quantidade embalagem : {{ strtolower($estoque->qtde_embalagem) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            Tipo : {{ strtolower($estoque->tipo) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            Valor total preço de custo : R$  {{ number_format($estoque->precovenda * $estoque->estoque, 2, ',', '.') }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            Valor total preço de venda : {{ number_format($estoque->precocusto * $estoque->estoque, 2, ',', '.') }}
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-5 pb-0 p-3 me-2">
                <div class="form-group">
                    {{-- <a href="{{ route('user-lista-estoque') }}" class="btn btn-warning  active">
                        Voltar</a> --}}
                        <a onclick="history.go(-1);" class="btn btn-warning  active">
                            Voltar</a>
                </div>
            </div>
        </div>
        @include('tamplate.footer')
    </div>
@endsection
