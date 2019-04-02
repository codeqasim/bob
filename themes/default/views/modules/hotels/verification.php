<div class="container">
<div class="center-block">
<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
<circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
<path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
</svg>
</div>
<div class="text-center">
<h2 data-wow-duration="0.5s" data-wow-delay="1s" class="wow fadeIn"><strong><?=lang('0177')?></strong></h2>
<p data-wow-duration="0.5s" data-wow-delay="1.5s" class="wow fadeInDown"><?=lang('0178')?></p>
<!--<p data-wow-duration="0.5s" data-wow-delay="1.8s" class="wow fadeInDown">--><?//=lang('0179')?><!--</p>-->
<hr>
<h4 data-wow-duration="0.5s" data-wow-delay="1.5s" class="wow fadeIn"><?=lang('0180')?> : <strong data-wow-duration="0.5s" data-wow-delay="2s" class="wow flash"><?=$booking_id;?></strong></h4>
<div data-wow-duration="0.5s" data-wow-delay="1.8s" class="wow fadeInUp">
<hr>
<a target="black" href="<?php echo base_url(); ?>hotels/invoice/<?=$booking_id;?>" class="btn btn-primary"><?=lang('0181')?></a>
</div>
</div>
</div>
<div style="margin:100px"></div>