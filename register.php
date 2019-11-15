
<?php include '/core/init.php'; ?>

<?php logged_in_redirect(); ?>

<?php include '/includes/overall/header.php'; ?>

<?php 

	if(empty($_POST) ==false){

		// die($_POST);

		$required_fields = array('first_name', 'last_name', 'email', 'username', 'password');

		// echo '<pre>', print_r($_POST, true),'</pre>';

		//if the field's value is empty and is in the array of required fields then append to error.

		foreach ($_POST as $key => $value) {
			if (empty($value) && in_array($key, $required_fields) ==true ) {
				$errors[] = "The $key field is required";
			}
		}

		if (empty($errors)) {
			
			if (user_exists($_POST['username'])) {
				$errors[] = 'Sorry, The username \''.htmlentities($_POST['username']). '\' is already in use';
			}

			if (preg_match("/\\s/", $_POST['username']) == true) {

				$errors[] = 'Your username must not contain any spaces';
			}

			if (strlen($_POST['password']) < 6) {
				$errors[] = 'Your password is too short, Your password needs to be at least 6 characters long!';
			}

			if ($_POST['password'] !== $_POST['repeat_password']) {
				$errors[] = 'Your passwords do not match!, try again!';
			}

			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ===false) {
				$errors[] = 'A valid email address is required';
			}

			if (email_exists($_POST['email'])) {
				$erros[] = 'Sorry, this email \''.$_POST['email'].'\' is already in use!';
			}
		}

		
	}


	// echo '<pre>', print_r($errors, true), '</pre>';


?>

<?php

	if(isset($_GET['success']) && empty($_GET['success'])){

		echo 'You have been registered!';


	}else{
	
?>
	<h1>Register</h1>

	<?php 

		if (empty($_POST) ===false && empty($errors) ===true) {

			$register_data = array(

				"username" => $_POST['username'],
				"password" => $_POST['password'],
				"first_name" => $_POST['first_name'],
				"last_name" => $_POST['last_name'],
				"email" => $_POST['email']

			);

			// $register_data['password'] =md5($register_data['password']);

			register_user($register_data);

			header("Location: register.php?success");

			exit();
			
		}else {

			echo print_out_errors($errors);
		}


	?>

	<form action="" method="POST">

		<ul class="form">
			
			<li>
				<label for="first_name">First name</label>
				<input type="text" name="first_name">
			</li>

			<li>
				<label for="last_name">Last name</label>
				<input type="text" name="last_name">
			</li>

			<li>
				<label for="email">Email</label>
				<input type="text" name="email">
			</li>

			<li>
				<label for="Username">Username</label>
				<input type="text" name="username">
			</li>

			<li>
				<label for="password">Password</label>
				<input type="password" name="password">
			</li>

			<li>
				<label for="repeat_name">Repeat password</label>
				<input type="password" name="repeat_password">
			</li>
			<li><input type="submit" value="register"></li>
		</ul>
		

	</form>
<?php

	}


?>




<?php include '/includes/overall/footer.php'; ?>