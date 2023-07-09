<?php
/**
 * TEXT
 */
if (qrcdr()->getConfig('text') == true) { ?>
    <div class="tab-pane fade <?php if ($getsection === "#text") echo "show active"; ?>" id="text">
        <h4><?php echo qrcdr()->getString('text'); ?></h4>
        <div class="row">
        	<div class="col-12 form-group">
		            <label><?php echo qrcdr()->getString('message'); ?></label>
		            <textarea rows="3" name="data" class="form-control" required="required" maxlength="1000"></textarea>
		    </div>
		</div>
    </div>
    <?php
}
