<div class="limiter">
	<div class="container-login100">
<div class="wrap-login100" style="flex-direction: row">
				<div class="login100-more" style="background-image: url('<?= $this->Url->build("/img/login2.jpg") ?>');" ></div>

			<?= $this->Form->create(null, ['class' => 'login100-form validate-form']) ?>
			<br><br><br><br>
				<span class="login100-form-title p-b-34">
Login 				</span>

				<!-- Username -->
				<div class="wrap-input100 validate-input m-b-20" data-validate="Type user name" style="position: relative;">
					<?= $this->Form->control('email', [
						'label' => false,
						'placeholder' => 'Username',
						'required' => true,
						'class' => 'input100',
						'templates' => [
							'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>'
						]
					]) ?>
					<span class="focus-input100"></span>
					<i class="fa fa-user icon-input" aria-hidden="true"></i>
				</div>

				<!-- Password -->
				<div class="wrap-input100 validate-input m-b-20" data-validate="Type password" style="position: relative;">
					<?= $this->Form->control('password', [
						'label' => false,
						'placeholder' => 'Password',
						'required' => true,
						'class' => 'input100',
						'templates' => [
							'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>'
						]
					]) ?>
					<span class="focus-input100"></span>
					<i class="fa fa-lock icon-input" aria-hidden="true"></i>
				</div>

				<!-- Login Button -->
				<div class="container-login100-form-btn">
					<?= $this->Form->button(' Login', ['class' => 'login100-form-btn']) ?>
				</div>

			

			

			<?= $this->Form->end() ?>

		</div>
	</div>
</div>

	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>