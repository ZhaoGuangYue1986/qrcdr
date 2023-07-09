<?php
/**
 * QRcdr - php QR Code generator
 * lib/class-qrcdr.php
 *
 * PHP version 5.4+
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2019 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @version   3.3
 * @link      http://veno.es/qrcdr/
 */

/**
 * Main QRcdr class
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2019 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @link      http://veno.es/qrcdr/
 */
class QRcdr extends QRcode
{
    /**
     * Create SVG
     *
     * @param string $text         text
     * @param bool   $outfile      outfile
     * @param num    $level        level
     * @param num    $size         size
     * @param num    $margin       margin
     * @param bool   $saveandprint save and print
     * @param string $back_color   back_color
     * @param string $fore_color   fore_color
     * @param bool   $style        style
     *
     * @return SVG
     */
    public static function svg($text, $outfile = false, $level = QR_ECLEVEL_Q, $size = 3, $margin = 4, $saveandprint = false, $back_color = 0xFFFFFF, $fore_color = 0x000000, $style = false)
    {
        $enc = QRencdr::factory($level, $size, $margin, $back_color, $fore_color);
        return $enc->encodeSVG($text, $outfile, $saveandprint, $style);
    }
}

/**
 * QRencdr class
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2019 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @link      http://veno.es/qrcdr/
 */
class QRencdr extends QRencode
{
    public $size;
    public $margin;
    public $fore_color;
    public $back_color;
    public $cmyk;
    /**
     * Factory
     *
     * @param num    $level      level
     * @param num    $size       size
     * @param num    $margin     margin
     * @param string $back_color back_color
     * @param string $fore_color fore_color
     * @param bool   $cmyk       style
     *
     * @return Encoded
     */
    public static function factory($level = QR_ECLEVEL_L, $size = 3, $margin = 4, $back_color = 0xFFFFFF, $fore_color = 0x000000, $cmyk = false)
    {
        $enc = new QRencdr();
        $enc->size = $size;
        $enc->margin = $margin;
        $enc->fore_color = $fore_color;
        $enc->back_color = $back_color;
        $enc->cmyk = $cmyk;

        switch ($level.'') {
        case '0':
        case '1':
        case '2':
        case '3':
            $enc->level = $level;
            break;
        case 'l':
        case 'L':
            $enc->level = QR_ECLEVEL_L;
            break;
        case 'm':
        case 'M':
            $enc->level = QR_ECLEVEL_M;
            break;
        case 'q':
        case 'Q':
            $enc->level = QR_ECLEVEL_Q;
            break;
        case 'h':
        case 'H':
            $enc->level = QR_ECLEVEL_H;
            break;
        }
        return $enc;
    }

    /**
     * Encode SVG
     *
     * @param string $intext       text
     * @param bool   $outfile      outfile
     * @param bool   $saveandprint save and print
     * @param bool   $style        style
     *
     * @return QRvtc
     */
    public function encodeSVG($intext, $outfile = false, $saveandprint = false, $style = false)
    {
        try {
            ob_start();
            $tab = $this->encode($intext);
            $err = ob_get_contents();
            ob_end_clean();
            
            if ($err != '') {
                QRtools::log($outfile, $err);
            }
            
            $maxSize = (int)(QR_PNG_MAXIMUM_SIZE / (count($tab)+2*$this->margin));

            return QRvct::svg($tab, $outfile, min(max(1, $this->size), $maxSize), $this->margin, $saveandprint, $this->back_color, $this->fore_color, $style);

        } catch (Exception $e) {
        
            QRtools::log($outfile, $e->getMessage());
        }
    }
}

/**
 * QRvct class
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015-2019 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @link      http://veno.es/qrcdr/
 */
