<?php require_once "vendor/autoload.php";
require "vendor/mpdf/mpdf/src/Mpdf.php";

if ($_POST['action'] == 'gerar') {
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'P',
        'margin_top' => 0,
        'margin_bottom' => 0,
        'margin_left' => 0,
        'margin_right' => 0,
    ]);
    // Configurações para adicionar uma imagem de fundo
    // $mpdf->SetWatermarkImage('');
    // $mpdf->showWatermarkImage = true;
    // $mpdf->watermarkImageAlpha = 0.2; // Ajuste a opacidade conforme necessário
   
    $backgroundImagePath = 'modelo.jpeg';
    $html ='<link href="css/mpdf.css" type="text/css" rel="stylesheet" media="mpdf" />
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; background-image: url(\'' . $backgroundImagePath . '\'); background-size: cover; opacity: 0.5 !important;"></div>
        <div class="corpinho font-san" style="z-index: 1; position: relative; margin-left:17%; margin-right: 17%">

        <br><br><br><br><br><br><br><br><br><br>

        <p style="">Campinas, '.date('d/m/Y').'</p>
        <p style="">A/C: Empresa: '.$_POST['empresa'].'</p><br>
        <div style="text-align: center;">
            <h3>PROPOSTA COMERCIAL</h3>
        </div>

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
            foreach($_POST['item'] as $item){
                $i = explode('|', $item);
                $html .= '<tr>
                    <td><p class="">'.$i[0].'</p></td>
                    <td><p class="">'.$i[1].'</p></td>
                    <td><p class="">'.$i[2].'</p></td>
                </tr>';
            }
            $html .= '</tbody></table>';
            
            if($_POST['servico'] == 'sim'){
                $html .= '<p>Valor do Serviço: <span style="font-weight: bold;">R$ '.$_POST['valorservico'].'</span></p>';
            }
            $html .= '<p>Valor Total: <span style="font-weight: bold;">'.$_POST['totalfinal'].'</span></p>';
            // if($_POST['pagamento'] == 1){
            //     $pagemento = 'A Vista';
            // }else if($_POST['pagamento'] == 2){
            //     $pagamento = 'Parcelado em 2x';
            // }
            
            if($_POST['totalsemformatao'] < 500){
                $html .= '<p>Formas de Pagamento: </p>';
                $html .= '<ul><li style="font-weight: bold;">A Vista</li>';
                $html .= '<li style="font-weight: bold;">Link de Pagamento (Taxa 2,46%)</li></ul>';
            }else if($_POST['totalsemformatao'] >= 500){
                $html .= '<p>Formas de Pagamento: </p>';
                $html .= '<ul><li style="font-weight: bold;">A Vista</li>';
                $html .= '<li style="font-weight: bold;">Link de Pagamento (Taxa 2,46%)</li>';
                $html .= '<li style="font-weight: bold;">2X no cartão</li></ul>';
                
            }
            
            if($_POST['observacao'] != ''){
                $html .= '<p>Observação: <span>'.$_POST['observacao'].'</span></p>';
            }
            $html .= '<br><br><p style="font-weight: bold;">Valido até dia '.date('d/m/Y', strtotime(date('d/m/Y') . ' + 2 days')).'</p>';

    $html .= '</div></div>';

    // Adicione conteúdo ao PDF
    $mpdf->CSSselectMedia = 'mpdf';
    //$mpdf->SetHTMLHeader('<img src="' . $backgroundImagePath . '" width="100%" height="100%" style="position: fixed; top: 0; left: 0; opacity: 0.5;" />');
    $mpdf->WriteHTML($html);

    $file_name = 'orcamento-'.date('Y-m-d_His').'.pdf';
    // Output a PDF file directly to the browser

    $mpdf->Output($_SERVER['DOCUMENT_ROOT'].'/file/'.$file_name,'F');

    ob_clean();  

    $return = $file_name;
    echo $return;

}


if ($_POST['action'] == 'apagar') {
    $nomeArquivo = 'file/'.$_POST['arquivo'];

    if (file_exists($nomeArquivo)) {
        if (unlink($nomeArquivo)) {
        } else {
        }
    } else {
    }
}