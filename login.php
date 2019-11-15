<?php

    include 'core/init.php';

    logged_in_redirect();

    if(empty($_POST) ===false){

       if (isset($_POST['username']) && isset($_POST['password']) &&   empty($_POST) ===false){

            $username = $_POST['username'];
            $password = $_POST['password'];

            if(empty($username) || empty($password)){

                $errors[] ='You need to enter a username and a password!';

            }else if (user_exists($username) === false){

                $errors[] ='We can\'t find that username. Have you registered?';
            }else if (user_active($username) === false){

                $errors[] = 'You need to activate your account!';
            } else {

                if (strlen($password) < 6) {
                    
                    $errors[] = 'Password is too short. Password must be at least 6 characters long!';
                }

                $login = login($username, $password);

                if($login == false) {

                    $errors[] = 'Username and password combination is incorrect!';

                }else {

                    //Set the session

                    //$_SESSION['user_id']= $login;
                    //Re direct to the home page.

                    $_SESSION['user_id'] = $login;

                    header("Location: index.php");

                    exit();
                }
            }

       }

    }else {

        $errors[] ='No data received!';
    }

    // print_r($errors);

    include 'includes/overall/header.php';

    if (empty($errors) ===false) {
        
    


?>

        <h2>We tried to log you in but ......</h2>

<?php 


        echo print_out_errors($errors);

    }

   include 'includes/overall/footer.php';

?>