class QRvct extends QRvect
{
    /**
     * Output Svg
     *
     * @param string $frame         frame
     * @param string $filename      filename
     * @param num    $pixelPerPoint pixelPerPoint
     * @param num    $outerFrame    outerFrame
     * @param bool   $saveandprint  save and print
     * @param string $back_color    back_color
     * @param string $fore_color    fore_color
     * @param array  $style         style
     *
     * @return Save
     */
    public static function svg($frame, $filename = false, $pixelPerPoint = 4, $outerFrame = 4, $saveandprint = false, $back_color = 0xFFFFFF, $fore_color = 0x000000, $style = false)
    {
        $vect = self::_vectSVG($frame, $pixelPerPoint, $outerFrame, $back_color, $fore_color, $style, $saveandprint);
        if ($saveandprint) {
            return QRtools::save($vect, $filename);
        } else {
            return $vect;
        }
    }

    /**
     * Create Svg
     *
     * @param string $frame         frame
     * @param num    $pixelPerPoint pixelPerPoint
     * @param num    $outerFrame    outerFrame
     * @param string $back_color    back_color
     * @param string $fore_color    fore_color
     * @param array  $style         style
     * @param bool   $saveandprint  save or output
     *
     * @return Save
     */
    private static function _vectSVG($frame, $pixelPerPoint = 4, $outerFrame = 4, $back_color = 0xFFFFFF, $fore_color = 0x000000, $style = false, $saveandprint = false)
    {
        include dirname(__FILE__).'/markers.php';

        $watermark = isset($style['optionlogo']) && $style['optionlogo'] !== 'none' ? $style['optionlogo'] : false;
        $no_logo_bg = isset($style['no_logo_bg']) ? $style['no_logo_bg'] : false;

        $markers_color = isset($style['markers_color']) ? $style['markers_color'] : false;
        $markerOut = isset($style['marker_out']) ? $style['marker_out'] : false;
        $markerIn = isset($style['marker_in']) ? $style['marker_in'] : false;
        $markerOutColor = isset($style['marker_out_color']) ? $style['marker_out_color'] : false;
        $markerInColor = isset($style['marker_in_color']) ? $style['marker_in_color'] : false;
        $marker_top_right_outline = isset($style['marker_top_right_outline']) ? $style['marker_top_right_outline'] : $markerOutColor;
        $marker_top_right_center = isset($style['marker_top_right_center']) ? $style['marker_top_right_center'] : $markerInColor;
        $marker_bottom_left_outline = isset($style['marker_bottom_left_outline']) ? $style['marker_bottom_left_outline'] : $markerOutColor;
        $marker_bottom_left_center = isset($style['marker_bottom_left_center']) ? $style['marker_bottom_left_center'] : $markerInColor;

        $transparent_code = isset($style['transparent_code']) ? $style['transparent_code'] : false;
        $bg_image = isset($style['bg_image']) && $style['bg_image'] !== 'none' ? $style['bg_image'] : false;

        $pattern = isset($style['pattern']) ? $style['pattern'] : false;

        $gradient = isset($style['gradient']) ? $style['gradient'] : false;
        $gradient_color = isset($style['gradient_color']) ? $style['gradient_color'] : false;
        $radial = isset($style['radial']) ? $style['radial'] : false;
        $setframe = isset($style['frame']) && $style['frame'] !== 'none' ? $style['frame'] : false;

        $negative = isset($style['negative']) ? $style['negative'] : false;
        $inverted = ($negative && $bg_image) ? true : false;

        $backgroundcolor = $back_color !== 'transparent' ? '#'.str_pad(dechex($back_color), 6, "0", STR_PAD_LEFT) : '#fff';
        $frontcolor = '#'.str_pad(dechex($fore_color), 6, "0", STR_PAD_LEFT);

        $h = count($frame);
        $w = strlen($frame[0]);

        $qrcodeW = $w * $pixelPerPoint;
        $framemargin = $pixelPerPoint*$outerFrame;

        if ($setframe) {
            $frameunit = $qrcodeW/24;
            $framemargin = $frameunit*$outerFrame;
        }

        $realimgW = $qrcodeW + $framemargin*2;
        $frameunit = $realimgW/24;

        $framediff = 0;
        $offtop = 0;
        $frametranslate = '';
        $backgroundsize = $realimgW;
        $backgroundmargin = 0;
        $framelabelpos = 'bottom';

        if ($setframe) {

            include dirname(__FILE__).'/frames.php';

            $custom_frame_color = isset($style['custom_frame_color']) ? $style['custom_frame_color'] : false;

            $framecolor = $gradient ? '#fff' : $frontcolor;
            $framecolor = isset($style['framecolor']) && $custom_frame_color ? $style['framecolor'] : $framecolor;
            $framelabel = isset($style['framelabel']) ? $style['framelabel'] : '';
            $label_font = isset($style['label_font']) ? $style['label_font'] : false;

            $frametype = $setframe;

            $frameborder = isset($frames[$frametype]['frame_border']) ? intval($frames[$frametype]['frame_border']) : 1;
            $framespacer = isset($frames[$frametype]['label_size']) ? $frames[$frametype]['label_size'] : 0;
            $frameoffset = isset($frames[$frametype]['label_offset']) ? $frames[$frametype]['label_offset'] : 0;
            $framelabelpos = $frames[$frametype]['label_pos'];
            $offset = $frameunit*$frameoffset;
            $spacerH = $framespacer*$frameunit;
            $scarto_top = $frameborder-1;
            $framediff = ($frameunit*($framespacer+$frameoffset+1)-$scarto_top);
            $backgroundsize = ($realimgW - $frameborder * 2 * $frameunit)*1.01;

            $frametranslate = $framelabelpos == 'top' ? ' transform="translate(0,'.$framediff.')"' : '';
            $offtop = $framelabelpos == 'top' ? $framediff : 0;

            $textmaxw = $realimgW - $frameunit*2;
            $textmaxh = $spacerH + $frameunit;

            $backgroundmargin = $frameunit*$frameborder;
            $labeltext_color = isset($style['labeltext_color']) ? $style['labeltext_color'] : '#ffffff';
        }

        $realimgH = $realimgW+$framediff;
        $marker_size = $pixelPerPoint*7;
        $marker_margin = $framemargin;
        $opposite_pos = ($realimgW - $marker_size - $marker_margin);
        $marker_size_in = $pixelPerPoint*3;
        $marker_margin_in = $framemargin+$pixelPerPoint*2;
        $opposite_pos_in = ($realimgW - $marker_size_in - $marker_margin_in);

        $markerOutPath = $markerOut && isset($markers[$markerOut]) ? $markers[$markerOut] : $markers['default'];
        $markerInPath = $markerIn && isset($markersIn[$markerIn]) ? $markersIn[$markerIn] : $markersIn['default'];
        $patternPath = $pattern && isset($markersIn[$pattern]) ? $markersIn[$pattern] : $markersIn['default'];

        $rotate_tr_out = $markerOutPath['rotate'] ? ' rotate(90 7 7)' : '';
        $rotate_bl_out = $markerOutPath['rotate'] ? ' rotate(-90 7 7)' : '';
        $rotate_tr_in = $markerInPath['rotate'] ? ' rotate(90 3 3)' : '';
        $rotate_bl_in = $markerInPath['rotate'] ? ' rotate(-90 3 3)' : '';

        $output = '';
        if ($saveandprint) {
            $output .= '<?xml version="1.0" encoding="utf-8"?>'."\n".
            '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">'."\n";
        }
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink" width="'.$realimgW.'" height="'.$realimgH.'" viewBox="0 0 '.$realimgW.' '.$realimgH.'">'."\n";

        if ($watermark) {
            $minwhaterhole = ($h - 16);
            $maxwhaterhole = ($h / 3.5);

            if ($minwhaterhole < $maxwhaterhole) {
                $whaterhole = $minwhaterhole;
                $startpoint = ($h - $whaterhole) / 2;
                $endpoint = ($startpoint + $whaterhole);
                $watermark_size = $whaterhole * $pixelPerPoint;
            } else {
                $whaterhole = $maxwhaterhole;
                $waterholerounded = round($whaterhole, 0, PHP_ROUND_HALF_UP);

                if ($h % 2 == 0) {
                    if ($waterholerounded % 2 == 0) {
                        $waterholefinal = $waterholerounded;
                    } else {
                        $waterholefinal = $waterholerounded+1;
                    }
                } else {
                    if ($waterholerounded % 2 == 0) {
                        $waterholefinal = $waterholerounded+1;
                    } else {
                        $waterholefinal = $waterholerounded;
                    }
                }
                $startpoint = ($h - $waterholefinal) / 2;
                $endpoint = ($startpoint + $waterholefinal);
                $watermark_size = $pixelPerPoint*$waterholefinal;
            }
            $logo_size = isset($style['logo_size']) ? intval($style['logo_size']) : 100;
            $logo_scale = $logo_size/100;
            $watermark_size = $watermark_size*$logo_scale;
        }

// $output .= '<desc></desc>'."\n";
        $fill = $gradient ? '' : 'fill="'.$frontcolor.'"';
        $fill = $inverted ? 'fill="#fff"' : $fill;

        $qrblock = '';

        // Draw frame same color of dots.
        if ($setframe && !$inverted) {
            $qrblock .= '<g transform="scale('.$frameunit.')" fill="'.$framecolor.'">' . $frames[$frametype]['path'].'</g>'."\n";
        }

        $qrblock .= '<g'.$frametranslate.' '.$fill.'>'."\n";

        if ($transparent_code) {
            // (1 - scale) * currentPosition.
            $scaledot = 0.4;
            $centertranslate = (1 - $scaledot)*round($pixelPerPoint/9);
        }

        // Remove points for watermark
        if ($watermark && $no_logo_bg) {
            for ($r=0; $r<$h; $r++) { // each row
                for ($c=0; $c<$w; $c++) { // each col
                    if ($r >= $startpoint && $r < $endpoint && $c >= $startpoint && $c < $endpoint) {
                        $frame[$r][$c] = 'x';
                    }
                }
            }
        }

        for ($r = 0; $r < $h; $r++) { // each row
            for ($c = 0; $c < $w; $c++) { // each col
                if ($transparent_code) {
                    if ($c < 8 && $r < 8) {
                        $frame[$r][$c] = 'x';
                    }
                    if ($c > ($w - 9) && $r < 8) {
                        $frame[$r][$c] = 'x';
                    }
                    if ($c < 8 && $r > ($h - 9)) {
                        $frame[$r][$c] = 'x';
                    }
                }

                $y = ($r * $pixelPerPoint) + $framemargin;
                $x = ($c * $pixelPerPoint) + $framemargin;
                $rowbefore = ($r-1);
                $rowafter = ($r+1);
                $colbefore = ($c-1);
                $colafter = ($c+1);
                $trbl = '';
                $hake = '';
                if ($pattern == 'shake') {
                    $hake = ' rotate('.rand(-10, 10).')';
                }

                if ($rowbefore >= 0 && isset($frame[$rowbefore][$c]) && $frame[$rowbefore][$c] == '1') {
                    $trbl .= 't';
                }
                if (isset($frame[$r][$colafter]) && $frame[$r][$colafter] == '1') {
                    $trbl .= 'r';
                }
                if (isset($frame[$rowafter][$c]) && $frame[$rowafter][$c] == '1') {
                    $trbl .= 'b';
                }
                if ($colbefore >= 0 && isset($frame[$r][$colbefore]) && $frame[$r][$colbefore] == '1') {
                    $trbl .= 'l';
                }
                $trbl = strlen($trbl) > 2 && !isset($patternPath[$trbl]) ? 'trbl' : $trbl;
                $path = isset($patternPath[$trbl]) ? $trbl : 'path';

                if ($frame[$r][$c] == '1') {
                    if ($transparent_code && !$inverted) {
                        $qrblock .= '<g transform="translate('.$x.','.$y.') scale('.($pixelPerPoint/6).')'.$hake.'"><g transform="translate('.$centertranslate.','.$centertranslate.') scale('.$scaledot.')">' . $patternPath[$path].'</g></g>'."\n";
                        $qrblock .= '<g transform="translate('.$x.','.$y.') scale('.($pixelPerPoint/6).')'.$hake.'"><g opacity="0.1">' . $patternPath[$path].'</g></g>'."\n";
                    } else {
                        $qrblock .= '<g transform="translate('.$x.','.$y.') scale('.($pixelPerPoint/6*1.03).')'.$hake.'">' . $patternPath[$path].'</g>'."\n";
                    }
                }

                // Light markers for transparent code
                if ($frame[$r][$c] == '0' && $transparent_code && !$inverted) {
                    $qrblock .= '<g fill="'.$backgroundcolor.'" transform="translate('.$x.','.$y.') scale('.($pixelPerPoint/6).')'.$hake.'"><g transform="translate('.$centertranslate.','.$centertranslate.') scale('.$scaledot.')">' . $patternPath[$path].'</g></g>'."\n";
                    $qrblock .= '<g fill="'.$backgroundcolor.'" transform="translate('.$x.','.$y.') scale('.($pixelPerPoint/6).')'.$hake.'"><g opacity="0.1">' . $patternPath[$path].'</g></g>'."\n";
                }
            }
        }

        /*
        // Markers bg for transparent code
        // if ($transparent_code) {
        //     $start_top_row = $framemargin-$pixelPerPoint;
        //     $end_top_row = 9;

        //     $start_bottom_row = ($h - 8)*$pixelPerPoint+$framemargin;
        //     $end_bottom_row = ($h);

        //     $start_left_col = $framemargin-$pixelPerPoint;
        //     $end_left_col = 9;

        //     $start_right_col = ($w - 8)*$pixelPerPoint+$framemargin;
        //     $end_right_col = ($w);

        //     $qrblock .= '<rect opacity="0.8" fill="'.$backgroundcolor.'" width="'.(9*$pixelPerPoint).'" height="'.(9*$pixelPerPoint).'" x="'.$start_left_col.'" y="'.$start_top_row.'" />';
        //     $qrblock .= '<rect opacity="0.8" fill="'.$backgroundcolor.'" width="'.(9*$pixelPerPoint).'" height="'.(9*$pixelPerPoint).'" x="'.$start_right_col.'" y="'.$start_top_row.'" />';
        //     $qrblock .= '<rect opacity="0.8" fill="'.$backgroundcolor.'" width="'.(9*$pixelPerPoint).'" height="'.(9*$pixelPerPoint).'" x="'.$start_left_col.'" y="'.$start_bottom_row.'" />';
        // }
        */

        if (!$markers_color) {
            $outblocks = '<g transform="translate('.$marker_margin.','.$marker_margin.')"><g transform="scale('.($pixelPerPoint/2).')">'.$markerOutPath['path'].'</g></g>'."\n";
            $outblocks .= '<g transform="translate('.$opposite_pos.','.$marker_margin.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_out.'">'.$markerOutPath['path'].'</g></g>'."\n";
            $outblocks .= '<g transform="translate('.$marker_margin.','.$opposite_pos.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_out.'">'.$markerOutPath['path'].'</g></g>'."\n";
            $inblocks = '<g transform="translate('.$marker_margin_in.','.$marker_margin_in.')"><g transform="scale('.($pixelPerPoint/2).')">'.$markerInPath['path'].'</g></g>'."\n";
            $inblocks .= '<g transform="translate('.$opposite_pos_in.','.$marker_margin_in.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_in.'">'.$markerInPath['path'].'</g></g>'."\n";
            $inblocks .= '<g transform="translate('.$marker_margin_in.','.$opposite_pos_in.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_in.'">'.$markerInPath['path'].'</g></g>'."\n";

            if ($transparent_code && !$inverted) {
                $qrblock .= '<g stroke-opacity="0.6" stroke-width="4" stroke="'.$backgroundcolor.'">'.$outblocks.'</g>';
            }
            $qrblock .= $outblocks;
            $qrblock .= $inblocks;
        }

        $qrblock .= '</g>';

        $maskurl = $inverted ? ' mask="url(#qrmask)"' : '';

        if ($gradient || $inverted) {
            $output .= '<defs>';
            if ($gradient) {
                if ($radial) {
                    $output .= '<radialGradient id="pattern-mask" cx="50%" cy="50%" r="50%" fx="50%" fy="50%" gradientUnits="userSpaceOnUse">';
                    $output .= '<stop offset="0%" stop-color="'.$frontcolor.'" />';
                    $output .= '<stop offset="100%" stop-color="'.$gradient_color.'" /></radialGradient>'."\n";
                } else {
                    $output .= '<linearGradient id="pattern-mask" x1="0%" y1="0%" x2="12%" y2="100%" gradientUnits="userSpaceOnUse">';
                    $output .= '<stop offset="0%" stop-color="'.$frontcolor.'" />';
                    $output .= '<stop offset="100%" stop-color="'.$gradient_color.'" /></linearGradient>'."\n";
                }
            }

            $fill = 'fill="url(#pattern-mask)"';
            $output .= '<mask id="qrmask"><g fill="#ffffff">';
            $output .= $qrblock;
            $output .= '</g></mask>';

            $output .= '</defs>'."\n";
        }

        if ($back_color !== 'transparent') {
            $output .= '<rect width="'.$backgroundsize.'" height="'.$backgroundsize.'" fill="'.$backgroundcolor.'" x="'.$backgroundmargin.'" y="'.($backgroundmargin+$offtop).'" />'."\n";
        }

        // Draw background.
        if ($bg_image) {
            $output .= '<image'.$maskurl.' xlink:href="'.$bg_image.'" width="'.$backgroundsize.'" height="'.$backgroundsize.'" x="'.$backgroundmargin.'" y="'.($backgroundmargin+$offtop).'" />'."\n";
        }

        if ($gradient) {
            $output .= '<rect x="0" y="0" width="'.$realimgW.'" height="'.$realimgH.'" mask="url(#qrmask)" '.$fill.' />'."\n";
        } else {
            if (!$inverted) {
                $output .= $qrblock;
            }
        }

        // Draw frame with custom color.
        if ($setframe && ($inverted || $custom_frame_color)) {
            $output .= '<g fill="'.$framecolor.'" transform="scale('.$frameunit.')">' . $frames[$frametype]['path'].'</g>'."\n";
        }

        if ($markers_color) {
            $marker_in_fill = $markerInColor ? ' fill="'.$markerInColor.'"' : ' fill="'.$frontcolor.'"';
            $marker_out_fill = $markerOutColor ? ' fill="'.$markerOutColor.'"' : ' fill="'.$frontcolor.'"';
            $marker_in_tr_fill = $marker_top_right_center ? ' fill="'.$marker_top_right_center.'"' : ' fill="'.$frontcolor.'"';
            $marker_out_tr_fill = $marker_top_right_outline ? ' fill="'.$marker_top_right_outline.'"' : ' fill="'.$frontcolor.'"';
            $marker_in_bl_fill = $marker_bottom_left_center ? ' fill="'.$marker_bottom_left_center.'"' : ' fill="'.$frontcolor.'"';
            $marker_out_bl_fill = $marker_bottom_left_outline ? ' fill="'.$marker_bottom_left_outline.'"' : ' fill="'.$frontcolor.'"';

            $outblocks = '<g transform="translate('.$marker_margin.','.$marker_margin.')" '.$marker_out_fill.'><g transform="scale('.($pixelPerPoint/2).')">' . $markerOutPath['path'].'</g></g>'."\n";
            $outblocks .= '<g transform="translate('.$opposite_pos.','.$marker_margin.')" '.$marker_out_tr_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_out.'">' . $markerOutPath['path'].'</g></g>'."\n";
            $outblocks .= '<g transform="translate('.$marker_margin.','.$opposite_pos.')" '.$marker_out_bl_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_out.'">' . $markerOutPath['path'].'</g></g>'."\n";

            $inblocks = '<g transform="translate('.$marker_margin_in.','.$marker_margin_in.')" '.$marker_in_fill.'><g transform="scale('.($pixelPerPoint/2).')">' . $markerInPath['path'].'</g></g>'."\n";
            $inblocks .= '<g transform="translate('.$opposite_pos_in.','.$marker_margin_in.')" '.$marker_in_tr_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_in.'">' . $markerInPath['path'].'</g></g>'."\n";
            $inblocks .= '<g transform="translate('.$marker_margin_in.','.$opposite_pos_in.')" '.$marker_in_bl_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_in.'">' . $markerInPath['path'].'</g></g>';

            $output .= '<g'.$frametranslate.'>';

            if ($transparent_code && !$inverted) {
                $output .= '<g stroke-opacity="0.6" stroke-width="4" stroke="'.$backgroundcolor.'">'.$outblocks.'</g>';
            }

            $output .= $outblocks;
            $output .= $inblocks;
            $output .= '</g>'."\n";
        }

        if ($setframe && $framelabel && $label_font) {
            $label_text_size = isset($style['label_text_size']) ? intval($style['label_text_size']) : 100;
            $label_scale = $label_text_size/100;

            if (substr($label_font, -4) === '.svg') {
                include dirname(__FILE__).'/EasySVG.php';

                $text = html_entity_decode($framelabel);
                $svg = new EasySVG();
                $svg->setFont(dirname(__FILE__).'/fonts/'.$label_font, 100, $labeltext_color);
                $svg->addText($text);

                // set width/height according to text.
                list($textWidth, $textHeight) = $svg->textDimensions($text);
                if ($textWidth > 0 && $textHeight > 0) {
                    $textXscale = $qrcodeW / $textWidth;
                    $textYscale = $textmaxh / $textHeight;
                    $textscale = min($textXscale, $textYscale)*$label_scale;
                    $textoffX = $textmaxw/2 - ($textWidth*$textscale)/2 + $frameunit;
                    $textoffY = $textmaxh/2 - ($textHeight*$textscale)/2;
                    $textpathy = $framelabelpos == 'bottom' ? $realimgW+$offset-($textHeight/3*$textscale) : 0;
                    $textpathy = $framelabelpos == 'top' && $textscale < 0.5 ? $textscale*$frameunit : $textpathy;
                    $output .= '<g transform="translate('.$textoffX.','.($textpathy+$textoffY).') scale('.$textscale.')">'. $svg->asPath() .'</g>';
                }
            } else {
                $fontsize = $spacerH*$label_scale;
                $texty = ($framespacer+1)*$frameunit - $framespacer/2*$frameunit + $fontsize/2.6;
                $texttranslate = $framelabelpos == 'bottom' ? ' transform="translate(0,'.($realimgW-$frameunit+$offset).')"' : '';
                $textadjust = ' text-anchor="middle" x="'.($realimgW/2).'"';
                $output .= '<g><text fill="'.$labeltext_color.'" font-family="Arial, Helvetica, sans-serif" font-size="'.$fontsize.'px"'.$textadjust.' y="'.$texty.'"'.$texttranslate.'>'.$framelabel.'</text></g>';
            }
        }

        if ($watermark) {
            $base64 = false;
            $basemark = 'data:image/';
            if (substr($watermark, 0, strlen($basemark)) === $basemark) {
                $base64 = $watermark;
            } else {
                $path = dirname(dirname(__FILE__)).'/images/watermarks/'.basename($watermark);
                if (file_exists($path)) {
                    $mimetype = mime_content_type($path);
                    $type = $mimetype == 'image/svg' ? $mimetype.'+xml' : $mimetype;
                    $data = file_get_contents($path);
                    $base64 = 'data:' . $type . ';base64,'.base64_encode($data);
                }
            }

            if ($base64) {
                $watermark_pos = $realimgW/2 - $watermark_size/2;
                $watermark_pos_y = $setframe && $framelabelpos == 'top' ? $watermark_pos + $framediff : $watermark_pos;
                $output .= '<image xlink:href="'.$base64.'" width="'.$watermark_size.'" height="'.$watermark_size.'" x="'.$watermark_pos.'" y="'.$watermark_pos_y.'"/>'."\n";
            }
        }
        $output .= '</svg>';

        return $output;
    }
}
