<?php 

?>
<link rel="stylesheet" href="css/bootstrap-grid.min.css">
<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Criar Orçamento.</title>
    </head>
    <body>
        <div class="container" style="margin-top: 50px;">
            <form class="form" id="form" method="post">
                <div class="">
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="text" class="form-control" id="data" value="<?php echo date('d/m/Y') ?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="exampleInputEmail1" class="form-label">Empresa</label>
                            <input type="text" class="form-control empresa" id="empresa" name="empresa" placeholder="Entre com a empresa que vai receber o orçamento.">
                        </div>
                    </div>
                </div>
                <div id="kt_docs_repeater_basic">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="kt_docs_repeater_basic">
                            <div data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="form-label">Materiais/ Peças e equipamentos</label>
                                        <input type="text" class="form-control mb-2 mb-md-0 item" id="item" name="item"   placeholder="Entre com o nome do item e detalhes" />
                                    </div>  
                                    <div class="col-md-2">
                                        <label class="form-label">Quantidade</label>
                                        <input type="number" class="form-control mb-2 mb-md-0 quantidade" id="quantidade" name="quantidade" placeholder="Entre com a quantidade" />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Valor</label>
                                        <input type="text" class="form-control mb-2 mb-md-0 valor" id="valor" name="valor" placeholder="Entre com o valor" />
                                    </div>
                                    <div class="col-md-1">
                                        <span class="totalt"></span>
                                    </div>
                                    <div class="col-md-1" style="margin-top: 20px;">
                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn btn-danger mt-3 mt-md-8">
                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-5">
                        <a href="javascript:;" data-repeater-create class="btn btn-primary">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            Adicionar Linha
                        </a>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label class="form-label">Cobrar Serviço</label>
                            <select class="form-control mb-2 mb-md-0" id="servico" onchange="mostrarOcultarCampo()">
                                <option>Selecione</option>
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                        </div>  
                        <div class="col-md-3">
                            <label class="form-label">Valor do Serviço</label>
                            <input type="text" class="form-control mb-2 mb-md-0 valorservico" id="valorservico" name="valorservico" value="0" placeholder="Valor do Serviço" style="display:none"/>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3" style="margin-top: 40px;font-weight: 600">
                            <label class="form-label">Valor Total</label>
                            <input type="text" class="form-control mb-2 mb-md-0" id="totalfinal" name="totalfinal" value="0" disabled/>
                        </div>  
                        <div class="col-md-3">
                            <label class="form-label">Forma de Pagamento</label>
                            <select type="text" class="form-control mb-2 mb-md-0" id="pagamento" name="pagamento" value="0">
                                <option value="">Selecione</option>
                                <option value="1">A Vista</option>
                                <option value="2">Parcelado em 2x</option>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="form-label">Se necessário, insira uma observação para sair no orçamento.</label>
                            <textarea class="form-control mb-2 mb-md-0" id="observacao" maxlength="450"></textarea>
                        </div>
                    </div>  
                </div>
                <hr>
                <button type="submit" class="btn btn-success">Gerar Orçamento</button>
            </form>
        </div>
    </body>
</html>

<style>

.error {
    display: block;
    margin-top: 5px;
    margin-bottom: 10px;
    color: #a94442;
}
</style>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.repeater.min.js"></script>
<script src="js/jquery.maskMoney.min.js"></script>
<script src="js/jquery.validate.min.js"></script>


<script>


var totalservicofinal = 0;
function mostrarOcultarCampo() {
    var selectElement = document.getElementById("servico");
    var campoValor = document.getElementById("valorservico");

    if (selectElement.value === "sim") {
        campoValor.style.display = "block";
    } else {
        campoValor.style.display = "none";
        $('#valorservico').val(0);
        CalculaTotais();
    }
}

$(document).ready(function() {

    $(".valor").maskMoney({thousands:'', decimal:','});
    $(".valorservico").maskMoney({thousands:'', decimal:','});

    $('#kt_docs_repeater_basic').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },
        show: function () {
            $(this).slideDown();
            $(".valor").maskMoney({thousands:'.', decimal:','});
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });

    $('#pagamento option[value="2"]').prop('disabled', true);
});

