function filtro_vendas(url) {
    $(document).ready(function () {
        $.get(url, function (data) {
            var val = data['filtro_venda']
            val.map(({
                campo,
                valor
            }) => {
                if (getParam('op_filtro_venda') == valor) {
                    $('#filto_vendas').append(`<option selected value='${valor}'>${campo}</option>`);
                } else {
                    $('#filto_vendas').append(`<option value='${valor}'>${campo}</option>`);
                }
            });
        })
    });
}

function getParam(param) {
    var url_string = window.location.href;
    var url = new URL(url_string);
    return url.searchParams.get(param); //pega o value
}

function vendedores(url) {
    $(document).ready(function () {
        // Quando o valor do primeiro select mudar
        $('#filto_vendas').change(function () {
            var valorSelecionado = $(this).val();

            // Verifica se o valor selecionado é igual a "opcao2"
            if (valorSelecionado === 'nome_vendedor') {
                // Substitui o campo input pelo campo select
                var visivel = $('#campo_venda').is(':visible');
                if (visivel) {
                    $('#campo_venda').hide()
                    $('#filtro_vendedor').remove();
                    $('#select_venda_var').append(`<select class="form-control" name="op_filtro_vendedor"
                    id="filtro_vendedor">
                   </select>`)
                    //  $('#select_venda_var').html('<select class="form-control" id="campoSelect">' + options + '</select>');
                    $.get(url, function (data) {
                        var val = data['filtro_venda']
                        val.map(({
                            campo,
                            valor
                        }) => {
                            if (getParam('op_filtro_vendedor') == valor) {
                                $('#filtro_vendedor').append(`<option selected  value='${valor}'>${campo}</option>`);
                            } else {
                                $('#filtro_vendedor').append(`<option  value='${valor}'>${campo}</option>`);
                            }

                        });

                    });
                    $('#select_venda_var').show();
                }

            } else {
                // Substitui o campo select pelo campo input
                var visivel = $('#select_venda_var').is(':visible');
                if (visivel) {
                    $('#campo_venda').show();
                    $('#select_venda_var').hide();
                }
            }
        });
    });
}
