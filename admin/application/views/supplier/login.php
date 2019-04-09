<?php $this->load->view('supplier/header'); ?>
<div style="margin-top:100px;margin-bottom:140px" class="container">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Login Panel</div>
            <div class="panel-body">
                <?php if(isset($error) && !empty($error)){ ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
                <form action="<?php echo base_url('supplier/login'); ?>" method="post">
                    <div class="form-group">
                        <input id="username" type="text" placeholder="Email" name="email" autocomplete="off" class="form-control" required value="">
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" name="password" placeholder="Password" class="form-control" required value="">
                    </div>
                    <div class="form-group login-submit">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" name="login-submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<?php $this->load->view('supplier/header'); ?>

<script>



</script>