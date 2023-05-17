@extends('tamplate.main')
@section('titulo', 'Lojas')
@section('conteudo')
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <h1 class="text-center">Bem vindo!</h1>
                <h3 class="text-center" style="margin-bottom: 30px;">Para prosseguir selecione uma loja</h3>

                <div class="row row-cols-1 row-cols-md-2 g-4">

                    @foreach ($lojas as $loja)
                    <a href="{{ route('user-lojas-selecionada',$loja->cnpj_loja)}}" class="nav-link">
                        <div class="col me-2">
                            <div class="card">
                                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                                <div class="card-body">
                                    <h5 class="card-title">{{$loja->nome_loja}}</h5>
                                    <p class="card-text">CNPJ {{$loja->cnpj_loja}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach








                </div>
            </div>
        </div>
    </section>
@endsection
