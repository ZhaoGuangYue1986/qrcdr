<?php
/**
 * QRcdr - php QR Code generator
 * config.php
 *
 * Main configuration settings
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
$_CONFIG = array(
    'lang' => 'en',                             // main language
    'qrcodes_dir' => 'qrcodes',                 // qr codes directory
    'delete_old_files' => true,                 // delete periodically old files
    'file_lifetime' => 1,                       // delete files older than..(hours) from /qrcodes_dir/
    'uploader' => true,                         // let users upload their own logo
    'qr_bgcolor' => '#FFFFFF',                  // default background color for generated qrcodes
    'qr_color' => '#000000',                    // default foreground color for generated qrcodes
    'session_name' => 'qrSession',              // custom session name for the script || false
    'placeholder' => 'images/placeholder.svg',  // default placeholder
    'link' => true,                             // activate link tab
    'text' => true,                             // activate text tab
    'email' => true,                            // activate email tab
    'location' => true,                         // activate location tab
    'tel' => true,                              // activate telephone tab
    'sms' => true,                              // activate sms tab
    'whatsapp' => true,                         // activate whatsapp tab
    'skype' => true,                            // activate Skype tab
    'zoom' => true,                             // activate Zoom tab
    'wifi' => true,                             // activate wifi tab
    'vcard' => true,                            // activate v-card tab
    'event' => true,                            // activate event tab
    'paypal' => true,                           // activate PayPal tab
    'bitcoin' => true,                          // activate BitCoin tab
    'default_tab' => '#link',                   // available options: #link | #text | #email | #location | #tel | #sms | #whatsapp | #skype | #zoom | #wifi | #vcard | #event | #paypal | #bitcoin
    'detect_browser_lang' => false,             // detect browser language
    'google_api_key' => 'YOUR-API-KEY',         // https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key
    'lat' => '40.7127837',                      // Initial latitude for the location map
    'lng' => '-74.00594130000002',              // Initial longitude for the location map
    'color_primary' => false,                   // main color, used for buttons and header background. set a #hex color or false to get random colors
    'layout' => 'classic',                      // main layout: 'classic' || 'vertical'
    'sidebar' => 'right',                       // sidebar position: 'right' || 'left'
    'accordion' => true,                        // Collapse options menu: true || false
    'rounded_buttons' => '["tabnav", "options", "save"]',   // Selective rounded buttons: '["tabnav", "options", "save"]' || false
    'debug_mode' => false,                      // set true to track errors
    'precision' => 'Q',                         // available: L, M, Q, H
    'relative_path' => '',                      // use this option if you place the main index.php in different location, this must be the path of the main qrcdr directory, relative to the index
    );
