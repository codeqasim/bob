<div class="col-sm-12 col-md-3">
    <aside class="hidden-on-mobile filter-panel hotel" id="search-tablet">
        <div class="viewmap">
            <div>
                <button class="btn btn-default btn-sm center-block">View on Map</button>
            </div>
        </div>
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse1">
            Star Grade <span class="collapsearrow"></span>
        </button>
        <div id="collapse1" class="collapse in">
            <div class="filter_margin">
                <?php $star = '<i class="fa fa-star text-warning"></i>'; ?>
                <?php $stars = '<i class="fa fa-star-o text-warning"></i>'; ?>
                <label class="control control--radio">
                    <input type="radio" name="radio" id="rating" value="1" /> <?php for ($i = 1; $i <= 1; $i++) { ?> <?php echo $star; ?> <?php } ?><?php for ($i = 1; $i <= 4; $i++) { ?> <?php echo $stars; ?> <?php } ?> - <strong>1</strong> Star
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio">
                    <input type="radio" name="radio" id="rating" value="2" /> <?php for ($i = 1; $i <= 2; $i++) { ?> <?php echo $star; ?> <?php } ?><?php for ($i = 1; $i <= 3; $i++) { ?> <?php echo $stars; ?> <?php } ?> - <strong>2</strong> Stars
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio">
                    <input type="radio" name="radio" id="rating" value="3" /> <?php for ($i = 1; $i <= 3; $i++) { ?> <?php echo $star; ?> <?php } ?><?php for ($i = 1; $i <= 2; $i++) { ?> <?php echo $stars; ?> <?php } ?> - <strong>3</strong> Stars
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio">
                    <input type="radio" name="radio" id="rating" value="4" /> <?php for ($i = 1; $i <= 4; $i++) { ?> <?php echo $star; ?> <?php } ?><?php for ($i = 1; $i <= 1; $i++) { ?> <?php echo $stars; ?> <?php } ?> - <strong>4</strong> Stars
                    <div class="control__indicator"></div>
                </label>
                <label class="control control--radio">
                    <input type="radio" name="radio" id="rating" value="5" /> <?php for ($i = 1; $i <= 5; $i++) { ?> <?php echo $star; ?> <?php } ?> - <strong>5</strong> Stars
                    <div class="control__indicator"></div>
                </label>
            </div>
        </div>
        <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse2">
            Price Range <span class="collapsearrow"></span>
        </button>
        <div id="collapse2" class="collapse in">
            <input type="text" class="col-md-12 price_ranger tool_tip" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,600]" />
        </div>
        <button type="button" class="collapsebtn last go-text-right" data-toggle="collapse" data-target="#collapse4">
            Amenities <span class="collapsearrow"></span>
        </button>
        <div id="collapse4" class="collapse in">
            <div class="filter_margin">
                <?php foreach ($list->amenities as $am) { ?>
                    <label class="control control--checkbox ellipsis fs14"> <?php echo $am->title; ?>
                        <input type="checkbox" id="amenity" value="<?php echo $am->amenity_id ?>" />
                        <div class="control__indicator"></div>
                    </label>
                <?php } ?>
            </div>
        </div>
        <input type="hidden" id="filter_price" />
        <button style="border-radius:0px" type="submit" class="btn btn-primary btn-lg btn-block" id="filter-btn" onclick="filter();">Search</button>
    </aside>
</div>
<script type="text/javascript">
function filter(){
    var checkedValues = $('#amenity:checked').map(function () {
        return this.value;
    }).get();
    var rate = $('#rating:checked').val();
    var price = $('#filter_price').val();
    $('#filter-btn').prop('disabled', true);
    $('html,body').animate({
        scrollTop: $("#navbar").offset().top},
            'slow');
    $('#preloader').css('display', 'block');
    $.ajax({
        type: 'POST',
        data: {rating: rate, amenities: checkedValues, price: price, segments: window.location.pathname},
        url: "<?php echo base_url(); ?>hotels/filter",
        success: function (response) {
            $('#preloader').css('display', 'none');
            $('#hotel-partial').replaceWith(response);
            $('#total-records').text($('#hotel-partial').data('total'));
            $('#filter-btn').prop('disabled', false);
        }
    });
}
</script>