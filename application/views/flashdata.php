<?php if($this->session->has_userdata('Success')) { ?>
<div class="alert alert-info alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times fa-sm"></i></button>
    <h5><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('Success')?></h5>
</div>
<?php }elseif($this->session->has_userdata('Fail')){?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times fa-sm"></i></button>
    <h5><i class="fas fa-exclamation-triangle"></i> <?php echo $this->session->flashdata('Fail')?></h5>
</div>
<?php } ?>