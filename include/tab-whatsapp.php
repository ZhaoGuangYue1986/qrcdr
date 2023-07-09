<?php
/**
 * WHATSAPP
 */
if (qrcdr()->getConfig('whatsapp') == true) { ?>
    <div class="tab-pane fade<?php if ($getsection === "#whatsapp") echo " show active"; ?>" id="whatsapp">
        <h4>WhatsApp</h4>
        <div class="row">
            <div class="col-md-4 form-group">
                <label><?php echo qrcdr()->getString('country_code'); ?></label>
                <?php
                $output = '<select class="form-select custom-select" name="wapp_countrycode" required="required">';
                foreach ($countries as $i=>$row) {
                    $output .= '<option value="'.$row['code'].'" label="'.$row['name'].'">'.$row['name'].'</option>';
                }
                $output .= '</select>';
                echo $output;
                ?> 
            </div>

            <div class="col-md-8 form-group">
                <label><?php echo qrcdr()->getString('phone_number'); ?></label>
                <input type="number" name="wapp_number" placeholder="" class="form-control" required="required">
            </div>

            <div class="col-12 form-group">
                <label><?php echo qrcdr()->getString('message'); ?></label>
                <textarea rows="3"  name="wapp_message" class="form-control" maxlength="750"></textarea>
            </div>
        </div>
    </div>
    <?php
}
