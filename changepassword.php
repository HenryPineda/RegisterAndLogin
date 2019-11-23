<?php include '/core/init.php'; ?>

<?php protect_page(); ?>

<?php 



	if(empty($_POST) ===false){

		$required_fields = array('current_password', 'new_password', 'new_password_again');

		foreach ($_POST as $key => $value) {
			if(empty($value) ===true && in_array($key, $required_fields)){

				$errors[] ="The $key is required!";

				break 1;
			}
		}

		if(md5($_POST['current_password']) === $user_data['password']){

			// echo 'We go ahead an validate the new password!';

			if(strlen($_POST['new_password']) < 6){

				$errors[] = 'Password is too short. The password must be at least 6 characters long!';
			}else if (trim($_POST['new_password']) !== trim($_POST['new_password_again'])) {
				
				$errors[] = 'Passwords do not match!';
			}



		}else{

			$errors[] = 'Contraseña incorrecta! Vuela a intentarlo!';
		}

	}

	//print_r($errors);




?>

<?php include '/includes/overall/header.php'; ?>

<?php 

	if(isset($_GET['success']) && empty($_GET['success'])){

		echo 'Your password has been changed!';
	}else {


	


?>

    <h1>Change password</h1>

<?php 



	if(empty($_POST) ===false && empty($errors) ===true){

		//echo "Ready to change the password";

		// $changing_data = array(

		// 	"password" => $_POST['new_password'];


		// );

		$new_password = md5($_POST['new_password']);

		$user_id = $user_data['user_id'];


		change_password($new_password, $user_id);

		header("Location: changepassword.php?success");

		exit();

	}else if(empty($errors) ===false){

		echo print_out_errors($errors);
	
	}


?>
    
    <form action="" method="post">

    	<ul>
    		
    		<li>
    			<label for="current_password">Current password*:</label>
    			
    			<input type="text" name="current_password">
    		</li>

    		<li>
    			<label for="new_password">New password*:</label>
    			<input type="text" name="new_password">
    		</li>

    		<li>
    			<label for="new_password_again">New password again*:</label>
    			<input type="text" name="new_password_again">
    		</li>

    		<li>
    			
    			<input type="submit" value="Guardar">
    		</li>
    	</ul>
    	


    </form>

<?php

	}

?>

    
<?php include '/includes/overall/footer.php'; ?>