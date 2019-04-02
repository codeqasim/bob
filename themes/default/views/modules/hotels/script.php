<script>




    $(document).ready(function () {
        var allowed_api_count = "<?=$allow_apis_count;?>";
        var percentage_increment = 100 / allowed_api_count;

        var allowed_apis = '<?=json_encode( $allow_apis );?>';
        var allowed_apis_array = JSON.parse(allowed_apis);

        var i;
        for (i = 0; i < allowed_apis_array.length; i++) {
            var form = '<?=json_encode( $search );?>';
            var form_data = JSON.parse(form);
            form_data['api_name'] = allowed_apis_array[i];
            form_data['request_number'] = i;
            ajax_request(form_data, i, percentage_increment, percentage_increment_input);
        }
    });

    window.onscroll = function () {
        var pageHeight = document.documentElement.offsetHeight,
            windowHeight = window.innerHeight,
            scrollPosition = window.scrollY || window.pageYOffset || document.body.scrollTop + (document.documentElement && document.documentElement.scrollTop || 0);

        if (pageHeight <= windowHeight + scrollPosition + 300) {
            var status = parseInt($("#status").val());
            if (status == 0) {

                var offset = parseInt($("#offset").val());
                var total = parseInt($("#total").val());

                if (total > offset) {
                    $.ajax({
                        url: '<?php echo site_url( 'hotels/pagination' ) ?>',
                        type: "POST",
                        data: "offset=" + offset,
                        beforeSend: function () {
                            $("#status").val(1);
                            $('.ajax-load-page').show();
                        },
                        success: function (data) {
                            $('.ajax-load-page').hide();
                            $("#hotel-partial").append(data);
                            processing = false;
                            $("#offset").val(offset + 20);
                            $("#status").val(0);
                        }
                    });
                }
            }
        }
    }

    function ajax_request(form_data, request_number, percentage_increment) {
        $.ajax({
            url: '<?php echo site_url( 'hotels/get_hotels' ) ?>',
            type: "POST",
            async: true,
            data: form_data,
            beforeSend: function () {
                $('.ajax-load').show();
            },
            success: function (data) {

                var percentage_increment_input = parseInt($("#percentage_increment_input").val());
                $("#percentage_increment_input").val(percentage_increment_input + percentage_increment);
                document.getElementById("loading_bar").style.width = Math.ceil(percentage_increment_input + percentage_increment) + "%";
                animateValue("bar_percentage", 0, Math.ceil(percentage_increment_input + percentage_increment), 1000);
                if ($.trim(data) != "") {
                    $('.ajax-load').hide();
                    if ($('#total').length > 0) {
                        var old_total = parseInt($("#total").val());
                    } else {
                        var old_total = 0;
                    }

                    $("#page_content").html(data);
                    var total = parseInt($("#total").val());


                    if (total > old_total) {
                        animateValue("total_records_count", old_total, total, 1000);
                    } else {
                        $('#filters_form').hide();
                    }
                }

                var total_incremented = parseInt(percentage_increment_input) + parseInt(percentage_increment);
                if (total_incremented >= 99) {
                    var total = parseInt($("#total").val());
                    $("#status").val(0);
                    if (total == 0 || total === undefined) {
                        $('.ajax-load').hide();
                        $("#page_content").html('<div style="margin-top:-25px;min-height: 350px; padding: 25px;"> <img src="<?php echo $theme_url; ?>assets/img/not_found.gif" style="max-width:200px" class="img-responsive center-block" alt="not found"/> <h4 style="margin: 25px 0 10px !important;" class="form-group text-center"><strong>No Results found.</strong></h4> <p class="text-center"> Sorry, We could not find any results for the dates you are searching for. <br>We suggest you modify your search and try again. </p><input value="0" type="hidden" id="available_flights"></div>');
                    }
                    setTimeout(function () {
                        $('#loading_bar').fadeOut();
                    }, 2000)
                }
            },
            error: function () {
                $('.ajax-load').hide();
                $("#page_content").html("<div class='container'><p class='alert alert-danger'>No Hotel Found.</p></div>");
            }
        });
    }

    function sort_hotels(order) {
        $.ajax({
            url: '<?php echo site_url( 'hotels/sort' ) ?>',
            type: "POST",
            data: "order=" + order,
            beforeSend: function () {
                $('.ajax-load-page').show();
                $('#hotel-partial').hide();
            },
            success: function (data) {
                $('.ajax-load-page').hide();
                $('#hotel-partial').show();
                $("#hotel-partial").html(data);
                $("#asc").removeClass('active');
                $("#desc").removeClass('active');
                $("#" + order).addClass('active');
            }
        });
    }

    function animateValue(id, start, end, duration) {

        var obj = document.getElementById(id);
        var range = end - start;
        var minTimer = 50;
        var stepTime = Math.abs(Math.floor(duration / range));
        stepTime = Math.max(stepTime, minTimer);
        var startTime = new Date().getTime();
        var endTime = startTime + duration;
        var timer;

        function run() {
            var now = new Date().getTime();
            var remaining = Math.max((endTime - now) / duration, 0);
            var value = Math.round(end - (remaining * range));
            obj.innerHTML = value;
            if (value == end) {
                clearInterval(timer);
            }
        }

        timer = setInterval(run, stepTime);
        run();
    }
</script>