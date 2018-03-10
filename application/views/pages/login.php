<div class="limiter" id="login-view">
	<div class="container-login100">
		<div class="wrap-login100">
			<form class="login100-form validate-form" id="login-form">
				<span class="login100-form-title p-b-26">
					Welcome
				</span>
				<span class="login100-form-title p-b-48">
					<i class="zmdi zmdi-font"></i>
				</span>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
					<input class="input100" type="text" name="email" placeholder="Enter Your Email">
					<span class="focus-input100" data-placeholder="Email"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Enter password">
					<input class="input100" type="password" name="pass" placeholder="Enter Your Password">
					<span class="focus-input100" data-placeholder="Password"></span>
				</div>
				<br>
				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
						<button type="submit" class="login100-form-btn" id="login-btn">
							Login
						</button>
					</div>
					<div id="error_msg" style="color: #ff7675;margin-top: 10px;">
						<?= $error_msg ?>
					</div>
				</div>


				<div class="text-center p-t-115">
					<span class="txt1">

						<br>
						Don’t have an account?
					</span>

					<a class="txt2" href="#" id="view-register">
						Sign Up
					</a>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="limiter" id="register-view" style="display: none;">
	<div class="container-login100">
		<div class="wrap-login100" style="width: 700px;">
			<form class="login100-form validate-form" id="register-form">
				<span class="login100-form-title p-b-26">
					Register
				</span>
				<span class="login100-form-title p-b-48">
					<i class="zmdi zmdi-font"></i>
				</span>

				<div class="wrap-input100 validate-input" data-validate = "First Name">
					<input class="input100" type="text" name="fname" placeholder="Enter First Name" autocomplete="off">
					<span class="focus-input100" data-placeholder="First Name"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Middle Name">
					<input class="input100" type="text" name="mname" placeholder="Enter Middle Name" autocomplete="off">
					<span class="focus-input100" data-placeholder="Email"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Last Name">
					<input class="input100" type="text" name="lname" placeholder="Enter Last Name" autocomplete="off">
					<span class="focus-input100" data-placeholder="Email"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
					<input class="input100" type="text" name="email" placeholder="Enter Your Email" autocomplete="off">
					<span class="focus-input100" data-placeholder="Email"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Enter password">
					<input class="input100" type="password" name="password" placeholder="Enter Your Password" autocomplete="off">
					<span class="focus-input100" data-placeholder="Password"></span>
				</div>
				<br>
				<div class="container-login100-form-btn">
					<div class="wrap-login100-form-btn">
						<div class="login100-form-bgbtn"></div>
						<button class="login100-form-btn">
							Register
						</button>
					</div>
					<div id="error_msgx" style="color: #ff7675;margin-top: 10px;">
						<?= $error_msg ?>
					</div>
				</div>

				<div class="text-center p-t-115" style="padding-top: 70px;">
					<span class="txt1">
						Already have an account?
					</span>

					<a class="txt2" href="#" id="view-login">
						Login
					</a>
				</div>
			</form>
		</div>
	</div>
</div>
	

	<div id="dropDownSelect1"></div>

	<script type="text/javascript" src="<?= base_url() ?>assets/js/site/logreg.js"></script>