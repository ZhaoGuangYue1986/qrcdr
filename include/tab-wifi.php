<?php
/**
 * WI FI
 */
if (qrcdr()->getConfig('wifi') == true) { ?>
    <div class="tab-pane fade <?php if ($getsection === "#wifi") echo "show active"; ?>" id="wifi">
        <h4><?php echo qrcdr()->getString('wifi'); ?></h4>
        <div class="row form-group">
            <div class="col-md-4">
                <label><?php echo qrcdr()->getString('network_name'); ?></label>
                <input type="text" name="ssid" placeholder="SSID" class="form-control" required="required">
            </div>
            <div class="col-md-4">
                <label><?php echo qrcdr()->getString('network_type'); ?></label>
                <select class="form-select custom-select" name="networktype">
                  <option value="WEP">WEP</option>
                  <option value="WPA">WPA/WPA2</option>
                  <option value=""><?php echo qrcdr()->getString('no_encryption'); ?></option>
                </select>
            </div>
            <div class="col-md-4">
                <label><?php echo qrcdr()->getString('password'); ?></label>
                <input type="text" name="wifipass" class="form-control">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="wifihidden" name="wifihidden">
                    <label class="form-check-label" for="wifihidden"><?php echo qrcdr()->getString('hidden'); ?></label>
                </div>
            </div>
        </div>
    </div>
    <?php
}
