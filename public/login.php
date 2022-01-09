<?php

include 'core/init.php';
include 'includes/overall/header.php';

//var_dump($connection);
//var_dump(user_exists($_POST['username'], $connection));
// var_dump(login($_POST['username'], $_POST['password'], $connection));
// die();

if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $errors[] = "Please provide username and password!";
    } elseif (user_exists($username, $connection) === false) {
        $errors[] = "We cannot find the user! Have you register?";
    } elseif (user_active($username, $connection) === false) {
        $errors[] = "User has not actived the account!";
    } else {
        //var_dump('User found!');
        $login = login($username, $password, $connection);
        if ($login === false) {
            $errors[] = "Username and password combination not valid";
        } else {
            $_SESSION['user_id'] = $login;
            header('Location: index.php');
            exit();
        }
    }

    //print_r($errors);
} else {
    $errors[] = "No data provided!";
}
?>

<ul>
    <?php foreach($errors as $error) : ?>
        <li><?php echo $error; ?></li>
    <?php endforeach; ?>
</ul>

<?php include 'includes/overall/footer.php'; ?>