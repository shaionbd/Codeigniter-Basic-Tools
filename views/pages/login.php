<?php include (APPPATH . 'views/partials/_header.php');?>
	<?php include (APPPATH . 'views/partials/_nav.php');?>
	
	<div class="container">
		<div class="row">
			<?php include (APPPATH . 'views/partials/_message.php');?>
			<!-- Sign In part -->
			<div class="col-md-4">
				<h2 class="title">Sign In</h2>
				<hr>
				<?=form_open("sign_in", ['data-parsley-validate'=>'']);?>
					<div class="form-group">
						<?=form_label('Email','email');?>
						<?=form_input(['type'=>'email','value'=>set_value('email'), 'name'=>'email', 'class'=> 'form-control', 'required'=>'', 'placeholder'=>'example@example.com']);?> 
					</div>
					<div class="form-group">
						<?=form_label('Password','password');?>
						<?=form_password(['name'=>'password','value'=>set_value('password'), 'class'=> 'form-control', 'required'=>'', 'placeholder'=>'****']);?>
					</div>
					<div class="form-group">
						<?=form_reset(['name'=>'reset','value'=>'Reset', 'class'=>'btn btn-danger']);?>
						<?=form_submit(['name'=>'submit_signin', 'class'=> 'btn btn-default', 'value'=>'Sign In']);?>
					</div>
				<?=form_close();?>
			</div>
			<!-- /Sign In part -->
			
			<div class="col-md-7 col-md-offset-1">
				<h2 class="title">Sign Up</h2>
				<hr>
				<?=form_open("sign_up", ['data-parsley-validate'=>'']);?>
					<div class="form-group">
						<?=form_label('First Name','fname');?>
						<?=form_input(['name'=>'fname', 'value'=>set_value('fname'), 'class'=> 'form-control', 'required'=>'', 'placeholder'=>'Harold']);?> 
					</div>
					<div class="form-group">
						<?=form_label('Last Name','lname');?>
						<?=form_input(['name'=>'lname', 'value'=>set_value('lname'), 'class'=> 'form-control', 'required'=>'', 'placeholder'=>'Finch']);?> 
					</div>
					<div class="form-group">
						<?=form_label('Email','email');?>
						<?=form_input(['type'=>'email', 'value'=>set_value('email'), 'name'=>'email', 'class'=> 'form-control', 'required'=>'', 'placeholder'=>'example@example.com']);?>
					</div>
					<div class="form-group">
						<?=form_label('Password','password');?>
						<?=form_password(['name'=>'password', 'value'=>set_value('password'), 'class'=> 'form-control', 'required'=>'', 'placeholder'=>'****']);?>
					</div>
					<div class="form-group">
						<?=form_reset(['name'=>'reset','value'=>'Reset', 'class'=>'btn btn-danger']);?>
						<?=form_submit(['name'=>'submit_sigup', 'class'=> 'btn btn-default', 'value'=>'Sign Up']);?>
					</div>
				<?=form_close();?>
			</div>
		</div>
	</div>

<?php include (APPPATH . 'views/partials/_footer.php');?>