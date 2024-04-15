<div class="pt-3">
  <div class="container">
    <hr>
  	<div class="row pt-5 pb-4">
    	<div class="col">
        <h2 class="display-1"><p><?php echo qrcdr()->getString('title'); ?></p></h2>
        <p><?php echo qrcdr()->getString('description'); ?></p>
      </div>
    </div>
    <hr>
    <div class="row py-2 small mb-3">
      <div class="col-6"><?php echo qrcdr()->getString('title').' &copy; '.date('Y'); ?></div>
      <div class="col-6">
        <?php
        if (file_exists(dirname(dirname(__FILE__)).'/'.$relative.'template/modals.php')) {
            include dirname(dirname(__FILE__)).'/'.$relative.'template/modals.php';
        }
        ?>
      </div>
    </div>
  </div>
</div>
