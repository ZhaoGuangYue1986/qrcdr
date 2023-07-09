<?php
/**
 * EVENT
 */
if (qrcdr()->getConfig('event') == true) {
    $relative = qrcdr()->relativePath();
    $lang = qrcdr()->getLang();
    $localepath = $relative.'js/tempusdominus/locales/'.$lang.'.js';
    $localdata = file_exists($localepath) ? ' data-locale="'.$lang.'"' : '';
    ?>
    <div class="tab-pane fade <?php if ($getsection === "#event") echo "show active"; ?>" id="event"<?php echo $localdata; ?>>
        <h4><?php echo qrcdr()->getString('event'); ?></h4>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label><?php echo qrcdr()->getString('event_title'); ?></label>
                <input type="text" name="eventtitle" class="form-control" required="required">
            </div>
            <div class="col-sm-6 form-group">
                <label><?php echo qrcdr()->getString('location'); ?></label>
                <input type="text" name="eventlocation" class="form-control">
            </div>

            <div class="col-sm-6 form-group">
                <label><?php echo qrcdr()->getString('start_time'); ?></label>
                <input type="text" class="form-control datetimepicker-input" id="eventstart" data-toggle="datetimepicker" data-target="#eventstart" data-timestamp="#eventstarttime" required="required"/>
                <input type="hidden" name="eventstarttime" id="eventstarttime" class="get-timestamp">
            </div>

            <div class="col-sm-6 form-group">
                <label><?php echo qrcdr()->getString('end_time'); ?></label>
                <input type="text" class="form-control datetimepicker-input" id="eventend" data-toggle="datetimepicker" data-target="#eventend" data-timestamp="#eventendtime"/>
                <input type="hidden" name="eventendtime" id="eventendtime" class="get-timestamp">
            </div>

            <div class="col-12 form-group">
                <label><?php echo qrcdr()->getString('reminder_before_event'); ?></label>
                <select class="form-select custom-select" name="eventreminder" id="eventreminder">
                    <option value="">--</option>
                    <option value="PT0M"><?php echo qrcdr()->getString('when_the_event_starts'); ?></option>
                    <option value="-PT5M">5 <?php echo qrcdr()->getString('minutes'); ?></option>
                    <option value="-PT10M">10 <?php echo qrcdr()->getString('minutes'); ?></option>
                    <option value="-PT15M">15 <?php echo qrcdr()->getString('minutes'); ?></option>
                    <option value="-PT30M">30 <?php echo qrcdr()->getString('minutes'); ?></option>
                    <option value="-PT1H">1 <?php echo qrcdr()->getString('hour'); ?></option>
                    <option value="-PT2H">2 <?php echo qrcdr()->getString('hours'); ?></option>
                    <option value="-PT3H">3 <?php echo qrcdr()->getString('hours'); ?></option>
                    <option value="-PT4H">4 <?php echo qrcdr()->getString('hours'); ?></option>
                    <option value="-PT5H">5 <?php echo qrcdr()->getString('hours'); ?></option>
                    <option value="-PT6H">6 <?php echo qrcdr()->getString('hours'); ?></option>
                    <option value="-PT12H">12 <?php echo qrcdr()->getString('hours'); ?></option>
                    <option value="-PT24H">24 <?php echo qrcdr()->getString('hours'); ?></option>
                    <option value="-PT48H">48 <?php echo qrcdr()->getString('hours'); ?></option>
                    <option value="-PT168H">1 <?php echo qrcdr()->getString('week'); ?></option>
                </select>
            </div>
           
            <div class="col-12 form-group">
                <label for="eventlink"><?php echo qrcdr()->getString('link'); ?></label>
                <input type="url" name="eventlink" id="eventlink" class="form-control" placeholder="http://" />
            </div>
           
            <div class="col-12 form-group">
                <label><?php echo qrcdr()->getString('notes'); ?></label>
                <textarea rows="3" name="eventnote" class="form-control" maxlength="500"></textarea>
            </div>
        </div>
    </div>
    <?php
}
