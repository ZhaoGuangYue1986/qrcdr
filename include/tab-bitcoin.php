<?php
/**
 * BITCOIN
 */
if (qrcdr()->getConfig('bitcoin') == true) { ?>
    <div class="tab-pane fade <?php if ($getsection === "#bitcoin") echo "show active"; ?>" id="bitcoin">
        <h4><?php echo qrcdr()->getString('bitcoin'); ?></h4>
        <div class="row form-group">
            <div class="col-sm-6">
                <label><?php echo qrcdr()->getString('address'); ?></label>
                <input type="text" name="btc_account" class="form-control ltr" required="required">
            </div>
           <div class="col-sm-6">
                <label><?php echo qrcdr()->getString('amount'); ?></label>
                <div class="input-group">
                    <input type="number" name="btc_amount" class="form-control">
                    <span class="input-group-text rounded-0">BTC</span>
                </div>
                <?php echo qrcdr()->getBtcRates(); ?>
            </div>
            <div class="col-sm-6">
                <label><?php echo qrcdr()->getString('item_name'); ?></label>
                <input type="text" name="btc_label" class="form-control">
            </div>
            <div class="col-sm-6">
                <label><?php echo qrcdr()->getString('message'); ?></label>
                <input type="text" name="btc_message" class="form-control">
            </div>
        </div>
    </div>
    <?php
}
