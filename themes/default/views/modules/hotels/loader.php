<style type="text/css">

    @keyframes content-placeholder-animation {
        0% {
            transform: translateX(-50%);
        }

        100% {
            transform: translateX(300%);
        }
    }

    .content-placeholder-background {
        animation: content-placeholder-animation 1s linear infinite;
        background: -moz-linear-gradient(left, rgba(15, 15, 15, 0.3) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
        background: -webkit-linear-gradient(left, rgba(15, 15, 15, 0) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
        background: linear-gradient(to right, rgba(15, 15, 15, 0) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#000f0f0f', endColorstr='#00ffffff', GradientType=1);
        display: block;
        height: inherit;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
        will-change: transform;
    }

    .content-placeholder {
        background-color: #f1f1f1;
        display: block;
        margin-bottom: 1em;
        overflow: hidden;
        position: relative;

    }

    @media only screen and (max-width: 600px) {
        .image {
            height: 85px;
            width: 100%;
        }
    }

    @media only screen and (min-width: 600px) {
        .image {
            height: 150px;
            width: 100%;
        }
    }

    .header {
        height: 2em;
        width: 100%;
    }

    .subheading {
        height: 1.5em;
        width: 70%;
    }

    .paragraph {
        height: 1em;
        width: 50%;
    }

    .paragraph-left {
        height: 1em;
        width: 100%;
    }

</style>
<div class="ajax-load text-center" style="display:none">
    <div class="row">
        <div class="col-md-3 hidden-xs">
            <div class="content-placeholder paragraph-left">
                <span class="content-placeholder-background"></span>
            </div>
            <div class="content-placeholder paragraph-left">
                <span class="content-placeholder-background"></span>
            </div>
            <div class="content-placeholder paragraph-left">
                <span class="content-placeholder-background"></span>
            </div>
            <div class="content-placeholder paragraph-left">
                <span class="content-placeholder-background"></span>
            </div>
            <br>
            <hr>
            <br>
            <?php for ($i = 0; $i < 20; $i++) { ?>
            <div class="row">
                <div class="col-md-2">
                    <div class="content-placeholder paragraph-left">
                        <span class="content-placeholder-background"></span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="content-placeholder paragraph-left">
                        <span class="content-placeholder-background"></span>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="col-md-9">
            <?php for ($i = 0; $i < 8; $i++) { ?>
                <div class="row">
                    <div class="col-md-3 col-xs-3" style="padding-right:0px;margin-right: -20px">
                        <div class="content-placeholder image">
                            <span class="content-placeholder-background"></span>
                        </div>
                    </div>
                    <div class="col-md-9 col-xs-9" style="padding-left: 30px;padding-right: 0px">
                        <div class="content-placeholder header">
                            <span class="content-placeholder-background"></span>
                        </div>
                        <div class="content-placeholder subheading">
                            <span class="content-placeholder-background"></span>
                        </div>
                        <div class="content-placeholder paragraph">
                            <span class="content-placeholder-background"></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>