$(document).on('keyup', '.valor', function() {
    CalculaTotais();
});

$(document).on('keyup', '.valorservico', function() {
    CalculaTotais();
});


function CalculaTotais() {
    var ValorFinal = 0;
    var totalt = document.getElementsByClassName("totalt");
    var totalservicoElement = document.getElementsByClassName("valorservico")[0];
    

    if (totalservicoElement) {
        var totalservicoValue = totalservicoElement.value;
        var totalservicoSemMascara = totalservicoValue.replace(",", ".");
        totalservicofinal = parseFloat(totalservicoSemMascara);
        if (isNaN(totalservicofinal)) {
            totalservicofinal = 0;
        }
    }
    console.log(totalservicofinal);
    for (var i = 0; i < totalt.length; i++) {
        var qtd = parseFloat(document.getElementsByClassName('quantidade')[i].value);
        var valor = parseFloat(document.getElementsByClassName('valor')[i].value.replace(",", "."));

        if (!isNaN(qtd) && !isNaN(valor)) {
            var valortotal = qtd * valor;
            ValorFinal = ValorFinal + valortotal + totalservicofinal;

            const formatoBr_valorprod = valortotal.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL',
            });

            totalt[i].innerHTML = formatoBr_valorprod;

            const formatoBr_valortotal = ValorFinal.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL',
            });

            $('#totalfinal').val(formatoBr_valortotal);
        }
    }

    if (ValorFinal >= 300) {
        // Habilitar a opção 2 no elemento select
        $('#pagamento option[value="2"]').prop('disabled', false);
    } else {
        // Desabilitar a opção 2 se o valor final for menor ou igual a 300
        $('#pagamento option[value="2"]').prop('disabled', true);
        $('#pagamento').val('');
    }

}
$(document).ready(function () {

    // Inicializar o plugin de validação
    $("#form").validate();
        // Adicionar regras de validação para classes específicas
    $(".empresa").rules("add", {
        required: true,
        messages: {
            required: "Por favor, preencha este campo"
        }
    });
    $(".item").rules("add", {
        required: true,
        messages: {
            required: "Por favor, preencha este campo"
        }
    });
    $(".quantidade").rules("add", {
        required: true,
        messages: {
            required: "Por favor, preencha este campo"
        }
    });
    $(".valor").rules("add", {
        required: true,
        messages: {
            required: "Por favor, preencha este campo"
        }
    });
    $(".pagamento").rules("add", {
        required: true,
        messages: {
            required: "Por favor, preencha este campo"
        }
    });
    $(".servico").rules("add", {
        required: true,
        messages: {
            required: "Por favor, preencha este campo"
        }
    });

    $("#form").submit(function () {
        // Verificar se o formulário é válido
        if ($(this).valid()) {
            // O formulário é válido, você pode prosseguir com a ação desejada
            console.log("O formulário é válido. Enviando dados...");
            var item = [];
            var selectElements = document.querySelectorAll('item');
            for(var i = 0; i < selectElements.length; i++ ) {    
                item.push(selectElements[i].value+'|'+$('.qtd')[i].value+'|'+$('.quantidade')[i].value+'|'+selectedText+'|'+$('.valor')[i].value);
            } 
            $.post({
                url: "handle.php", // the resource where youre request will go throw
                type: "POST", // HTTP verb
                data: {action: 'gerar', 
                    item: item, 
                    empresa: $('#empresa').val(), 
                    servico: $('#servico').val(),
                    totalfinal: $('#totalfinal').val(),
                    pagamento: $('#pagamento').val(),
                    observacao: $('#observacao').val(),
                },
                    success: function (response) {
        
                    }
                });

        } else {
            // O formulário não é válido, você pode realizar ações adicionais se necessário
            console.log("O formulário não é válido. Corrija os campos destacados.");
        }
        // Retornar false para evitar que o formulário seja enviado automaticamente
        return false;
    });
});

</script>
