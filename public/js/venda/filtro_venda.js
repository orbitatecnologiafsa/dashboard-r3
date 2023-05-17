function filtro_vendas(url) {
    $(document).ready(function () {
        $.get(url, function (data) {
            var val = data['filtro_venda']
            val.map(({
                campo,
                valor
            }) => {
                if(getParam('op_filtro_venda') == valor){
                    $('#filto_vendas').append(`<option selected value='${valor}'>${campo}</option>`);
                }else{
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

function alterarCampo() {
    var campo = document.getElementById('campo').value;
    var campoContainer = document.getElementById('campoContainer');

    if (campo === 'select') {
        // Remover o campo de entrada
        campoContainer.innerHTML = '';

        // Criar um novo campo de seleção
        var select = document.createElement('select');
        select.id = 'campoSelect';
        select.name = 'campoSelect';

        // Adicionar algumas opções
        var option1 = document.createElement('option');
        option1.value = 'opcao1';
        option1.text = 'Opção 1';
        select.appendChild(option1);
         var option3 = document.createElement('option');
        option1.value = 'opcao3';
        option1.text = 'Opção 1';
        select.appendChild(option3);

        var option2 = document.createElement('option');
        option2.value = 'opcao2';
        option2.text = 'Opção 2';
        select.appendChild(option2);

        campoContainer.appendChild(select);
    } else {
        // Remover o campo de seleção
        campoContainer.innerHTML = '';

        // Criar um novo campo de entrada
        var input = document.createElement('input');
        input.type = 'text';
        input.id = 'campoInput';
        input.name = 'campoInput';

        campoContainer.appendChild(input);
    }
}
