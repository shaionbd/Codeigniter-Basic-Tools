<?php include (APPPATH . 'views/partials/_header.php');?>
	<?php include (APPPATH . 'views/partials/_nav.php');?>
	<?php $user = (object)$data;?>
	<div class="container">
		<div class="row">
			<h2 class="title text-center">Your Account</h2>
			<hr>
			<div class="col-md-3">
				<img src="<?=base_url();?>assets/img/<?=$user->image;?>" class="img-responsive" height=300 width=300>

			</div>
			<div class="col-md-6">
				<?php include(APPPATH . 'views/partials/_message.php');?>
				<?=form_open_multipart('account/update',['data-parsley-validate'=>'']);?>
					<div class="form-group">
						<?=form_label('First Name','fname');?>
						<?=form_input(['name'=>'fname', 'value'=> $user->fname, 'class'=> 'form-control', 'required'=>'', 'placeholder'=>'Harold']);?> 
					</div>
					<div class="form-group">
						<?=form_label('Last Name','lname');?>
						<?=form_input(['name'=>'lname', 'value'=>$user->lname, 'class'=> 'form-control', 'required'=>'', 'placeholder'=>'Finch']);?> 
					</div>
					<div class="form-group">
						<?=form_label('Profile Picture','user-image');?>
						<?=form_upload(['id'=>'user-image', 'name'=>'user_image', 'class'=> 'form-control']);?> 
					</div>
					<?=form_submit(['name'=>'postcreate','class'=>'btn btn-primary', 'value'=>'Save Change']);?>
				<?=form_close();?>
			</div>
		</div>
	</div>
<?php include (APPPATH . 'views/partials/_footer.php');?>