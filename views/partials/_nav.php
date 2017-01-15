<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="<?=base_url();?>">Social Site</a>
	    </div>

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	      <?php if(isset($this->session->user_id)):?>
	      	<li><a href="logout">Log Out</a></li>
	      	<li><a href="account">Account</a></li>
	      <?php else :?>
	      	<li><a href="login">Log In</a></li>
	      <?php endif ?>
	      </ul>
	      <!-- <form class="navbar-form navbar-right" role="search">
	        <div class="form-group">
	          <input class="form-control" placeholder="Search" type="text">
	        </div>
	        <button type="submit" class="btn btn-default">Search</button>
	      </form> -->
	    </div>
	  </div>
	</nav>