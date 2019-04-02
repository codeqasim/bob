<div class="modify_area" style="margin-bottom:0px">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-9">
                <h3 class="mt0"><strong id="total-records">
                        <span id="total_records_count">0</span>
                    </strong> Hotels are available <?php if ( isset( $hotel_city ) ) { ?> in
                        <strong><?php echo urldecode( ucwords( str_replace( '-', ' ', $hotel_city ) ) ); ?></strong><?php } ?>
                </h3>
                <p class="fs10"><?php echo $travelers; ?> Travelers, 1 Room, <?php echo $nights->days; ?>
                    Nights, <?php echo $checkin; ?> - <?php echo $checkout; ?></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="hidden-xs">
			<?php include $include_path . 'views/modules/hotels/partials/search.php'; ?>
        </div>
    </div>
</div>
<style>
#loading_bar { width: 0%;background: #db1600; transition: width 2s; line-height: 25px; margin-top: -2px;transition: width 2s; }
</style>
<div class="progress loading_bar2" style="height: 25px;box-shadow: none;z-index:9999;text-transform:uppercase;">
 <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" id="loading_bar" style="width:0%; !important;box-shadow: 0px 0px 5px 5px #f1f1f1"> <span id="bar_percentage">0</span>%</div>
</div>
<br>
<input id="percentage_increment_input" value="0" type="hidden">
<input id="grandtotal" value="0" type="hidden">

<div id="page_content">
    <div class="container">
		<?php include $include_path . 'views/modules/hotels/loader.php'; ?>
    </div>
</div>
<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
echo $actual_link;
?>
<input type="hidden" id="status" value="1"/>
<?php include $include_path . 'views/modules/hotels/script.php'; ?>