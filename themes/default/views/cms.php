<div class="container">
<div class="panel panel-default">
 <div class="panel-heading"><?=$cms->title;?></div>
  <div class="panel-body">
    <p><?=$cms->description;?></p>
    <!-- <?=$cms->longitude;?> -->
 </div>
</div>
</div>

<?php if($cms->slug == "contact"){ ?>
<div class="container">
<div class="row">
    <div data-wow-duration="0.5s" data-wow-delay="1s" class="wow fadeIn col-md-4 animated" >
        <div class="panel panel-default">
            <div class="panel-heading"><?=lang('0172')?></div>
            <div class="panel-body">
                <div>
                    <i class="fa fa-map-marker"></i> <strong><?=lang('0173')?></strong><br>
                    <?=$cms->address;?>
                    <hr>
                    <i class="fa fa-envelope"></i> <strong><?=lang('0174')?></strong><br>
                    <?=$cms->email;?>
                    <hr>
                    <!--<i class="fa fa-skype"></i> <strong>Skype</strong><br>
                    phptravels<hr>
                    <i class="fa fa-whatsapp"></i> <strong>Whatsapp</strong><br>
                    +923311442244<hr>-->
                    <i class="fa fa-phone-square"></i> <strong><?=lang('0175')?></strong><br>
                    <?=$cms->phone;?>
                    <hr>
                    <i class="fa fa-whatsapp text-success"></i> <strong><?=lang('0176')?></strong><br>
                    <?=$cms->whatsapp_no;?>
                </div>
            </div>
        </div>
    </div>
    <div data-wow-duration="0.5s" data-wow-delay="1s" class="wow fadeIn col-md-8 animated">
        <div style="width:100%;overflow:hidden;max-width:100%;">
            <div class="img-thumbnail" id="google-maps-canvas" style="height:100%; width:100%;max-width:100%;margin-bottom:100px">
            <iframe src="<?=$cms->latitude;?>" frameborder="0" style="border:0" allowfullscreen></iframe>
            <style>
            iframe{width:100% !important;;height:260px !important;}
            #google-maps-canvas .map-generator{max-width: 100%; max-height: 100%; background: none;}
            </style>
        </div>
    </div>
</div>
</div>
</div>
<?php } ?>