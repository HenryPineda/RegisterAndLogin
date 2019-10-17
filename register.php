
<?php include '/core/init.php'; ?>

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
		}

		
	}


	echo '<pre>', print_r($errors, true), '</pre>';


?>

<h1>Register</h1>

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


<?php include '/includes/overall/footer.php'; ?>