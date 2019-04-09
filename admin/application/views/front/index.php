<ul class="nav navbar-nav" style="margin-left:43%">
<?php if(empty($otadata)){ ?>
<li class="active"><a href="<?php echo base_url(); ?>login"><strong>Login</strong></a></li>
<li class=""><a href="<?php echo base_url(); ?>signup"><strong>Signup</strong></a></li>
<?php } else { ?>
<li class="active"><a href="<?php echo base_url(); ?>dashboard"><strong>Dashboard</strong></a></li>
<li class=""><a href="<?php echo base_url(); ?>logout"><strong>Logout</strong></a></li>
<?php } ?>
</ul>