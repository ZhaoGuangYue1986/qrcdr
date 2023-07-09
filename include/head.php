<?php
/**
 * QRcdr - php QR Code generator
 * head.php
 *
 * PHP version 5.4+
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2019 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @link      http://veno.es/qrcdr/
 */
date_default_timezone_set('UTC');

qrcdr()->init();
qrcdr()->setLayout();

$lang = qrcdr()->getLang();

if (file_exists(dirname(dirname(__FILE__)).'/translations/'.$lang.'.php')) {
    include dirname(dirname(__FILE__)).'/translations/'.$lang.'.php';
}

$getsection = qrcdr()->getConfig('default_tab', '#link');
$optionlogo = 'none';

$PNG_TEMP_DIR = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.qrcdr()->getConfig('qrcodes_dir').DIRECTORY_SEPARATOR;
$PNG_WEB_DIR = qrcdr()->relativePath().qrcdr()->getConfig('qrcodes_dir').'/';

if (!file_exists($PNG_TEMP_DIR)) {
    mkdir($PNG_TEMP_DIR);
}

$matrixPointSize = 24;
$errorCorrectionLevel = qrcdr()->getConfig('precision', 'Q'); // available: L, M, Q, H
$stringbackcolor = qrcdr()->getConfig('qr_bgcolor');
$stringfrontcolor = qrcdr()->getConfig('qr_color');
$output_data = false;

if (qrcdr()->getConfig('delete_old_files')) {
    $lifetime = qrcdr()->getConfig('file_lifetime');
    qrcdr()->deleteOldFiles($PNG_WEB_DIR, ($lifetime*3600), 'svg');
    qrcdr()->deleteOldFiles($PNG_WEB_DIR, ($lifetime*3600), 'png');
}

$rounded_btn_options = qrcdr()->getConfig('rounded_buttons');
$rounded_btn_options = $rounded_btn_options === true ? '["tabnav", "options", "save"]' : $rounded_btn_options;
$rounded_btn_options = $rounded_btn_options ? json_decode($rounded_btn_options) : array();
$rounded_btn_opt = in_array('options', $rounded_btn_options) ? ' rounded-pill' : '';
$rounded_btn_save = in_array('save', $rounded_btn_options) ? ' rounded-pill' : ' rounded-0';
$rounded_btn_nav = in_array('tabnav', $rounded_btn_options) ? ' rounded-pill' : '';
require dirname(dirname(__FILE__)).'/lib/countrycodes.php';
$rtl = qrcdr()->isRtl();
