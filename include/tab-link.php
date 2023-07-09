<?php
/**
 * LINK
 */
if (qrcdr()->getConfig('link') == true) { ?>
<div class="tab-pane fade <?php if ($getsection === "#link") echo "show active"; ?>" id="link">
    <h4><?php echo qrcdr()->getString('link'); ?></h4>
    <div class="form-group">
        <label for="malink">URL</label>
        <input type="text" name="link" id="malink" class="form-control ltr" placeholder="http://" required="required" value="" />
    </div>
</div>
    <?php
}
