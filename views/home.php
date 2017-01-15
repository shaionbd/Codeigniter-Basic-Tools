<?php include('partials/_header.php');?>
	<?php include('partials/_nav.php');?>
	<div class="container">
		<section class="row new-post">
			<div class="col-md-6 col-md-offset-3">
				<?php include('partials/_message.php');?>
				<header>
					<h3>What do you have to say?</h3>
				</header><!-- /header -->
				<?=form_open('post/create',['data-parsley-validate'=>'']);?>
					<div class="form-group">
						<?=form_textarea(['name'=> 'body', 'id'=>'body', 'rows'=>'3', 'class'=>'form-control', 'required'=>'']);?>
					</div>
					<?=form_submit(['name'=>'postcreate','class'=>'btn btn-primary', 'value'=>'Create Post']);?>
				<?=form_close();?>
			</div>	
		</section><!-- Create post ended here -->

		<section class="row posts">
			<div class="col-md-6 col-md-offset-3">
				<header>
					<h3>What other people say ... </h3>
				</header><!-- /header -->
				<!-- All posts come by one to one on atricle -->
				<div id="posts" class="posts">
					<?php foreach($posts as $post):?>
					<article class="post" data-postId="<?=$post->id?>">
						<p class="post-content"><?=$post->body?></p>
						<div class="info">
							<span>Posted by Shakil </span>
						</div>
						<div class="interaction">
							<a href="#" class="like">Like</a> 
							<?php if($this->session->user_id == $post->user_id):?>
								|
								<a href="#" class="edit">Edit</a>
								|
								<a href="post/delete/<?=$post->id?>">Delete</a>
							<?php endif ?>
						</div>
					</article>
					<?php endforeach ?>
				</div>
				 <!--  Posts end here-->
			</div>
		</section>
		<!-- Modal -->
		<div id="edit-modal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Edit Post</h4>
		      </div>
		      <?=form_open('',['method'=>'get','id'=>'form-edit','data-parsley-validate'=>'']);?>
		      <div class="modal-body">
	        	<div class="form-group">
	        		<?=form_label('post-body',"Edit The Post");?>
	        		<?=form_textarea(['name'=> 'post-body', 'id'=>'post-body', 'rows'=>'5', 'class'=>'form-control', 'required'=>'']);?>
	        	</div>
		      </div>
		      <div class="modal-footer">
		      	<button type="submit" id="modal-post-save" class="btn btn-primary">Save</button>
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		      </div>
		      <?=form_close();?>
		    </div>
		  </div>
		</div>
	</div>
<?php include('partials/_footer.php');?>
