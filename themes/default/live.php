<?php $whitelist = array(
    '127.0.0.1',
    '::1'
);

if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) { ?>

    <?php if (!empty($widgets->google_tags->widget_status)) { ?>
        <!-- Global site tag (gtag.js) -->
        <script async
                src="https://www.googletagmanager.com/gtag/js?id=<?= json_decode($widgets->google_tags->credentials)->code ?>"></script>
    <?php } ?>

    <?php if (!empty($widgets->google_analytics->widget_status)) { ?>
        <!-- Google Analytics -->
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '<?= json_decode($widgets->google_tags->credentials)->code ?>');
        </script>
    <?php } ?>

    <?php if (!empty($widgets->tawk_to->widget_status)) { ?>
        <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/<?= json_decode($widgets->tawk_to->credentials)->code ?>/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <?php } ?>

    <?php if (!empty($widgets->live_chat->widget_status)) { ?>
        <!-- Start of LiveChat (www.livechatinc.com) code -->
        <script type="text/javascript">
        window.__lc = window.__lc || {};
        window.__lc.license = <?= json_decode($widgets->live_chat->credentials)->code ?>;
        (function () {
            var lc = document.createElement('script');
            lc.type = 'text/javascript';
            lc.async = true;
            lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(lc, s);
        })();
    </script>
    <?php } ?>


<?php } else { ?>
    <!-- localhost -->
<?php } ?>