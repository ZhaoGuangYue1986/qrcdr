<?php
$getfile = filter_input(INPUT_GET, 'f', FILTER_SANITIZE_SPECIAL_CHARS);
require_once dirname(dirname(__FILE__)) . '/config.php';
$filepath = dirname(dirname(__FILE__)).'/'.$_CONFIG['qrcodes_dir'].'/'.basename($getfile).'.svg';
if (file_exists($filepath)) {
    include_once dirname(__FILE__).'/vendor/autoload.php';

    $settings = array(
        'tempDir' => dirname(__FILE__) . '/tmp',
    );

    if (isset($_GET['fonts'])) {
        $settings['biDirectional'] = true;
        $settings['fontDir'] = array( __DIR__ . '/fonts');
        $settings['default_font'] = 'Arial, Helvetica, serif-sans';
    } else {
        $settings['mode'] = 'c';
    }

    $mpdf = new \Mpdf\Mpdf($settings);

    $mpdf->imageVars['myvariable'] = file_get_contents($filepath);
    $mpdf->SetTitle('QR code');
    $image = '<div style="width:100%; text-align: center;"><img style="height: auto; max-width:100%; margin:0 auto;" src="var:myvariable" /></div>';
    $mpdf->WriteHTML($image);
    $mpdf->Output('qrcode.pdf', 'I');
} else {
    header('Location: ../');
}
exit;
