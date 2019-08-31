<?php

    include 'core/init.php';

    include 'includes/overall/header.php';


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

    print_r($errors);



   include 'includes/overall/footer.php';

?>