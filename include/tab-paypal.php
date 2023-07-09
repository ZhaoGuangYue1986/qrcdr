<?php
/**
 * PAYPAL
 */
if (qrcdr()->getConfig('paypal') == true) { ?>
    <div class="tab-pane fade <?php if ($getsection === "#paypal") echo "show active"; ?>" id="paypal">
        <h4><?php echo qrcdr()->getString('paypal'); ?></h4>
        <div class="row form-group">

            <div class="col-sm-6">
                <label><?php echo qrcdr()->getString('type'); ?></label>
                <select class="form-select custom-select" name="pp_type" id="pp_type">
                  <option value="_xclick"><?php echo qrcdr()->getString('buy_now'); ?></option>
                  <option value="_cart"><?php echo qrcdr()->getString('add_to_cart'); ?></option>
                  <option value="_donations"><?php echo qrcdr()->getString('donations'); ?></option>
                </select>
            </div>

            <div class="col-sm-6">
                <label><?php echo qrcdr()->getString('email'); ?></label>
                <input type="email" name="pp_email" class="form-control" required="required">
                <small><?php echo qrcdr()->getString('pp_email'); ?></small>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-8">
                <label><?php echo qrcdr()->getString('item_name'); ?></label>
                <input type="text" name="pp_name" class="form-control" required="required">
            </div>

            <div class="col-sm-4">
                <label><?php echo qrcdr()->getString('item_id'); ?></label>
                <input type="text" name="pp_id" class="form-control ltr">
            </div>
        </div>

        <div class="row form-group">
           <div class="col-sm-6 yesdonation">
                <label><?php echo qrcdr()->getString('price'); ?></label>
                <div class="input-group">
                    <input type="number" name="pp_price" class="form-control" placeholder="0.00">
                    <span class="input-group-text rounded-0 getcurrency">USD</span>
                </div>
            </div>

            <div class="col-sm-6 yesdonation">
                <label><?php echo qrcdr()->getString('currency'); ?></label>
                <select class="form-select custom-select setvalue" name="pp_currency" id="setcurrency" data-target=".getcurrency">
                  <option value="USD">United States dollar</option>
                  <option value="EUR">Euro</option>
                  <option value="AUD">Australian dollar</option>
                  <option value="BRL">Brazilian real</option>
                  <option value="CAD">Canadian dollar</option>
                  <option value="CNY">Chinese Renmenbi</option>
                  <option value="CZK">Czech koruna</option>
                  <option value="DKK">Danish krone</option>
                  <option value="HKD">Hong Kong dollar</option>
                  <option value="HUF">Hungarian forint</option>
                  <option value="INR">Indian rupee</option>
                  <option value="ILS">Israeli new shekel</option>
                  <option value="JPY">Japanese yen</option>
                  <option value="MYR">Malaysian ringgit</option>
                  <option value="MXN">Mexican peso</option>
                  <option value="TWD">New Taiwan dollar</option>
                  <option value="NZD">New Zealand dollar</option>
                  <option value="NOK">Norwegian krone</option>
                  <option value="PHP">Philippine peso</option>
                  <option value="PLN">Polish złoty</option>
                  <option value="GBP">Pound sterling</option>
                  <option value="RUB">Russian ruble</option>
                  <option value="SGD">Singapore dollar</option>
                  <option value="SEK">Swedish krona</option>
                  <option value="CHF">Swiss franc</option>
                  <option value="THB">Thai baht</option>
                </select>
            </div>

            <div class="col-sm-6 nodonation">
                <label><?php echo qrcdr()->getString('shipping'); ?></label>
                <div class="input-group">
                    <input type="number" name="pp_shipping" class="form-control" placeholder="0.00">
                    <span class="input-group-text rounded-0 getcurrency" id="getcurrency">USD</span>
                </div>
            </div>
            <div class="col-sm-6 nodonation">
                <label><?php echo qrcdr()->getString('tax_rate'); ?></label>
                <div class="input-group">
                    <input type="number" name="pp_tax" class="form-control" placeholder="0.00">
                    <span class="input-group-text rounded-0">%</span>
                </div>
            </div>

        </div>
    </div>
    <?php
}
