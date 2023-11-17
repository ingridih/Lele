<?php require_once "vendor/autoload.php";
require "vendor/mpdf/mpdf/mpdf.php";

if ($_POST['action'] == 'gerar') {
    $mpdf = new \Mpdf\Mpdf();
    // Configurações para adicionar uma imagem de fundo
    // $mpdf->SetWatermarkImage('');
    // $mpdf->showWatermarkImage = true;
    // $mpdf->watermarkImageAlpha = 0.2; // Ajuste a opacidade conforme necessário


    $html ='<link href="css/mpdf.css" type="text/css" rel="stylesheet" media="mpdf" />
        
        <p>Campinas, '.date('d/m/Y').'</p><br>
        <p>A/C: Empresa: '.$_POST['empresa'].'</p><br>

        <h3 class="text-align:center">PROPOSTA COMERCIAL</h3>

        <p>Segue abaixo a descrição e preço das peças solicitadas, quaisquer dúvidas ou alterações que forem necessárias, por favor, entre em contato:</p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Materiais/ Peças e equipamentos</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody style="width: 100%">';
            // foreach($_POST['item'] as $item){
            //     $i = explode('|', $item);
            //     $html .= '<tr>
            //         <td><p class="">'.$i[0].'</p></td>
            //         <td><p class="">'.$i[1].'</p></td>
            //         <td><p class="">'.$i[2].'</p></td>
            //     </tr>';
            // }
            $html .= '</tbody></table>';

    // Adicione conteúdo ao PDF
    $mpdf->CSSselectMedia = 'mpdf';
    $mpdf->WriteHTML($html);

    $file_name = 'ct-'.date('Y-m-d_His').'.pdf';
    // Output a PDF file directly to the browser

    $mpdf->Output($_SERVER['DOCUMENT_ROOT'].'/file/'.$file_name,'F');

    ob_clean();  

    $return = $file_name;
    echo $return;

    echo 'PDF gerado com sucesso!';
}