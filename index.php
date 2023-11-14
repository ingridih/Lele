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
            <form>
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
                <button type="submit" class="btn btn-primary">Gerar Orçamento</button>
            </form>
        </div>
    </body>
</html>




<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>

<script src="js/bootstrap.bundle.min.js"></script>

