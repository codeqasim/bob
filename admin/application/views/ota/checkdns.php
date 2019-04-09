<?php if(!empty($dnsData) && !$dnsData->check){ ?>
    <div class="alert alert-danger"> DNS Not updated yet please wait for few minutes and check again.</div>
<?php } ?>
    <div class="text-center">
        <img class="img-fluid" src="<?php echo base_url(); ?>assets/img/dns.png" alt="dns update" style="max-width:100px;margin-bottom:25px" />
    </div>
    <h2 class="text-center"><strong>Change your Nameservers</strong></h2>
    <p class="text-center">
        To activate <strong><?=$ota_domain?></strong> you must point your nameservers (DNS) to <strong>TRAVELHOPE DNS</strong>. In order to start using <br>
        white-label portal from <strong>TRAVELHOPE</strong>, you'll need to change the domain nameservers configured <br>
    </p>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <p class="text-center"><strong>From</strong> <br>
                        <?php if(empty($dnsData->data[0])) { echo "Unknown"; }else {echo $dnsData->data[0];} echo  "<br>";
                        if(empty($dnsData->data[1])) {echo "Unknown";
                        }else{ echo $dnsData->data[1];} ?>
                    </p>
                </div>
                <div class="col-md-2 panel-body text-center">
                    <?php if(!$dnsData->check) { ?>
                        <i class="check check-danger fa fa-times text-center"></i>
                    <?php }else{ ?>
                        <i class="check check-success fa fa-check text-center"></i>
                    <?php } ?>
                </div>
                <div class="col-md-4">
                    <p class="text-center"><strong>To</strong> <br>
                        ns1.travelhope.net<br>
                        ns2.travelhope.net
                    </p>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
  <hr>
 <a type="button" href="<?=base_url('domain_verify/'.$ota_domain)?>" class="btn btn-primary btn-block">Check</a>
