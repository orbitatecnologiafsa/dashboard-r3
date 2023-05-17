@extends('tamplate.main')

@section('titulo', 'Adm- cadastrar clientes')
@section('ativo-cadastro', 'active')
@section('caminho', 'Menu')
@section('atual-page', 'Cadastrar cliente')
@push('sidbar')
    @include('adm.partial.sidbar')
@endpush
@push('navbar')
    @include('adm.partial.navbar')
@endpush

@section('conteudo')
    <div class="container-fluid py-4" style="bottom: 100px;">

      @include('adm.partial.info_nav')

        <form method="post" action="{{ route('adm-cadastro-cliente-post') }}">
            @csrf
            <div class="card" style="margin-top: 100px;">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Cadastrar cliente</h6>
                    </div>
                </div>

                <div class="col-md-6 pb-0 p-3">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                Nome
                                <input class="form-control form-control-alternative" type="text" name="nome_filial"
                                    value="{{ request()->input('nome_filial') ?? old('nome_filial') }}" id="example-date-input">
                                @error('nome_filial')
                                    <div class="error" style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                CNPJ ou CPF

                                <input class="form-control form-control-alternative" type="text" name="cnpj"
                                    value="{{ request()->input('cnpj') ?? old('cnpj')  }}" id="example-date-input">
                                @error('cnpj')
                                    <div class="error " style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                               Senha
                                <input class="form-control form-control-alternative" type="text" name="password"
                                    value="{{ request()->input('password') ?? old('password')  }}" id="example-date-input">
                                @error('password')
                                    <div class="error " style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 pb-0 p-3 me-2">
                    <div class="form-group">
                        <button class=" btn btn-primary  active">Cadastrar</button>
                    </div>
                </div>

            </div>

        </form>
        @include('tamplate.footer')
    </div>
@endsection
