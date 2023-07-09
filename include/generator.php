<?php $sidebarorder = 'left' == qrcdr()->getConfig('sidebar') ? ' order-last order-lg-first' : ' order-last'; ?>
<input type="hidden" id="qrcdr-relative" value="<?php echo $relative; ?>">
<div class="container">
    <div class="row mt-3">

        <div class="col-lg-4<?php echo $sidebarorder; ?>">
            <?php require dirname(__FILE__).'/placeholder.php'; ?>
        </div><!-- col md-4-->

        <div class="col-lg-8 pt-3 mb-3">
            <div class="row">
                <form role="form" class="qrcdr-form needs-validationNO w-100" novalidate>
                    <input type="submit" class="d-none">
                    <input type="hidden" name="section" id="getsec" value="<?php echo $getsection; ?>">
                    <?php
                    /**
                     * QR CODE DATA
                     */ ?>
                    <div class="col-12 pb-2">
                        <div class="row">
                            <?php
                            require dirname(__FILE__).'/tabnav.php';
                            ?>
                            <div class="tab-content mt-3" id="dataTabs">
                            <?php
                            require dirname(__FILE__).'/tab-link.php';
                            require dirname(__FILE__).'/tab-text.php';
                            require dirname(__FILE__).'/tab-email.php';
                            require dirname(__FILE__).'/tab-location.php';
                            require dirname(__FILE__).'/tab-tel.php';
                            require dirname(__FILE__).'/tab-sms.php';
                            require dirname(__FILE__).'/tab-whatsapp.php';
                            require dirname(__FILE__).'/tab-skype.php';
                            require dirname(__FILE__).'/tab-zoom.php';
                            require dirname(__FILE__).'/tab-wifi.php';
                            require dirname(__FILE__).'/tab-vcard.php';
                            require dirname(__FILE__).'/tab-event.php';
                            require dirname(__FILE__).'/tab-paypal.php';
                            require dirname(__FILE__).'/tab-bitcoin.php';
                            ?>
                            </div> <!-- tab content -->

                            <?php require dirname(__FILE__).'/options.php'; ?>
                            </div><!-- main-col open at tabnav -->
                        </div> <!-- row -->
                    </div><!-- col-12-->
                </form>
            </div> <!-- row -->
        </div><!-- col-lg-8 -->

    </div><!-- row -->
</div><!-- containerOOO -->

<div class="alert_placeholder toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
    <div class="toast-header">
        <div class="mr-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
            </svg>
        </div>
        <button type="button" class="ml-2 ms-auto mb-1 btn-close close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></span>
        </button>
    </div>
    <div class="toast-body"></div>
</div>
