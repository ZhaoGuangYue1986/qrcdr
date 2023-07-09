<?php
/**
 * TEL
 */
if (qrcdr()->getConfig('tel') == true) { ?>
    <div class="tab-pane fade <?php if ($getsection === "#tel") echo "show active"; ?>" id="tel">
        <h4><?php echo qrcdr()->getString('tel'); ?></h4>
        <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                    <label><?php echo qrcdr()->getString('country_code'); ?></label>
                    <?php
                    $output = '<select class="form-select custom-select" name="countrycodetel">';
                    foreach ($countries as $i=>$row) {
                        $output .= '<option value="'.$row['code'].'" label="'.$row['name'].'">'.$row['name'].'</option>';
                    }
                    $output .= '</select>';
                    echo $output;
                    ?> 
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label><?php echo qrcdr()->getString('phone_number'); ?></label>
                    <input type="number" name="tel" placeholder="" class="form-control" required="required">
                </div>
            </div>
        </div>
    </div>
    <?php
}
