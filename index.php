<?php
/**
 * QRcdr - php QR Code generator
 * index.php
 *
 * PHP version 5.4+
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2021 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @version   5.3.5
 * @link      http://veno.es/qrcdr/
 */
$version = '5.3.5';

if (version_compare(phpversion(), '5.4', '<')) {
    exit("QRcdr requires at least PHP version 5.4.");
}

// https://stackoverflow.com/questions/11920026/replace-file-get-contents-with-curl
if (!ini_get('allow_url_fopen')) {
    exit("Please enable <code>allow_url_fopen<code>");
}
if (!function_exists('mime_content_type')) {
    exit("Please enable the <code>fileinfo</code> extension");
}
// Update this path if you have a custom relative path inside config.php
require dirname(__FILE__)."/lib/functions.php";

if (qrcdr()->getConfig('debug_mode')) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL ^ E_NOTICE);
}
$relative = qrcdr()->relativePath();
require dirname(__FILE__).'/'.$relative.'include/head.php';
?>
<!doctype html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $rtl['dir']; ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title><?php echo qrcdr()->getString('title'); ?></title>
        <meta name="description" content="<?php echo qrcdr()->getString('description'); ?>">
        <meta name="keywords" content="<?php echo qrcdr()->getString('tags'); ?>">
        <link rel="shortcut icon" href="<?php echo $relative; ?>images/favicon.ico">
        <link href="<?php echo $relative; ?>bootstrap/css/bootstrap<?php echo $rtl['css']; ?>.min.css" rel="stylesheet">
        <link href="<?php echo $relative; ?>css/font-awesome.min.css" rel="stylesheet">
        <script src="<?php echo $relative; ?>js/jquery-3.5.1.min.js"></script>
        <?php
        $custom_page = false;
        $body_class = '';
        if (isset($_GET['p'])) {
            $load_page = dirname(__FILE__).'/'.$relative.'template/'.$_GET['p'].'.html';
            if (file_exists($load_page)) {
                $custom_page = file_get_contents($load_page);
            }
        }
        qrcdr()->loadQRcdrCSS($version);
        if (!$custom_page) {
            $body_class = 'qrcdr';
            qrcdr()->loadPluginsCss();
        }
        qrcdr()->setMainColor(qrcdr()->getConfig('color_primary'));
        ?>
		<script charset="UTF-8" id="LA_COLLECT" src="//sdk.51.la/js-sdk-pro.min.js"></script>
        <script>LA.init({id:"3I8AaYOEzwyppBlC",ck:"3I8AaYOEzwyppBlC"})</script>
    </head>
    <body class="<?php echo $body_class; ?>">
        <?php
        if (file_exists(dirname(__FILE__).'/'.$relative.'template/navbar.php')) {
            include dirname(__FILE__).'/'.$relative.'template/navbar.php';
        }
        if (file_exists(dirname(__FILE__).'/'.$relative.'template/header.php')) {
            include dirname(__FILE__).'/'.$relative.'template/header.php';
        }
        if ($custom_page) {
            echo '<div class="container mt-4">'.$custom_page.'</div>';
        } else {
            // Generator
            include dirname(__FILE__).'/'.$relative.'include/generator.php';
        }
        qrcdr()->loadQRcdrJS($version);

        if (!$custom_page) {
            qrcdr()->loadPlugins();
        }
        if (file_exists(dirname(__FILE__).'/'.$relative.'template/footer.php')) {
            include dirname(__FILE__).'/'.$relative.'template/footer.php';
        }
        ?>
    </body>
</html>
