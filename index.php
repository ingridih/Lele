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
                            <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Entre com a empresa que vai receber o orçamento.">
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
                                        <input type="text" class="form-control mb-2 mb-md-0" id="item" name="item"   placeholder="Entre com o nome do item e detalhes" />
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
                </div>
                <hr>
                <button type="submit" class="btn btn-success">Gerar Orçamento</button>
            </form>
        </div>
    </body>
</html>



<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.repeater.min.js"></script>
<script src="js/jquery.maskMoney.min.js"></script>


<script>
$(document).ready(function() {

    $(".valor").maskMoney({thousands:'.', decimal:','});

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
});

$('.valor').on('keyup', function() {
    CalculaTotais();
});


function CalculaTotais() {
    var ValorFinal = 0;
    var totalt = document.getElementsByClassName("totalt");

    for (var i = 0; i < totalt.length; i++) {
        var qtd = parseFloat(document.getElementsByClassName('quantidade')[i].value);
        var valor = parseFloat(document.getElementsByClassName('valor')[i].value.replace(",", "."));

        if (!isNaN(qtd) && !isNaN(valor)) {
            var valortotal = qtd * valor;

            const formatoBr_valorprod = valortotal.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL',
            });

            totalt[i].innerHTML = formatoBr_valorprod;

           
        }
    }

}
</script>
