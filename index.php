<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Form Validation</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style type="text/css">
		input {
			outline: none;
		}
		input.error,
		textarea.error {
			border-color: red;
			color: red;
		}
		label.error {
			margin-bottom: 0px;
			color: red;
			padding-left: 0 !important; 
		}
		.form-check {
			padding-left: 0 !important; 
		}
		.form-check label {
			padding-left: 1.25rem; 
		}
	</style>
</head>
<body>
	<div class="container py-5">
		<form id="register_form" method="post" action="">
			<div class="row">
				<div class="col-6 mb-3">
					<input type="text" class="form-control" placeholder="Name" name="name_field">
				</div>
				<div class="col-6 mb-3">
					<input type="email" class="form-control" placeholder="Email" name="email_field">
				</div>
				<div class="col-6 mb-3">
					<input type="text" class="form-control" placeholder="Date of Birth" name="dob_field">
				</div>
				<div class="col-6 mb-3">
					<input type="text" class="form-control" placeholder="Phone Number" name="phone_number_field">
				</div>
				<div class="col-6 mb-3">
					<input type="password" class="form-control" placeholder="Password" name="password_field">
				</div>
				<div class="col-6 mb-3">
					<input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password_field">
				</div>
				<div class="col-12 mb-3">
					<textarea class="form-control" rows="8" placeholder="Address" name="address_field"></textarea>
				</div>
				<div class="col-12 mb-3">
					<div class="form-check">
						<label class="form-check-label w-100">
							<input type="checkbox" class="form-check-input" value="accept" name="checkbox_field">Accept Terms and Condtions.
						</label>
					</div>
				</div>
				<input type="hidden" name="submit-confirm" value="submit-confirm">
				<button class="btn btn-primary mx-auto">Submit</button>
			</div>
		</form>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/additional-methods.min.js"></script>
	<script type="text/javascript">
		$( "#register_form" ).validate({
			rules: {
				name_field: {
					required: true
				},
				email_field: {
					required: true,
					email: true
				},
				dob_field: {
					required: true,
					date: true
				},
				phone_number_field: {
					required: true,
					minlength: 10,
					maxlength: 10
				},
				password_field: {
					required: true
				},
				confirm_password_field: {
					required: true,
					equalTo: '[name="password_field"]'
				},
				address_field: {
					required: true
				},
				checkbox_field: {
					required: true
				}
			},
			messages: {
				phone_number_field: {
					minlength: "Please enter a valid Phone Number address",
					maxlength: "Please enter a valid Phone Number address"
				},
				confirm_password_field: {
					equalTo: "Please enter a valid email address"
				},
			},
			submitHandler: function (form) {
				form.submit();
			},
			errorPlacement: function(error, element) 
			{
				if ( element.is(":checkbox")) {
					error.appendTo( element.parents('.form-check') );
				}else {
					error.insertAfter( element );
				}
			}
		});
	</script>
	<?php
	if(isset($_POST['submit-confirm']) && ($_POST['submit-confirm'] == 'submit-confirm')) {
		$name_field = isset($_POST['name_field']) ? $_POST['name_field']: '';
		$email_field = isset($_POST['email_field']) ? $_POST['email_field']: '';
		$dob_field = isset($_POST['dob_field']) ? $_POST['dob_field']: '';
		$phone_number_field = isset($_POST['phone_number_field']) ? $_POST['phone_number_field']: '';
		$password_field = isset($_POST['password_field']) ? $_POST['password_field']: '';
		$address_field = isset($_POST['address_field']) ? $_POST['address_field']: '';
		$checkbox_field = isset($_POST['checkbox_field']) ? $_POST['checkbox_field']: '';

		$to = 'dhyeyrajpara.rao@gmail.com';

		$message = "
		お問い合わせ種別: ".$name_field."<br>
		保護者様名: ".$email_field."<br>
		お子さま名: ".$dob_field."<br>
		お子さまのご年齢: ".$phone_number_field."<br>
		ご住所: ".$password_field."<br>
		お電話番号: ".$address_field."<br>
		メールアドレス: ".$checkbox_field."<br>
		";

		$subject = "お問い合わせ: ".$name_field."";

		$headers = "From: " . $email_field . "\r\n";
		$headers .= "Reply-To: " . $email_field . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

		if(mail($to, $subject, $message, $headers)) {
			echo '<script>alert("ありがとうございます。メッセージは送信されました。");</script>';
		} else {
			echo '<script>alert("Failed!");</script>';
		}    
	}
	?>
</body>
</html>