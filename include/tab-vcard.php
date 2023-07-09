<?php
/**
 * V CARD
 */
if (qrcdr()->getConfig('vcard') == true) { ?>
    <div class="tab-pane fade <?php if ($getsection === "#vcard") echo "show active"; ?>" id="vcard">
        <h4><?php echo qrcdr()->getString('vcard'); ?></h4>
        <div class="row">
            <div class="col-12 form-group">
                <label><?php echo qrcdr()->getString('version'); ?></label>
                <select class="form-select custom-select" name="vversion">
                  <option value="2.1">2.1</option>
                  <option value="3.0">3.0</option>
                  <!--
                  <option value="4.0">4.0</option>
                    -->
                </select>
            </div>

            <div class="col-md-2 form-group">
                <label><?php echo qrcdr()->getString('name_title'); ?></label>
                <input type="text" name="vnametitle" class="form-control">
            </div>
            <div class="col-md-5 form-group">
                <label><?php echo qrcdr()->getString('first_name'); ?></label>
                <input type="text" name="vname" class="form-control" required="required">
            </div>
            <div class="col-md-5 form-group">
                 <label><?php echo qrcdr()->getString('last_name'); ?></label>
                <input type="text" name="vlast" class="form-control">
            </div>

            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('phone_home'); ?></label>
                <div class="row no-gutters">
                    <div class="col-4">
                        <?php
                        $output = '<select class="form-select custom-select" name="countrycodevphone">';
                        foreach ($countries as $i=>$row) {
                            $output .= '<option value="'.$row['code'].'" label="'.$row['name'].'">'.$row['name'].'</option>';
                        }
                        $output .= '</select>';
                        echo $output;
                        ?>
                    </div>
                    <div class="col-8">
                        <input type="number" name="vphone" placeholder="" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('phone_mobile'); ?></label>
                <div class="row no-gutters">
                    <div class="col-4">
                        <?php
                        $output = '<select class="form-select custom-select" name="countrycodevmobile">';
                        foreach ($countries as $i=>$row) {
                            $output .= '<option value="'.$row['code'].'" label="'.$row['name'].'">'.$row['name'].'</option>';
                        }
                        $output .= '</select>';
                        echo $output;
                        ?>
                    </div>
                    <div class="col-8">
                        <input type="number" name="vmobile" placeholder="" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('email'); ?></label>
                <input type="email" name="vemail" class="form-control">
            </div>

            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('website'); ?></label>
                <input type="url" name="vurl" class="form-control" placeholder="http://">
            </div>

            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('company'); ?></label>
                <input type="text" name="vcompany" class="form-control">
            </div>

            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('jobtitle'); ?></label>
                <input type="text" name="vtitle" class="form-control">
            </div>

            <div class="col-md-6 orm-group">
                <label><?php echo qrcdr()->getString('phone_office'); ?></label>
                <div class="row no-gutters">
                    <div class="col-4">
                        <?php
                        $output = '<select class="form-select custom-select" name="countrycodevoffice">';
                        foreach ($countries as $i=>$row) {
                            $output .= '<option value="'.$row['code'].'" label="'.$row['name'].'">'.$row['name'].'</option>';
                        }
                        $output .= '</select>';
                        echo $output;
                        ?>
                    </div>
                    
                    <div class="col-8">
                        <input type="number" name="vofficephone" placeholder="" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('fax'); ?></label>
                <div class="row no-gutters">
                    <div class="col-4">
                        <?php
                        $output = '<select class="form-select custom-select" name="countrycodevfax">';
                        foreach ($countries as $i=>$row) {
                            $output .= '<option value="'.$row['code'].'" label="'.$row['name'].'">'.$row['name'].'</option>';
                        }
                        $output .= '</select>';
                        echo $output;
                        ?>
                    </div>
                    
                    <div class="col-8">
                        <input type="number" name="vfax" placeholder="" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-12 form-group">
                 <label><?php echo qrcdr()->getString('address'); ?></label>
                <textarea name="vaddress" class="form-control" maxlength="255"></textarea>
            </div>
            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('post_code'); ?></label>
                <input type="text" name="vcap" class="form-control">
            </div>
            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('city'); ?></label>
                <input type="text" name="vcity" class="form-control">
            </div>
            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('state'); ?></label>
                <input type="text" name="vstate" class="form-control">
            </div>
            <div class="col-md-6 form-group">
                <label><?php echo qrcdr()->getString('country'); ?></label>
                <input type="text" name="vcountry" class="form-control">
            </div>
        <?php
        /*
            <div class="col-12">
                 <label><?php echo qrcdr()->getString('note'); ?></label>
                <textarea name="vnote" class="form-control" maxlength="255"></textarea>
            </div>
        */ ?>
        </div>
    </div>
    <?php
}
