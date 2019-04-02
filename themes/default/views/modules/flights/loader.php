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
        animation: content-placeholder-animation 1.5s linear infinite;
        background: -moz-linear-gradient(left, rgba(15, 15, 15, 0.3) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
        background: -webkit-linear-gradient(left, rgba(15, 15, 15, 0) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
        background: linear-gradient(to right, rgba(15, 15, 15, 0) 0%, rgba(15, 15, 15, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
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
        color: #e2e2e2;
    }

    @media only screen and (max-width: 600px) {
        .image {
            height: 90px;
            width: 100%;
        }
    }

    @media only screen and (min-width: 600px) {
        .image {
            height: 50px;
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

    .subheading-left0 {
        height: 2em;
        width: 100%;
    }
    .subheading-left1 {
        height: 1.8em;
        width: 90%;
    }

    .subheading-left2 {
        height: 1.6em;
        width: 80%;
    }

    .subheading-left3 {
        height: 1.6em;
        width: 70%;
    }

    .subheading-left4 {
        height: 1.4em;
        width: 60%;
    }

    .subheading-round {
        height: 15px;
        width: 15px;
        border-radius:50%;
    }

    .subheading-square {
        height: 15px;
        width: 15px;
    }

    .subheading-line {
        height: 15px;
        width: 100%;
    }

    .paragraph {
        height: 1em;
        width: 50%;
    }

</style>
<div class="ajax-load" style="display:none">
    <div class="row">
        <div class="col-md-3 hidden-xs">
            <?php for ($i = 0; $i < 4; $i++) { ?>
                <div class="content-placeholder subheading-left<?=$i?>">
                    <span class="content-placeholder-background"></span>
                </div>
            <?php } ?>
            <br>
            <br>
            <br>

            <?php for ($i = 0; $i < 1; $i++) { ?>
                <div class="row" style="padding-bottom: 5px;">
                    <div class="col-md-2 col-xs-3">
                        <div class="content-placeholder subheading-round">
                            <span class="content-placeholder-background"></span>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-6">
                        <div class="content-placeholder subheading-line">
                            <span class="content-placeholder-background"></span>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-3">
                        <div class="content-placeholder subheading-round">
                            <span class="content-placeholder-background"></span>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <br>
            <br>
            <br>
            <?php for ($i = 0; $i < 15; $i++) { ?>
                <div class="row" style="padding-bottom: 5px;">
                    <div class="col-md-2 col-xs-4">
                        <div class="content-placeholder subheading-square">
                            <span class="content-placeholder-background"></span>
                        </div>
                    </div>
                    <div class="col-md-10 col-xs-8">
                        <div class="content-placeholder subheading-line">
                            <span class="content-placeholder-background"></span>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
        <div class="col-md-9">
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <div class="row">
                    <div class="col-md-2 col-xs-4" style="padding-right:0px;margin-right: -20px">
                        <div class="content-placeholder image">
                                <span class="content-placeholder-background">
                                </span>
                        </div>
                    </div>
                    <div class="col-md-10 col-xs-8" style="padding-left: 30px;padding-right: 0px">
                        <div class="content-placeholder header">
                            <span class="content-placeholder-background"></span>
                        </div>
                        <!--<div class="content-placeholder subheading">
                            <span class="content-placeholder-background"></span>
                        </div>-->
                        <div class="content-placeholder paragraph">
                            <span class="content-placeholder-background"></span>
                        </div>
                    </div>
                </div>
                <hr>
            <?php } ?>
        </div>
    </div>
</div>