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
        <div class="container">
            
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
                            <input type="text" class="form-control" id="empresa" placeholder="Entre com a empresa que vai receber o orçamento.">
                        </div>
                        <div class="mb-3 col">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                    </div>
                </div>
                <div id="kt_docs_repeater_basic">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="kt_docs_repeater_basic">
                            <div data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label class="form-label">Name:</label>
                                        <input type="email" class="form-control mb-2 mb-md-0" placeholder="Enter full name" />
                                    </div>
                                    <hr>

                                    
                                    <div class="col-md-4">
                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-5">
                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            Add
                        </a>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Gerar Orçamento</button>
            </form>
        </div>
    </body>
</html>



<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.repeater.min.js"></script>

<script>
    $(document).ready(function() {
        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
});
</script>
