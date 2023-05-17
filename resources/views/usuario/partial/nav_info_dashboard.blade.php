<div class="row">

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="{{ route('user-lista-estoque') }}">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Estoque</p>
                                <h5 class="font-weight-bolder" id="user-estoque-info">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </h5>
                                {{-- <p class="mb-0">
            <span class="text-success text-sm font-weight-bolder">+55%</span>
            since yesterday
          </p> --}}
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div
                                class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Vendas</p>
                            <h5 class="font-weight-bolder" id="user-venda-info">
                                {{-- R$ {{ number_format($venda, 2, ',', '.') }} --}}
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </h5>
                            {{-- <p class="mb-0">
            <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
          </p> --}}
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
