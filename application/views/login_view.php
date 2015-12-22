



    <div class="container vertical-center">
		<div class="row">
		<br> <br>
		<div class="col-md-6 col-md-offset-3">
			<?php echo $this->session->flashdata('login_msg'); ?>
		</div>
		</div>
      

      <form action="<?=site_url('user/login')?>" method="post" class="form-signin">
       <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="l_email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="l_pass" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>