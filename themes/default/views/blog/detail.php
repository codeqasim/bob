<div class="container">
    <div class="row">
        <div class="primary col-md-8 col-sm-12 col-xs-12 blog-content">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="blog_title"><?php echo $blog->title; ?></h3>
                    <h3 class="blog-head wow fadeInUp animated title go-right ttu bold animated">
                        <small class="go-left pull-right" style="font-size: 14px;"><?php echo date('d/m/Y', strtotime($blog->created_at)); ?></small>
                        <span class="fs14 pull-left"><?php echo strtoupper($blog->blog_category->category); ?></span>
                        <div class="clearfix"></div>
                    </h3>
                    <div class="clearfix"></div>
                    <img src="<?php echo $blog->image; ?>" class="wow fadeIn img img-responsive w100p">
                    <div class="row">
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-md-12">
                            <div class="sharethis-inline-share-buttons"></div>
                            <hr>
                            <p><?php echo $blog->description; ?>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'side.php'; ?>
    </div>
</div>