

<br><br>

<div class="container" style="float: left;">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php echo $this->session->flashdata('verify_msg'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>User Registration Form</h4>
            </div>
            <div class="panel-body">
                <?php $attributes = array("name" => "registrationform");
                echo form_open("user/do_register", $attributes);?>
				
                <div class="form-group">
                    <label for="User Name">Username</label>
                    <input class="form-control" name="username" placeholder="Username" type="text" value="<?php echo set_value('username'); ?>" />
                    <span class="text-danger"><?php echo form_error('fname'); ?></span>
                </div>
                
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input class="form-control" name="email" placeholder="Email" type="text" value="<?php echo set_value('email'); ?>" />
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>

                <div class="form-group">
                    <label for="Password">Password</label>
                    <input class="form-control" name="password" placeholder="Password" type="password" />
                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                </div>

                <div class="form-group">
                    <label for="Cpassword">Confirm Password</label>
                    <input class="form-control" name="cpassword" placeholder="Confirm Password" type="password" />
                    <span class="text-danger"><?php echo form_error('cpassword'); ?></span>
                </div>
				
				<div class="form-group">
                    <label for="Broj dana">Broj dana odmora</label>
                    <input class="form-control" name="br_dana_odmora" placeholder="Broj dana odmora" type="number" />
                    <span class="text-danger"><?php echo form_error('br_dana_odmora'); ?></span>
                </div>
				
				<div class="form-group">
				<label for="gender">Gender</label>
				<input type="radio" name="gender" value="male" <?php echo set_radio('gender', 'male'); ?>/>Male
				<input type="radio" name="gender" value="female" <?php echo set_radio('gender', 'female'); ?>/>Female
				 <span class="text-danger"><?php echo form_error('gender'); ?></span>
                </div>

                <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-default">Register</button>
                </div>
                <?php echo form_close(); ?>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>