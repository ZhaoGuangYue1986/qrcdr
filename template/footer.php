<div class="pt-3">
  <div class="container">
    <hr>
  	<div class="row pt-5 pb-4">
    	<div class="col">
        <!--h2 class="display-1"><p><?php echo qrcdr()->getString('title'); ?></p></h2-->
        <p><?php echo qrcdr()->getString('description'); ?></p>
      </div>
    </div>
    <hr>
    <div class="row py-2 small mb-3">
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- 底部广告长方形广告 -->
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-client="ca-pub-1416119137658217"
			 data-ad-slot="7130644003"
			 data-ad-format="auto"
			 data-full-width-responsive="true"></ins>
		<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
      <div class="col-6"><?php echo qrcdr()->getString('title').' &copy; '.date('Y'); ?></div>
	  <div class="col-6"><script type="text/javascript" src="//js.users.51.la/21867161.js"></script></div>
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
