<?php if($this->session->flashdata('errormessage')):?>
<div class="alert alert-dismissible alert-danger">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<div class="text-center">
		<h4><strong>Ooops!!!</strong></h4>
		<?php
		 if(count($this->session->flashdata('errormessage'))>0):
			print_r($this->session->flashdata('errormessage'));
		else :
			echo $this->session->flashdata('errormessage');
		endif ?>
	</div>
</div>
<?php endif ?>

<?php if($this->session->flashdata('successmessage')):?>
<div class="alert alert-dismissible alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<div class="text-center">
		<h3><strong>Congrats!!!</strong></h3>
		<?=$this->session->flashdata('successmessage');?>
	</div>
</div>
<?php endif ?>

<?php if(validation_errors()):?>
	<div class="alert alert-dismissible alert-danger">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<div class="text-center">
		<h4><strong>Ooops!!!</strong></h4>
		<?=validation_errors();?>
	</div>
</div>
<?php endif ?>