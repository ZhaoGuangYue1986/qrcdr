<?php
/**
 * QRcdr - php QR Code generator
 * lib/functions.php
 *
 * PHP version 5.3+
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2019 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @link      http://veno.es/qrcdr/
 */
require dirname(dirname(__FILE__))."/config.php";

if (!class_exists('QRcdrFn', false)) {
    /**
     * Main QRcdr Functions class
     *
     * @category  PHP
     * @package   QRcdr
     * @author    Nicola Franchini <info@veno.it>
     * @copyright 2015-2019 Nicola Franchini
     * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
     * @link      http://veno.es/qrcdr/
     */
    class QRcdrFn
    {
        /**
         * Holds an instance of the object
         *
         * @var MeMeMe_Admin
         */
        protected static $instance = null;

        /**
         * Returns the running object
         *
         * @return QRcdrFn
         */
        public static function getInstance()
        {
            if (null === self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Init session
         *
         * @return void
         */
        public function init()
        {
            if (session_status() == PHP_SESSION_NONE) {
                if ($this->getConfig('session_name')) {
                    session_name($this->getConfig('session_name'));
                }
                if (PHP_VERSION_ID >= 70300) {
                    session_set_cookie_params(
                        ['httponly' => true, 'samesite' => 'strict']
                    );
                }
                session_start();
            }
        }

        /**
         * Validate URL
         *
         * @param string $url url to encode
         *
         * @return validated url
         */
        public function validateUrl($url)
        {
            if ($url) {
                $trim = trim($url);
                if (strlen($trim) >= 2) {
                    $url = strpos($trim, 'http') !== 0 ? 'http://'.$trim : $trim;
                    return urldecode($url);
                    // return filter_var($url, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
            return false;

            // $path = parse_url($url, PHP_URL_PATH);
            // $query = parse_url($url, PHP_URL_QUERY);
            // $fragment = parse_url($url, PHP_URL_FRAGMENT);

            // $encoded_path = array_map('urlencode', explode('/', $path));
            // $encoded_path_string = implode('/', $encoded_path);
            // $encoded_path_string = str_replace("%3D", "=", $encoded_path_string);

            // $url = str_replace($path, $encoded_path_string, $url);

            // if ($query) {
            //     $query_vars = explode('&', $query);
            //     $final_query_array = array();
            //     foreach ($query_vars as $query_var) {
            //         $encoded_query = array_map('urlencode', explode('=', $query_var));
            //         $final_query_array[] = implode('=', $encoded_query);
            //     }
            //     $final_query = implode('&', $final_query_array);
            //     $url = str_replace($query, $final_query, $url);
            // }
            // $url = $fragment ? str_replace($fragment, urlencode($fragment), $url) : $url;
            // return filter_var($url, FILTER_VALIDATE_URL);
        }

        /**
         * Get language
         *
         * @return $lang
         */
        public function getLang()
        {
            $relative = $this->relativePath();
            $browserDetect = $this->getConfig('detect_browser_lang');
            $configlang = $this->getConfig('lang');
            $default = $configlang ? $configlang : 'en';

            if ($browserDetect) {
                $browserlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                if (file_exists($relative."translations/".$browserlang.".php")) {
                    $lang = $browserlang;
                    $_SESSION['lang'] = $lang;
                }
            }
            $getlang = filter_input(INPUT_GET, "lang", FILTER_SANITIZE_SPECIAL_CHARS);

            if ($getlang && file_exists($relative."translations/".$getlang.".php")) {
                $lang = $getlang;
                $_SESSION['lang'] = $lang;
            }
            if (isset($_SESSION['lang'])) {
                $lang = $_SESSION['lang'];
            } else {
                $lang = $default;
            }
            return $lang;
        }

        /**
         * Get RTL direction
         *
         * @return array
         */
        public function isRtl()
        {
            // Arabic, Azeri, Dhivehi, Hebrew, Kurdish, Persian (farsi), Urdu
            $rtl_languages = array(
                'ar', 'az', 'dv', 'he', 'ku', 'fa', 'ur'
            );
            $lang = $this->getLang();
            $values = array(
                'css' => '',
                'dir' => 'ltr',
            );
            if (in_array($lang, $rtl_languages)) {
                $values = array(
                    'css' => '.rtl',
                    'dir' => 'rtl',
                );
            }
            return $values;
        }

        /** 
         * Reverse string 
         *
         * @param string $str string to reverse
         * 
         * @return reversed string
         */
        public static function reverseString($str)
        {

            if (false === function_exists("mb_str_split")) {
                /**
                 * Convert a string to an array.
                 * 
                 * @param string $string       The input string
                 * @param int    $split_length Maximum length of the chunk
                 *
                 * @return array If the optional split_length parameter is specified,
                 *  the returned array will be broken down into chunks with each being
                 *  split_length in length, otherwise each chunk will be one character
                 *  in length. FALSE is returned if split_length is less than 1. If the
                 *  split_length length exceeds the length of string, the entire string
                 *  is returned as the first (and only) array element.
                 */
                function mb_str_split($string, $split_length = 1)
                {
                    if (false === function_exists("mb_strlen") || false === function_exists("mb_substr")) {
                        $array =  str_split($string);
                    } else {
                        $split_length = ($split_length <= 0) ? 1 : $split_length;
                        $mb_strlen = mb_strlen($string, "utf-8");
                        $array = array();
                        for ($i = 0; $i < $mb_strlen; $i = $i + $split_length) {
                            $array[] = mb_substr($string, $i, $split_length);
                        }
                    }
                    return $array;
                }
            }

            $ar = mb_str_split($str);
            return join('', array_reverse($ar));
        }


        /**
         * Get translated string
         *
         * @param string $string key to search
         *
         * @return translated string
         */
        public function getString($string)
        {
            global $_translations;
            $result = '>'.$string.'<';

            if (isset($_translations[$string])) {
                $stringa = $_translations[$string];
                if (strlen($stringa) > 0) {
                    $result = $_translations[$string];
                }
            }
            return $result;
        }

        /**
         * Get config value
         *
         * @param string $key     key to search
         * @param string $default default value
         *
         * @return config value
         */
        public function getConfig($key, $default = false)
        {
            global $_CONFIG;
            if (isset($_CONFIG[$key])) {
                return $_CONFIG[$key];
            }
            return $default;
        }

        /**
         * Get relative path
         *
         * @return relative path
         */
        public function relativePath()
        {
            $relative = $this->getConfig('relative_path', '');
            $relative = strlen($relative) ? trim($relative, '/').'/' : '';
            return $relative;
        }

        /**
         * Set error
         *
         * @param string $error error message
         *
         * @return global error
         */
        public function setError($error)
        {
            global $_ERROR;
            $_ERROR = $error;
        }

        /**
         * Delete old files
         *
         * @param string $dir the dir to scan
         * @param int    $age files lifetime
         * @param str    $ext file extension: svg, png
         *
         * @return a clean directory
         */
        public function deleteOldFiles($dir = 'qrcodes/', $age = 3600, $ext = 'png')
        {
            if (file_exists($dir)) {
                $ext = strlen($ext) ? '.'.$ext : '';
                $now = time();
                $searchfiles = glob($dir.'*'.$ext);
                foreach ($searchfiles as $file) {
                    $filelastmodified = filemtime($file);
                    $life = $now - $filelastmodified;
                    if ($life > $age) {
                        unlink($file);
                    }
                }
            }
        }

        /**
         * Language menu
         *
         * @param string $type  menu output availabe: 'menu' | 'list'
         * @param string $class optional class to add
         *
         * @return the language menu
         */
        public function langMenu($type = 'menu', $class = 'langmenu')
        {
            $relative = $this->relativePath();
            $langfiles = glob($relative.'translations/*.php');

            $langindex = json_decode(file_get_contents(dirname(dirname(__FILE__)).'/translations/index.json'), true);

            $lang = $this->getLang();
            if ($type == 'menu') {
                $mymenu = '<li class="'.$class.' nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$this->getString('language').'</a><div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
                foreach ($langfiles as $value) {
                    $val = basename($value, '.php');
                    $active = $val == $lang ? ' active' : '';
                    $link = '?lang='.$val;
                    $mymenu .= '<a class="dropdown-item'.$active.'" href="'.$link.'">'.$langindex[$val].'</a>';
                }
                $mymenu .='</div></li>';
            } else {
                $mymenu = '';
                foreach ($langfiles as $value) {
                    $val = basename($value, '.php');
                    $active = $val == $lang ? ' active' : '';
                    $link = '?lang='.$val;
                    $mymenu .= '<li class="nav-item'.$active.'"><a class="nav-link" href="'.$link.'">'.$langindex[$val].'</a></li>';
                }
            }
            return $mymenu;
        }

        /**
         * Convert hex color
         *
         * @param string $colorCode    color to convert
         * @param string $defaultcolor default color
         *
         * @return converted color
         */
        public function hexdecColor($colorCode, $defaultcolor = '#000000')
        {
            // If user accidentally passed along the # sign, strip it off
            $colorCode = ltrim($colorCode, '#');

            $colorCode = strlen($colorCode) > 6 ? substr($colorCode, 0, 6) : $colorCode;
            $colorCode = strlen($colorCode) > 3 && strlen($colorCode) < 6 ? substr($colorCode, 0, 3) : $colorCode;

            if (ctype_xdigit($colorCode)) {
                $converted = hexdec(str_replace('#', '0x', $colorCode));
            } else {
                $converted = hexdec(str_replace('#', '0x', $defaultcolor));
            }
            return $converted;
        }

        /**
         * Random color part
         *
         * @return random color part
         */
        public function randomColorPart()
        {
            return str_pad(dechex(mt_rand(20, 200)), 2, '0', STR_PAD_LEFT);
        }

        /**
         * Random color
         *
         * @return random color
         */
        public function randomColor()
        {
            return '#'.$this->randomColorPart() . $this->randomColorPart() . $this->randomColorPart();
        }


        /**
         * Increases or decreases the brightness of a color by a percentage of the current brightness.
         *
         * @param string $hexCode       Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
         * @param float  $adjustPercent A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
         *
         * @return string
         */
        public function adjustBrightness($hexCode, $adjustPercent)
        {
            $hexCode = ltrim($hexCode, '#');

            if (strlen($hexCode) == 3) {
                $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
            }
            $hexCode = array_map('hexdec', str_split($hexCode, 2));

            foreach ($hexCode as & $color) {
                $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
                $adjustAmount = ceil($adjustableLimit * $adjustPercent);

                $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
            }
            return '#' . implode($hexCode);
        }

        /**
         * Convertt color hex to rgb
         *
         * @param string $htmlCode to convert
         *
         * @return RGB color
         */
        public function HTMLToRGB($htmlCode)
        {
            if ($htmlCode[0] == '#') {
                $htmlCode = substr($htmlCode, 1);
            }

            if (strlen($htmlCode) == 3) {
                $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
            }
            $r = hexdec($htmlCode[0] . $htmlCode[1]);
            $g = hexdec($htmlCode[2] . $htmlCode[3]);
            $b = hexdec($htmlCode[4] . $htmlCode[5]);

            return $b + ($g << 0x8) + ($r << 0x10);
        }

        /**
         * Converto color RGB to HSL
         *
         * @param string $RGB to convert
         *
         * @return HSL color
         */
        public function RGBToHSL($RGB)
        {
            $r = 0xFF & ($RGB >> 0x10);
            $g = 0xFF & ($RGB >> 0x8);
            $b = 0xFF & $RGB;

            $r = ((float)$r) / 255.0;
            $g = ((float)$g) / 255.0;
            $b = ((float)$b) / 255.0;

            $maxC = max($r, $g, $b);
            $minC = min($r, $g, $b);

            $l = ($maxC + $minC) / 2.0;

            if ($maxC == $minC) {
                $s = 0;
                $h = 0;
            } else {
                if ($l < .5) {
                    $s = ($maxC - $minC) / ($maxC + $minC);
                } else {
                    $s = ($maxC - $minC) / (2.0 - $maxC - $minC);
                }
                if ($r == $maxC) {
                    $h = ($g - $b) / ($maxC - $minC);
                }
                if ($g == $maxC) {
                    $h = 2.0 + ($b - $r) / ($maxC - $minC);
                }
                if ($b == $maxC) {
                    $h = 4.0 + ($r - $g) / ($maxC - $minC);
                }
                $h = $h / 6.0;
            }

            $h = (int)round(255.0 * $h);
            $s = (int)round(255.0 * $s);
            $l = (int)round(255.0 * $l);

            return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
        }

        /**
         * Convert color RGB to HSL
         *
         * @param string $selector   css selector
         * @param array  $attributes css attributes
         *
         * @return css rule
         */
        public function setCss($selector = false, $attributes = array())
        {
            $print = '';
            if ($selector && !empty($attributes)) {
                $print = $selector.'{';
                foreach ($attributes as $key => $value) {
                    $print .= $key.':'.$value.';';
                }
                $print .= '}';
            }
            return $print;
        }

        /**
         * Set layout
         *
         * @return update layout option
         */
        public function setLayout()
        {
            global $_CONFIG;
            $getlayout = filter_input(INPUT_GET, "layout", FILTER_SANITIZE_SPECIAL_CHARS);
            $_CONFIG['layout'] = $getlayout ? $getlayout : $this->getConfig('layout');
            $getsidebar = filter_input(INPUT_GET, "sidebar", FILTER_SANITIZE_SPECIAL_CHARS);
            $_CONFIG['sidebar'] = $getsidebar ? $getsidebar : $this->getConfig('sidebar');
            $getbtn = filter_input(INPUT_GET, "btn", FILTER_SANITIZE_SPECIAL_CHARS);
            $_CONFIG['rounded_buttons'] = $getbtn ? false : $this->getConfig('rounded_buttons');
        }

        /**
         * Get main color
         *
         * @param bool $primary primary color
         *
         * @return main color
         */
        public function getMainColor($primary = false)
        {
            $maincolor = $primary ? $primary : $this->randomColor();
            $getcolor = filter_input(INPUT_GET, "color", FILTER_SANITIZE_SPECIAL_CHARS);
            $maincolor = $getcolor ? $getcolor : $maincolor;
            return $maincolor;
        }

        /**
         * Output inline css
         *
         * @param bool $primary primary color
         * @param bool $echo    echo css
         *
         * @return css output
         */
        public function setMainColor($primary = false, $echo = true)
        {
            $maincolor = $this->getMainColor($primary);

            $maintext = '#F6F6F6';
            $rgb = $this->HTMLToRGB($maincolor);
            $hsl = $this->RGBToHSL($rgb);
            $linkcolor = $maincolor;

            if ($hsl->lightness > 185) {
                $maintext = '#333';
                $linkcolor = $maintext;
            }

            if ($maincolor) {
                $maincolor_dark = $this->adjustBrightness($maincolor, -0.3);
                $linkcolor_dark = $this->adjustBrightness($linkcolor, -0.3);
                $output = '<style type="text/css">';

                $output .= ':root {--bs-link-color: '.$linkcolor.';--bs-link-hover-color:'.$linkcolor_dark.';';
                $output .= '--bs-primary-color: '.$maincolor.';}';
                $output .= '.nav-pills, .nav-link {--bs-nav-pills-link-active-bg: '.$maincolor.';}';
                $output .= '.nav, .navbar-nav {--bs-nav-link-hover-color: '.$maincolor_dark.';}';

                $output .= '.btn-primary {--bs-btn-bg: '.$maincolor.';--bs-btn-border-color: '.$maincolor.';--bs-btn-disabled-bg: '.$maincolor.';--bs-btn-disabled-border-color: '.$maincolor.';}';
                $output .= '.btn-primary {--bs-btn-hover-bg: '.$maincolor_dark.';--bs-btn-hover-border-color: '.$maincolor_dark.';--bs-btn-active-bg: '.$maincolor_dark.';--bs-btn-active-border-color: '.$maincolor_dark.';}';

                $output .= '.btn-outline-primary {--bs-btn-color: '.$maincolor.';--bs-btn-border-color: '.$maincolor.';--bs-btn-disabled-bg: '.$maincolor.';--bs-btn-disabled-border-color: '.$maincolor.';}';
                $output .= '.btn-outline-primary {--bs-btn-hover-bg: '.$maincolor.';--bs-btn-hover-border-color: '.$maincolor.';--bs-btn-active-bg: '.$maincolor_dark.';--bs-btn-active-border-color: '.$maincolor.';}';

                $output .= '.dropdown-menu {--bs-dropdown-link-active-bg: '.$maincolor.';}';

                $output .= $this->setCss(
                    '.bg-primary, .nav-pills .nav-link.active, .nav-pills .show > .nav-link, label.custom-file-label:after',
                    array(
                        'color'=> $maintext,
                        'background-color'=> $maincolor.'!important',
                    )
                );


                $output .= '</style>';
            }
            if ($echo) {
                echo $output;
            } else {
                return $output;
            }
        }

        /**
         * Get BTC reates
         *
         * @return BitCoin rates
         */
        public function getBtcRates()
        {
            // $remote_json = "https://bitpay.com/api/rates/BTC/USD";
            // $remote_json = "https://api.coinbase.com/v2/exchange-rates?currency=BTC";
            $remote_json = "https://api.coinbase.com/v2/prices/BTC-USD/spot";

            $json = @file_get_contents($remote_json);

            if ($json) {
                $data = json_decode($json);

                if ($data) {
                    // $btc = $data->data->rates->USD;
                    // $btc = $data->rate;
                    $btc = $data->data->amount;

                    $dollar = round(1/$btc, 8);

                    $output = '<small class="form-text text-muted">1 BTC = ' . rtrim(rtrim(sprintf('%f', $btc), '0'), ".") . ' USD<br />';
                    $output .= '1 USD = '.rtrim(rtrim(sprintf('%f', $dollar), '0'), ".").' BTC</small>';
                    $output .= '<small class="form-text text-muted">Last update: '. date('F d Y').'<br>Spot price from Coinbase</small>';

                    return $output;
                }
            }
        }

        /**
         * Load script CSS
         *
         * @param string $version script version
         *
         * @return load css
         */
        public function loadQRcdrCSS($version = '')
        {
            $relative = $this->relativePath();
            echo '<link href="'.$relative.'js/spectrum/spectrum.min.css" rel="stylesheet">';
            if ($this->getConfig('location') == true) {
                echo '<link href="'.$relative.'js/ol/ol.css" rel="stylesheet">';
            }
            if ($this->getConfig('event') == true) {
                echo '<link href="'.$relative.'js/tempusdominus/css/tempus-dominus.min.css" rel="stylesheet">';
            }
            echo '<link href="'.$relative.'style.css?v='.$version.'" rel="stylesheet">';
        }

        /**
         * Load script JS
         *
         * @param string $version script version
         *
         * @return load scripts
         */
        public function loadQRcdrJS($version = '')
        {
            $relative = $this->relativePath();
            $lang = $this->getLang();

            echo '<script  type="text/javascript" src="js/popper.min.js"></script>';
            // moment.js for event calendar
            if ($this->getConfig('event') == true) {
                echo '<script src="'.$relative.'js/tempusdominus/js/tempus-dominus.min.js"></script>';
                $localepath = $relative.'js/tempusdominus/locales/'.$lang.'.js';
                if (file_exists($localepath)) {
                    echo '<script src="'.$relative.'js/tempusdominus/locales/'.$lang.'.js"></script>';
                }
                // echo '<script src="'.$relative.'js/tempusdominus/js/jQuery-provider.min.js"></script>';
            }
            if ($this->getConfig('debug_mode')) {
                echo '<script type="text/javascript" src="'.$relative.'bootstrap/js/bootstrap.min.js"></script>';
                echo '<script type="text/javascript" src="'.$relative.'js/spectrum/spectrum.min.js"></script>';
                echo '<script type="text/javascript" src="'.$relative.'js/bootstrap-maxlength.min.js"></script>';
                echo '<script type="text/javascript" src="'.$relative.'js/cropit/jquery.cropit.min.js"></script>';
                echo '<script type="text/javascript" src="'.$relative.'js/qrcdr.js?v='.$version.'"></script>';
                echo '<script src="'.$relative.'js/call.js?v='.$version.'"></script>';
            } else {
                echo '<script src="'.$relative.'js/qrcdr.min.js?v='.$version.'"></script>';
                echo '<script src="'.$relative.'js/call.js?v='.$version.'"></script>';
            }
        }

        /**
         * Load optional plugins
         *
         * @return include plugins
         */
        public function loadPlugins()
        {
            $relative = $this->relativePath();
            if (file_exists($relative.'plugins')) {
                $plugins = glob($relative.'plugins/*');
                foreach ($plugins as $plugin) {
                    if (is_dir($plugin)) {
                        $folder = $plugin;
                        if (substr($plugin, 0, strlen($relative)) == $relative) {
                            $folder = substr($plugin, strlen($relative));
                        }
                        $plug = basename($plugin);
                        if (file_exists(dirname(dirname(__FILE__)).'/'.$folder.'/'.$plug.'.php')) {
                            include dirname(dirname(__FILE__)).'/'.$folder.'/'.$plug.'.php';
                        }
                        
                    }
                }
            }
        }

        /**
         * Load optional plugins CSS
         *
         * @param bool $echo echo output
         *
         * @return plugins css
         */
        public function loadPluginsCss($echo = true)
        {
            $relative = $this->relativePath();
            if (file_exists($relative.'plugins')) {
                $pluginscss = glob($relative.'plugins/*/*.css');
                $output = '';
                foreach ($pluginscss as $style) {
                    $output .= '<link href="'.$style.'" rel="stylesheet">';
                }
                if ($echo) {
                    echo $output;
                } else {
                    return $output;
                }
            }
        }
    }

    /**
     * Helper function to get/return the QRcdrFn object
     *
     * @return QRcdrFn object
     */
    function qrcdr()
    {
        return QRcdrFn::getInstance();
    }

    // Get it started.
    qrcdr();
}
