<?php
/**
 * Zoom
 */
if (qrcdr()->getConfig('zoom') == true) { ?>
<div class="tab-pane fade <?php if ($getsection === "#zoom") echo "show active"; ?>" id="zoom">
    <h4>Zoom</h4>
    <div class="row form-group">
    <div class="col-sm-6">
        <label for="zoom_id"><?php echo qrcdr()->getString('reunion_id'); ?></label>
        <input type="text" name="zoom_id" id="zoom_id" class="form-control" required="required" />
    </div>
    <div class="col-sm-6">
        <label for="zoom_pwd"><?php echo qrcdr()->getString('password'); ?></label>
        <input type="text" name="zoom_pwd" id="zoom_pwd" class="form-control" required="required" />
    </div>
    </div>
</div>
    <?php
}
