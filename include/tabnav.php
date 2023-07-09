<?php
$alignnavitems = '';
if ('vertical' == qrcdr()->getConfig('layout')) {
    $navorder = 'left' == qrcdr()->getConfig('sidebar') ? ' order-last' : '';
    $alignnavitems = ' text-sm-left text-sm-start';
    ?>
<div class="col-sm-4 col-md-3<?php echo $navorder; ?>">
<ul class="nav nav-pills flex-sm-column nav-fill sticky-top" role="tablist">
    <?php
} else {
    ?>
<div class="col-12">
<ul class="nav nav-pills nav-fill" role="tablist">
    <?php
}

if (qrcdr()->getConfig('link') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#link") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#link" role="tab" data-bs-toggle="tab"><i class="fa fa-link"></i> <span class="d-inline-block d-sm-inline-block"><?php echo qrcdr()->getString('link'); ?></span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('text') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#text") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#text" role="tab" data-bs-toggle="tab"><i class="fa fa-align-left"></i> <span class="d-inline-block d-sm-inline-block"><?php echo qrcdr()->getString('text'); ?></span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('email') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#email") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#email" role="tab" data-bs-toggle="tab"><i class="fa fa-envelope-o"></i> <span class="d-inline-block d-sm-inline-block"><?php echo qrcdr()->getString('email'); ?></span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('location') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#location") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#location" role="tab" data-bs-toggle="tab"><i class="fa fa-map-marker"></i> <span class="d-inline-block d-sm-inline-block"><?php echo qrcdr()->getString('location'); ?></span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('tel') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#tel") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#tel" role="tab" data-bs-toggle="tab"><i class="fa fa-phone"></i> <span class="d-inline-block d-sm-inline-block"><?php echo qrcdr()->getString('phone'); ?></span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('sms') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#sms") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#sms" role="tab" data-bs-toggle="tab"><i class="fa fa-mobile"></i> <span class="d-inline-block d-sm-inline-block"><?php echo qrcdr()->getString('sms'); ?></span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('whatsapp') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#whatsapp") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#whatsapp" role="tab" data-bs-toggle="tab"><i class="fa fa-whatsapp"></i> <span class="d-inline-block d-sm-inline-block">WhatsApp</span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('skype') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#skype") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#skype" role="tab" data-bs-toggle="tab"><i class="fa fa-skype"></i> <span class="d-inline-block d-sm-inline-block">Skype</span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('zoom') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#zoom") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#zoom" role="tab" data-bs-toggle="tab"><i class="fa fa-video-camera"></i> <span class="d-inline-block d-sm-inline-block">Zoom</span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('wifi') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#wifi") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#wifi" role="tab" data-bs-toggle="tab"><i class="fa fa-wifi"></i> <span class="d-inline-block d-sm-inline-block"><?php echo qrcdr()->getString('wifi'); ?></span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('vcard') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#vcard") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#vcard" role="tab" data-bs-toggle="tab"><i class="fa fa-list-alt"></i> <span class="d-inline-block d-sm-inline-block"><?php echo qrcdr()->getString('vcard'); ?></span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('event') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#event") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#event" role="tab" data-bs-toggle="tab"><i class="fa fa-calendar-o"></i> <span class="d-inline-block d-sm-inline-block"><?php echo qrcdr()->getString('event'); ?></span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('paypal') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#paypal") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#paypal" role="tab" data-bs-toggle="tab"><i class="fa fa-paypal"></i> <span class="d-inline-block d-sm-inline-block"><?php echo qrcdr()->getString('paypal'); ?></span></a>
    </li>
    <?php
}
if (qrcdr()->getConfig('bitcoin') == true) { ?>
    <li class="nav-item<?php echo $alignnavitems; ?>">
        <a class="nav-link<?php if ($getsection == "#bitcoin") echo " active"; ?><?php echo $rounded_btn_nav; ?>" href="#bitcoin" role="tab" data-bs-toggle="tab"><i class="fa fa-bitcoin"></i> <span class="d-inline-block d-sm-inline-block"><?php echo qrcdr()->getString('bitcoin'); ?></span></a>
    </li>
    <?php
} ?>
</ul>
</div>

<?php
$verticol = ('vertical' == qrcdr()->getConfig('layout')) ? 'col-sm-8 col-md-9' : 'col-12';
?>
<div class="<?php echo $verticol; ?>">

