<?php
/**
 * LOCATION
 */
if (qrcdr()->getConfig('location') == true) { ?>
    <div class="tab-pane fade <?php if ($getsection === "#location") echo "show active"; ?>" id="location">
        <h4><?php echo qrcdr()->getString('location'); ?></h4>
    <?php
    $google_api_key = qrcdr()->getConfig('google_api_key');
    if (!$google_api_key || $google_api_key == 'YOUR-API-KEY' || strlen($google_api_key) < 10) { ?>
        <script src="<?php echo $relative; ?>js/ol/ol.js"></script>
        <small>Search an address or drag the marker to adjust the position and get the coordinates</small>
        <div class="row">
            <div class="col-md-6 mb-1">
                <div class="input-group">
                    <input type="text" class="form-control venomaps-set-address nopreview" placeholder="<?php echo qrcdr()->getString('search'); ?>">
                    <button class="btn btn-outline-primary venomaps-get-coordinates rounded-0" type="button"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control venomaps-get-lat setinput-latlon no-validate" value="" placeholder="<?php echo qrcdr()->getString('latitude'); ?>" name="lat" step="0.001">
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control venomaps-get-lon setinput-latlon no-validate" value="" placeholder="<?php echo qrcdr()->getString('longitude'); ?>" name="lng" step="0.001">
            </div>
        </div>
        <div class="form-group">
            <div id="wpol-admin-map" data-lat="<?php echo qrcdr()->getConfig('lat'); ?>" data-lng="<?php echo qrcdr()->getConfig('lng'); ?>" class="venomap"></div>
            <div style="display:none;">
                <div class="wpol-infomarker" id="infomarker_admin"></div>
            </div>
        </div>
        <?php
    } else { ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo qrcdr()->getConfig('google_api_key'); ?>&libraries=places"></script>
        <div style="min-height:350px" class="mb-3">
            <div id="latlong">
                <input id="pac-input" class="controls nopreview" type="text" placeholder="<?php echo qrcdr()->getString('search'); ?>">
                <input type="number" id="latbox" placeholder="<?php echo qrcdr()->getString('latitude'); ?>" class="controls" name="lat" step="0.1">
                <input type="number" id="lngbox" placeholder="<?php echo qrcdr()->getString('longitude'); ?>" class="controls" name="lng" step="0.1">
            </div>
            <div id="map-canvas" data-lat="<?php echo qrcdr()->getConfig('lat'); ?>" data-lng="<?php echo qrcdr()->getConfig('lng'); ?>"></div>
        </div>
        <?php
    } ?>
    </div>
    <?php
}
