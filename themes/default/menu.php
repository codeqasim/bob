<?php $i = 0; foreach ($ota_modules as $index=>$module) {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if($actual_link == site_url()){
	    $link = "#".strtoupper($module->name);
	    $toggle = 'data-toggle="tab" aria-expanded="false"';
	    $active = ($i == 0)?"active":"";
    } else {
	    $link = site_url()."#".strtoupper($module->name);
	    $toggle = "";
	    $active = '';
    }
    ?>
    <?php
	if(!empty($module->is_active) && !empty($main_model[$module->name]->is_active) && $module->is_show_home != 0){ ?>
 <li class="<?=$active;?>" id="menu_item_<?=$module->name?>" ><a href="<?=$link;?>" <?=$toggle;?>><i class="<?=$module->icon?>"></i> <span class=""><?=strtoupper($module->nic_name)?></span></a></li>
<?php } $i = $i+1; } ?>
<script>
    $(document).ready(function(){
        activaTab(window.location.hash);
    });

    function activaTab(tab){
        $('a[href="' + tab + '"]').tab('show');
        var uri = window.location.toString();
        if (uri.indexOf("#") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("#"));
            window.history.replaceState({}, document.title, clean_uri);
        }
    }
</script>
