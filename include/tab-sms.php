<?php
/**
 * SMS
 */
if (qrcdr()->getConfig('sms') == true) { ?>
    <div class="tab-pane fade <?php if ($getsection === "#sms") echo "show active"; ?>" id="sms">
        <h4><?php echo qrcdr()->getString('sms'); ?></h4>
        <div class="row">
            <div class="col-md-4 form-group">
                <label><?php echo qrcdr()->getString('country_code'); ?></label>
                <?php
                $output = '<select class="form-select custom-select" name="countrycodesms">';
                foreach ($countries as $i=>$row) {
                    $output .= '<option value="'.$row['code'].'" label="'.$row['name'].'">'.$row['name'].'</option>';
                }
                $output .= '</select>';
                echo $output;
                ?> 
            </div>
            <div class="col-md-8 form-group">
                <label><?php echo qrcdr()->getString('phone_number'); ?></label>
                <input type="number" name="sms" placeholder="" class="form-control" required="required">
            </div>
            <div class="col-12 form-group">
                <label><?php echo qrcdr()->getString('message'); ?></label>
                <textarea rows="3"  name="bodysms" class="form-control" maxlength="160"></textarea>
            </div>
        </div>
    </div>
    <?php
}
