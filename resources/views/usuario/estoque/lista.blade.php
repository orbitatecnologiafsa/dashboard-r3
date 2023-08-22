@extends('tamplate.main')
@section('ativo-estoque', 'active')
@section('titulo', 'Estoque')
@section('caminho', 'Menu')
@section('atual-page', 'Estoque')
@push('sidbar')
    @include('usuario.partial.sidbar')
@endpush
@push('navbar')
    @include('usuario.partial.navbar')
@endpush
@section('conteudo')

    <div class="container-fluid py-4" style="bottom: 100px;">

      @include('usuario.partial.nav_info_estoque')
        @if (count($estoque) > 0)
            <form method="get" action="{{ route('user-busca-produto') }}">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Buscar produtos</h6>
                        </div>
                    </div>
                    <div class="col-md-5 pb-0 p-3">
                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-3">
                                <input class="form-control form-control-alternative" name="busca_produto"
                                    value="{{ request()->input('busca_produto') ?? old('busca_produto') }}" placeholder="Codigo ou nome do produto"
                                    type="text">

                            </div>
                        </div>
                        @error('busca_produto')
                        <div class="error " style="color:red">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="col-md-5 pb-0 p-3 me-2">
                        <div class="form-group">
                            <button class=" btn btn-primary  active">Buscar</button>
                            <a href="{{ route('user-lista-estoque') }}" class="btn btn-warning  active">
                                Atualizar lista</a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card" style="margin-top: 50px;">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Produtos em estoque</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Codigo</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Produto
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Codigo de barra</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Estoque</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Preço de venda</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Preço de custo</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Total preço venda</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Total preço custo</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estoque as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://orbitadashboard.azurewebsites.net//img/img-default.png"
                                                    class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">Codigo</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $item->codigo }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Produto</p>
                                        <p class="text-xs text-secondary mb-0">{{ strtolower($item->produto) }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Codigo de barras</p>
                                        <p class="text-xs text-secondary mb-0">{{ $item->codigobarra }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Estoque</p>
                                        <p class="text-xs text-secondary mb-0">{{ $item->estoque }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"> Preço de venda</p>
                                        <p class="text-xs text-secondary mb-0">R$
                                            {{ number_format($item->precovenda, 2, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"> Preço de custo</p>
                                        <p class="text-xs text-secondary mb-0">R$
                                            {{ number_format($item->precocusto, 2, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Total preço venda</p>
                                        <p class="text-xs text-secondary mb-0">R$
                                            {{ number_format($item->precovenda * $item->estoque, 2, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Total preço custo</p>
                                        <p class="text-xs text-secondary mb-0">R$
                                            {{ number_format($item->precocusto * $item->estoque, 2, ',', '.') }}</p>
                                    </td>
                                    {{-- <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                </td> --}}
                                    <td class="align-middle">
                                        <a href="{{ route('user-datalhes-produto',$item->id)}}" class="text-secondary font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Detalhes
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex me-2 justify-content-center mt-5">
                    {{ $estoque->appends(['busca_produto' => request()->input('busca_produto')])->links() }}

                </div>
            </div>
        @else
            <p style="margin-top:200px;" class="text-center justfy-content-center">Não existem regitros para serem exbidos!
            </p>
        @endif
        @include('tamplate.footer')
    </div>

@endsection
