<?php
$accordion_parent = qrcdr()->getConfig('accordion') == true ? ' data-bs-parent="#collapseSettings" data-parent="#collapseSettings"' : '';
$collapsed = qrcdr()->getConfig('accordion') == true ? '' : ' show';
?>
<div class="accordion" id="collapseSettings">
    <div class="accordion-item d-grid">
        <button class="mb-2 btn btn-outline-primary btn-lg btn-block text-start text-left<?php echo $rounded_btn_opt; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseColors">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor"><path d="M18.717 8.831c-.734.824-.665 2.087.158 2.825l-1.333 1.491-7.455-6.667 1.334-1.49c.822.736 2.087.666 2.822-.159l3.503-3.831c.593-.663 1.414-1 2.238-1 1.666 0 3.016 1.358 3.016 2.996 0 .723-.271 1.435-.779 2.005l-3.504 3.83zm-8.217 6.169h-2.691l3.928-4.362-1.491-1.333-7.9 8.794c-1.277 1.423-.171 2.261-1.149 4.052-.135.244-.197.48-.197.698 0 .661.54 1.151 1.141 1.151.241 0 .492-.079.724-.256 1.733-1.332 2.644-.184 3.954-1.647l7.901-8.792-1.491-1.333-2.729 3.028z"/></svg> <span class="vertical-middle"><?php echo qrcdr()->getString('colors'); ?></span>
        </button>
        <div class="collapse<?php echo $collapsed; ?>" id="collapseColors"<?php echo $accordion_parent; ?>>
            <div class="col-sm-12 mb-2 custom-background">
                <div class="row">
                    <div class="col-sm-6">
                        <label><?php echo qrcdr()->getString('background'); ?></label>
                        <div class="collapse show" id="collapse-background">
                            <input type="text" class="form-control qrcolorpicker colorpickerback rounded-0 ltr" value="<?php echo $stringbackcolor; ?>" name="backcolor">
                        </div>
                        <div class="form-check form-switch mt-2">
                          <input type="checkbox" class="form-check-input" id="trans-bg" name="transparent">
                          <label class="form-check-label" for="trans-bg"><?php echo qrcdr()->getString('transparent_background'); ?></label>
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input type="checkbox" class="form-check-input collapse-control" id="transparent-qr" data-bs-target="#collapse-image-bg" data-target="#collapse-image-bg" name="transparent_code">
                            <label class="form-check-label" for="transparent-qr"><?php echo qrcdr()->getString('background_image'); ?></label>
                        </div>
                        <div class="collapse" id="collapse-image-bg">
                            <div class="image-editor ltr">
                                <button title="<?php echo qrcdr()->getString('background_image'); ?>" type="button" class="btn btn-primary select-image-btn rounded-0"><i class="fa fa-upload"></i></button>
                                <button type="button" class="btn btn-primary export-bg-image d-none rounded-0"><i class="fa fa-check"></i></button>
                                <button type="button" class="btn btn-primary remove-bg-image d-none rounded-0"><i class="fa fa-close"></i></button>
                                <input type="file" class="cropit-image-input nopreview">
                                <div class="cropit-preview mx-auto"></div>
                                <input type="range" class="cropit-image-zoom-input qrcdr-slider-input nopreview">
                            </div>
                            <input id="bg_image" type="hidden" name="bg_image">
                            <div class="form-check form-switch d-none negative-code">
                                <input type="checkbox" class="form-check-input" id="negative-qr" name="negative_qr">
                                <label class="form-check-label" for="negative-qr"><?php echo qrcdr()->getString('masked'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label><?php echo qrcdr()->getString('foreground'); ?></label>
                        <input type="text" class="form-control qrcolorpicker rounded-0 ltr" value="<?php echo $stringfrontcolor; ?>" name="frontcolor">

                        <div class="form-group">
                            <div class="form-check form-switch">
                              <input type="checkbox" class="form-check-input collapse-control" id="gradient-bg" data-bs-target="#collapse-gradient" data-target="#collapse-gradient" name="gradient">
                              <label class="form-check-label" for="gradient-bg"><?php echo qrcdr()->getString('gradient'); ?></label>
                            </div>
                        </div>
                        <div class="collapse" id="collapse-gradient">
                            <label><?php echo qrcdr()->getString('second_color'); ?></label>
                            <input type="text" class="form-control qrcolorpicker qrcolorpicker_bg rounded-0 ltr" value="#8900D5" name="gradient_color">
                            <div class="form-group">
                                <div class="form-check form-switch">
                                  <input type="checkbox" class="form-check-input" id="radial-gradient" name="radial">
                                  <label class="form-check-label" for="radial-gradient"><?php echo qrcdr()->getString('radial'); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item d-grid">
    <button class="mb-2 btn btn-outline-primary btn-lg btn-block text-start text-left<?php echo $rounded_btn_opt; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStyle">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 24 24"><path d="M21 21v3h3v-3h-1v-1h-1v1h-1zm2 1v1h-1v-1h1zm-23 2h8v-8h-8v8zm1-7h6v6h-6v-6zm20 3v-1h1v1h-1zm-19-2h4v4h-4v-4zm8-3v2h-1v-2h1zm2-8h1v1h-1v-1zm1-1h1v1h-1v-1zm1 2v-1h1v1h-1zm0-2h1v-6h-3v1h-3v1h3v1h2v3zm-1-4v-1h1v1h-1zm-7 4h-4v-4h4v4zm6 0h-1v-2h-2v-1h3v1h1v1h-1v1zm-4-6h-8v8h8v-8zm-1 7h-6v-6h6v6zm3 0h-1v-1h2v2h-1v-1zm-3 3v1h-1v-1h1zm15 6h2v3h-1v-1h-2v1h-1v-1h-1v-1h1v-1h1v1h1v-1zm-4 2h-1v1h-1v-1h-1v-1h1v-1h-2v-1h-1v1h-1v1h-2v1h-1v6h5v-1h-1v-2h-1v2h-2v-1h1v-1h-1v-1h3v-1h2v2h-1v1h1v2h1v-2h1v1h1v-1h1v-2h1v-1h-2v-1zm-1 3h-1v-1h1v1zm6-6v-2h1v2h-1zm-9 5v1h-1v-1h1zm5 3v-1h1v2h-2v-1h1zm-3-23v8h8v-8h-8zm7 7h-6v-6h6v6zm-1-1h-4v-4h4v4zm1 4h1v2h-1v1h-2v-4h1v2h1v-1zm-4 6v-3h1v3h-1zm-13-7v1h-2v1h1v1h-3v-1h1v-1h-2v1h-1v-2h6zm-1 4v-1h1v3h-1v-1h-1v1h-1v-1h-1v1h-2v-1h1v-1h4zm-4-1v1h-1v-1h1zm19-2h-1v-1h1v1zm-13 4h1v1h-1v-1zm15 2h-1v-1h1v1zm-5 1v-1h1v1h-1zm-1-1h1v-3h2v-1h1v-1h-1v-1h-2v-1h-1v1h-1v-1h-1v1h-1v-1h-1v1h-1v1h-1v-1h1v-1h-4v1h2v1h-2v1h1v2h1v-1h2v2h1v-4h1v2h3v1h-2v1h2v1zm1-5h1v1h-1v-1zm-2 1h-1v-1h1v1z"/></svg> <span class="vertical-middle"><?php echo qrcdr()->getString('design'); ?></span>
    </button>
    <div class="collapse<?php echo $collapsed; ?>" id="collapseStyle"<?php echo $accordion_parent; ?>>
        <?php
        require dirname(dirname(__FILE__)).'/lib/markers.php';

        $patterns = $markersIn;

        $styleselecta = '<div class="styleselecta d-inline-block">';
        foreach ($patterns as $marker => $values) {
            if (isset($values['preview'])) {
                $activeattr = ($marker == 'default') ? 'checked' : '';
$styleselecta .= '<input type="radio" name="pattern" id="pattern_'.$marker.'" value="'.$marker.'" '.$activeattr.' class="btn-check" autocomplete="off"><label class="btn btn-light p-1 me-1 mb-1 rounded-0" for="pattern_'.$marker.'"><svg width="38" height="38" viewBox="0 0 6 6" xmlns="http://www.w3.org/2000/svg">'.$values['preview'].'</svg></label>';
            }
        }
        $styleselecta .= '</div>';

        $markerselecta = '<div class="btn-group-toggle styleselecta d-inline-block">';
        foreach ($markers as $marker => $values) {
            $activeattr = ($marker == 'default') ? 'checked' : '';
$markerselecta .= '<input type="radio" name="marker_out" id="marker_out_'.$marker.'" value="'.$marker.'" '.$activeattr.' class="btn-check" autocomplete="off"><label for="marker_out_'.$marker.'" class="btn btn-light p-1 me-1 mb-1"><svg width="32" height="32" viewBox="0 0 14 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'.$values['path'].'</svg></label>';
        }
        $markerselecta .= '</div>';

        $markerselectaIn = '<div class="btn-group-toggle styleselecta d-inline-block">';
        foreach ($markersIn as $marker => $values) {
            if (isset($values['marker']) && $values['marker'] === true) {
                $activeattr = ($marker == 'default') ? 'checked' : '';
$markerselectaIn .= '<input type="radio" name="marker_in" id="marker_in_'.$marker.'" value="'.$marker.'" '.$activeattr.' class="btn-check" autocomplete="off"><label for="marker_in_'.$marker.'" class="btn btn-light p-1 me-1 mb-1"><svg width="14" height="14" viewBox="0 0 6 6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'.$values['path'].'</svg></label>';
            }
        }
        $markerselectaIn .= '</div>';

        require dirname(dirname(__FILE__)).'/lib/frames.php';

        $frameselecta = '<div class="btn-group-toggle styleselecta d-inline-block">';
        foreach ($frames as $frame => $values) {
            $activeattr = $frame == 'none' ? 'checked' : '';
            $viewH = isset($values['label_size']) && isset($values['label_offset']) ? (24 + $values['label_size'] + 2 + $values['label_offset']) : 24;
            $frameselecta .= '<input type="radio" name="outer_frame" id="outer_frame_'.$frame.'" value="'.$frame.'" '.$activeattr.' class="btn-check" autocomplete="off">
            <label for="outer_frame_'.$frame.'" class="btn btn-light p-1"><svg width="48" height="56" viewBox="0 0 24 '.$viewH.'" fill="currentColor" xmlns="http://www.w3.org/2000/svg">'.$values['path'].'</svg>
            </label>';
        }
        $frameselecta .= '</div>';
        ?>
        <div class="col-12">
            <label><?php echo qrcdr()->getString('pattern'); ?></label>
        </div>
        <div class="col-12 mb-2">
            <?php echo $styleselecta; ?>
        </div>
        <div class="col-12">
            <label><?php echo qrcdr()->getString('marker_outline'); ?></label>
        </div>
        <div class="col-12 mb-2">
            <?php echo $markerselecta; ?>
        </div>
        <div class="col-12">
            <label><?php echo qrcdr()->getString('marker_center'); ?></label>
        </div>
        <div class="col-12">
            <?php echo $markerselectaIn; ?>
        </div>

        <div class="col-12 mb-2">
            <div class="row collapse collapse-markers-bg">
                <div class="col-sm-6 mt-2">
                    <label><?php echo qrcdr()->getString('marker_outline'); ?></label>
                    <div class="input-group rounded-0">
                      <span class="input-group-text rounded-0 border-0 text-dark"><svg width="1em" height="1em" viewBox="0 0 14 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M0,0v14h14V0H0z M12,12H2V2h10V12z"></path></svg></span>
                      <input type="text" class="qrcolorpicker form-control rounded-0" value="<?php echo $stringfrontcolor; ?>" name="marker_out_color">
                    </div>
                </div>

                <div class="col-sm-6 mt-2">
                    <label><?php echo qrcdr()->getString('marker_center'); ?></label>
                    <div class="input-group rounded-0">
                      <span class="input-group-text rounded-0 border-0 text-dark"><svg width="1em" height="1em" viewBox="0 0 6 6" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><rect width="6" height="6"></rect></svg></span>
                      <input type="text" class="qrcolorpicker form-control rounded-0" value="<?php echo $stringfrontcolor; ?>" name="marker_in_color">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-2">
                    <div class="form-check form-switch">
                      <input type="checkbox" class="form-check-input collapse-control" id="markers-bg" data-bs-target=".collapse-markers-bg" data-target=".collapse-markers-bg" name="markers_color">
                      <label class="form-check-label" for="markers-bg"><?php echo qrcdr()->getString('custom_markers_colors'); ?></label>
                    </div>
                </div>
            </div>

            <div class="collapse collapse-markers-bg">
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="form-check form-switch">
                          <input type="checkbox" class="form-check-input collapse-control" id="different-markers-bg" data-bs-target="#collapse-different-markers-bg" data-target="#collapse-different-markers-bg" name="different_markers_color">
                          <label class="form-check-label" for="different-markers-bg"><?php echo qrcdr()->getString('different_markers_colors'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="row collapse" id="collapse-different-markers-bg">
                    <div class="col-sm-6 mt-2">
                        <label><?php echo qrcdr()->getString('top_right'); ?></label>
                        <div class="input-group rounded-0">
                          <span class="input-group-text rounded-0 border-0 text-dark"><svg width="1em" height="1em" viewBox="0 0 14 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M0,0v14h14V0H0z M12,12H2V2h10V12z"></path></svg></span>
                          <input type="text" class="qrcolorpicker form-control rounded-0" value="<?php echo $stringfrontcolor; ?>" name="marker_top_right_outline">
                        </div>
                    </div>

                    <div class="col-sm-6 mt-2">
                        <label><?php echo qrcdr()->getString('top_right'); ?></label>
                        <div class="input-group rounded-0">
                          <span class="input-group-text rounded-0 border-0 text-dark"><svg width="1em" height="1em" viewBox="0 0 6 6" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><rect width="6" height="6"></rect></svg></span>
                          <input type="text" class="qrcolorpicker form-control rounded-0" value="<?php echo $stringfrontcolor; ?>" name="marker_top_right_center">
                        </div>
                    </div>

                    <div class="col-sm-6 mt-2 mb-2">
                        <label><?php echo qrcdr()->getString('bottom_left'); ?></label>
                        <div class="input-group rounded-0">
                          <span class="input-group-text rounded-0 border-0 text-dark"><svg width="1em" height="1em" viewBox="0 0 14 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M0,0v14h14V0H0z M12,12H2V2h10V12z"></path></svg></span>
                          <input type="text" class="qrcolorpicker form-control rounded-0" value="<?php echo $stringfrontcolor; ?>" name="marker_bottom_left_outline">
                        </div>
                    </div>

                    <div class="col-sm-6 mt-2 mb-2">
                        <label><?php echo qrcdr()->getString('bottom_left'); ?></label>
                        <div class="input-group rounded-0">
                          <span class="input-group-text rounded-0 border-0 text-dark"><svg width="1em" height="1em" viewBox="0 0 6 6" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><rect width="6" height="6"></rect></svg></span>
                          <input type="text" class="qrcolorpicker form-control rounded-0" value="<?php echo $stringfrontcolor; ?>" name="marker_bottom_left_center">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    
    <div class="accordion-item d-grid">
    <button class="mb-2 btn btn-outline-primary btn-lg btn-block text-start text-left<?php echo $rounded_btn_opt; ?>" type="button" data-bs-toggle="collapse" data-toggle="collapse" data-bs-target="#collapseWatermark" data-target="#collapseWatermark">
        <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.273 2.513l-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"/><path fill-rule="evenodd" d="M10.354 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/></svg> <span class="vertical-middle"><?php echo qrcdr()->getString('logo'); ?></span>
    </button>
    <div class="collapse<?php echo $collapsed; ?>" id="collapseWatermark"<?php echo $accordion_parent; ?>>
    <?php
    if (qrcdr()->getConfig('uploader') == true) {
        ?>
    <div class="col-12">
        <small><?php echo qrcdr()->getString('upload_or_select_watermark'); ?></small>
        <div class="custom-file">
          <input type="file" name="file" class="custom-file-input form-control" aria-describedby="validate-upload" id="upmarker">
            <div id="validate-upload" class="invalid-feedback">
                <?php echo qrcdr()->getString('invalid_image'); ?>
            </div>
          <label class="custom-file-label" for="upmarker"></label>
        </div>
    </div>
        <?php
    }
    /**
    * Watermarks
    */
    $waterdir = $relative."images/watermarks/";
    $watermarks = glob($waterdir.'*.{gif,jpg,png,svg}', GLOB_BRACE);
    $count = count($watermarks);
    if (qrcdr()->getConfig('uploader') == true || $count > 0) {
        $listwatermarks = '';
        foreach ($watermarks as $key => $water) {
            $altImg = str_replace(array('-', '_'), ' ', pathinfo($water, PATHINFO_FILENAME));
            $watervalue = $water;

            if (substr($water, 0, strlen($relative)) == $relative) {
                $watervalue = substr($water, strlen($relative));
            }
            $listwatermarks .= '<input id="water_'.$key.'" type="radio" name="optionlogo" value="'.$watervalue.'"';
            if ($optionlogo == $watervalue) $listwatermarks .= ' checked';
            $listwatermarks .= ' id="optionlogo'.$key.'" class="btn-check">';
            $listwatermarks .= '<label for="water_'.$key.'" class="btn btn-light"><img alt="'.$altImg.'" src="'.$water.'"></label>';
        }
        ?>
        <div class="col-12 pt-2">
            <div class="logoselecta form-group">
                <div class="btn-group-toggle" data-bs-toggle="buttons">
                    <label class="btn btn-light">
                        <input type="radio" name="optionlogo" value="none" checked="" class="btn-check">
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </label><?php echo $listwatermarks; ?>
                    <label class="btn btn-light custom-watermark"><input type="radio" name="optionlogo" value="" class="btn-check"><div class="hold-custom-watermark"></div></label>
                </div>
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="form-check form-switch">
              <input type="checkbox" class="form-check-input" id="no-logo-bg" name="no_logo_bg">
              <label class="form-check-label" for="no-logo-bg"><?php echo qrcdr()->getString('no_logo_background'); ?></label>
            </div>
        </div>

        <div class="col-12 qrcdr-slider mb-3">
            <input type="range" min="30" max="100" value="100" class="qrcdr-slider-input" name="logo_size">
            <label class="small"><?php echo qrcdr()->getString('logo_size'); ?>: <span class="qrcdr-slider-value"></span></label>
        </div>
        <?php
    }
    ?>
    </div> <!-- collapse logo -->
    </div>

    <div class="accordion-item d-grid">

    <button class="mb-2 btn btn-outline-primary btn-lg btn-block text-start text-left<?php echo $rounded_btn_opt; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFrame">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 24 24"><path d="M16 0v2h-8v-2h8zm0 24v-2h-8v2h8zm2-22h4v4h2v-6h-6v2zm-18 14h2v-8h-2v8zm2-10v-4h4v-2h-6v6h2zm22 2h-2v8h2v-8zm-2 10v4h-4v2h6v-6h-2zm-16 4h-4v-4h-2v6h6v-2z"/></svg> <span class="vertical-middle"><?php echo qrcdr()->getString('frame'); ?></span>
    </button>
    <div class="collapse<?php echo $collapsed; ?>" id="collapseFrame"<?php echo $accordion_parent; ?>>
        <div class="col-12 mb-2 py-2">
            <?php echo $frameselecta; ?>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-sm-6">
                    <label><?php echo qrcdr()->getString('frame_label'); ?></label>
                    <input class="form-control" type="text" name="framelabel" value="<?php echo qrcdr()->getString('scan_me'); ?>">
                </div>
                <div class="col-sm-6">
                    <label><?php echo qrcdr()->getString('label_font'); ?></label>
                    <select name="label_font" class="form-select custom-select">
                        <?php
                        if ($rtl['dir'] == 'rtl') {
                            ?>
                        <option value="Arial, Helvetica, sans-serif">
                            Sans serif
                        </option>
                            <?php  
                        } else {
                            $fontdir = dirname(dirname(__FILE__)).'/lib/fonts';
                            $getfonts = glob($fontdir.'/*.svg');
                            foreach ($getfonts as $key => $font) {
                                ?>
                        <option value="<?php echo basename($font); ?>">
                                <?php echo basename($font, '.svg'); ?>
                        </option>
                                <?php
                            }
                        } ?>
                    </select>
                </div>
                <div class="col-12 qrcdr-slider">
                    <input type="range" min="10" max="100" value="100" class="qrcdr-slider-input" name="label-text-size">
                    <label class="small"><?php echo qrcdr()->getString('text_size'); ?>: <span class="qrcdr-slider-value"></span></label>
                </div>
            </div>
        </div>
        <div class="col-12 mb-2">
            <div class="row collapse" id="collapse-frame-color">
                <div class="col-sm-6 mt-2">
                    <label><?php echo qrcdr()->getString('frame_color'); ?></label>
                    <input type="text" class="form-control qrcolorpicker rounded-0" value="<?php echo $stringfrontcolor; ?>" name="framecolor">
                </div>
            </div>

            <div class="form-group mt-2">
                <div class="form-check form-switch">
                  <input type="checkbox" class="form-check-input collapse-control" id="frame-color" data-bs-target="#collapse-frame-color" data-target="#collapse-frame-color" name="custom_frame_color">
                  <label class="form-check-label" for="frame-color"><?php echo qrcdr()->getString('custom_frame_color'); ?></label>
                </div>
            </div>
        </div>
    </div> <!-- collapse frame -->
    </div>
    
    <div class="accordion-item d-grid">
    <button class="mb-2 btn btn-outline-primary btn-lg btn-block text-start text-left<?php echo $rounded_btn_opt; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOptions">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-toggles" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.5 9a3.5 3.5 0 1 0 0 7h7a3.5 3.5 0 1 0 0-7h-7zm7 6a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm-7-14a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm2.45 0A3.49 3.49 0 0 1 8 3.5 3.49 3.49 0 0 1 6.95 6h4.55a2.5 2.5 0 0 0 0-5H6.95zM4.5 0h7a3.5 3.5 0 1 1 0 7h-7a3.5 3.5 0 1 1 0-7z"/></svg> <span class="vertical-middle"><?php echo qrcdr()->getString('options'); ?></span>
    </button>
    <div class="collapse<?php echo $collapsed; ?>" id="collapseOptions"<?php echo $accordion_parent; ?>>
        <?php
        /**
         * SIZE AND PRECISION
         */
        ?>  
        <div class="col-sm-12 mb-2">
            <div class="row">
                <div class="col-sm-6">
                    <label><?php echo qrcdr()->getString('size'); ?></label>
                    <select name="size" class="form-select custom-select qrcode-size-selector">
                <?php
                for ($i=8; $i<=32; $i+=4) {
                    $value = $i*25;
                    echo '<option value="'.$i.'" '.( $matrixPointSize == $i ? 'selected' : '' ) . '>'.$value.'</option>';
                }; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label><?php echo qrcdr()->getString('error_correction_level'); ?></label>
                    <select name="level" class="form-select custom-select">
                        <option value="L" <?php if ($errorCorrectionLevel=="L") echo "selected"; ?>>
                            <?php echo qrcdr()->getString('precision_l'); ?>
                        </option>
                        <option value="M" <?php if ($errorCorrectionLevel=="M") echo "selected"; ?>>
                            <?php echo qrcdr()->getString('precision_m'); ?>
                        </option>
                        <option value="Q" <?php if ($errorCorrectionLevel=="Q") echo "selected"; ?>>
                            <?php echo qrcdr()->getString('precision_q'); ?>
                        </option>
                        <option value="H" <?php if ($errorCorrectionLevel=="H") echo "selected"; ?>>
                            <?php echo qrcdr()->getString('precision_h'); ?>
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div><!-- #collapseOptions -->
    </div><!-- accordion -->

</div><!-- collapseSettings -->
