<form method="POST" id="filters_form">
<div class="col-sm-12 col-md-12">
    <aside class="hidden-on-mobile filter-panel hotel">
        <!--<div class="viewmap">
            <div>
                <button class="btn btn-default btn-sm center-block">View on Map</button>
            </div>
        </div>-->
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse1">
            Star Grade <span class="collapsearrow"></span>
        </button>
        <div id="collapse1" class="collapse in">
            <div class="filter_margin">
                <?php $star = '<i class="fa fa-star text-warning"></i>'; ?>
                <?php $stars = '<i class="fa fa-star-o text-warning"></i>'; ?>
                <label class="control control--radio">
                    <input type="radio" id="rating" name="rating" value="1" />
                    <?php for ($i = 1; $i <= 1; $i++) { ?> <?php echo $star; ?> <?php } ?><?php for ($i = 1; $i <= 4; $i++) { ?> <?php echo $stars; ?> <?php } ?> - <strong>1</strong> Star
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio">
                    <input type="radio" name="rating" value="2" /> <?php for ($i = 1; $i <= 2; $i++) { ?> <?php echo $star; ?> <?php } ?><?php for ($i = 1; $i <= 3; $i++) { ?> <?php echo $stars; ?> <?php } ?> - <strong>2</strong> Stars
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio">
                    <input type="radio" name="rating" value="3" /> <?php for ($i = 1; $i <= 3; $i++) { ?> <?php echo $star; ?> <?php } ?><?php for ($i = 1; $i <= 2; $i++) { ?> <?php echo $stars; ?> <?php } ?> - <strong>3</strong> Stars
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio">
                    <input type="radio" name="rating" value="4" /> <?php for ($i = 1; $i <= 4; $i++) { ?> <?php echo $star; ?> <?php } ?><?php for ($i = 1; $i <= 1; $i++) { ?> <?php echo $stars; ?> <?php } ?> - <strong>4</strong> Stars
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio">
                    <input type="radio" name="rating" value="5" /> <?php for ($i = 1; $i <= 5; $i++) { ?> <?php echo $star; ?> <?php } ?> - <strong>5</strong> Stars
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div>
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse2">
            Price Range <span class="collapsearrow"></span>
        </button>
        <div id="collapse2" class="collapse in">
            <input type="text" class="col-md-12 price_ranger tool_tip" value="" name="price" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[0,1000]" />
        </div>
        <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse4">
            Amenities <span class="collapsearrow"></span>
        </button>
        <div id="collapse4" class="collapse in">
            <div class="filter_margin">
            <div class="amenities_scroll" style="max-height:250px">
                <?php for ($i = 1; $i <= 9; $i++) { ?>
                    <label class="control control--checkbox ellipsis fs14"> Package Type
                        <input type="checkbox" id="amenity" name="amenity[]" value="" />
                        <div class="control__indicator"></div>
                    </label>
                <?php } ?>
            </div>
            </div>
        </div>

        <button style="border-radius:0px" type="submit" class="btn btn-primary btn-lg btn-block" id="filter-btn">Search</button>
    </aside>
</div>
</form>
<script type="text/javascript">
    $(".price_ranger").slider({
        tooltip: 'always',
        formatter: function(value) {
            if(value[0] !== undefined && value[1] !== undefined){
                $('#filter_price').val(value[0]+','+value[1]);
            }
            return value[0]+' : '+value[1];
        }
    });

    $('#filters_form').submit(function (e) {
        e.preventDefault();
        var form = $('#filters_form');
        var form_data = form.serializeArray();
        console.log(form_data);
        $.ajax({
            type: 'POST',
            data: form_data,
            url: "<?php echo base_url(); ?>hotels/filter",
            beforeSend: function(){
                $('.ajax-load-page').show();
                $("#status").val(1);
                $("#offset").val(10);
                $("html, body").animate({ scrollTop: 255 }, "slow");
                $('#hotel-partial').html('');
            },
            success: function (data) {
                $('.ajax-load-page').hide();
                $('#hotel-partial').html(data);
            }
        });
    });
</script>