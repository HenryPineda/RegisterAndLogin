<?php

function logged_in()
{
    return (isset($_SESSION['user_id'])) ? true : false; 
}

function user_exists($username, $connection)
{
    $username = sanitize($connection, $username);
    $result = mysqli_query($connection, "SELECT COUNT(`id`) FROM `users` WHERE username='$username'");
    $row = $result->fetch_row();
    if($row[0] == 1){
        return true;
    }else{
        return false;
    }
}

function user_active($username, $connection)
{
    $username = sanitize($connection, $username);
    $result = mysqli_query($connection, "SELECT COUNT(`id`) FROM `users` WHERE username='$username' AND active= 1");
    //var_dump($result->fetch_row());
    $row = $result->fetch_row();
    if($row[0] == 0){
        return false;
    }else{
        return true;
    }
}

function get_user_id($username, $connection)
{
    $username = sanitize($connection, $username);
    $query = "SELECT `id` FROM `users` WHERE `username`='$username'";
    $result = mysqli_query($connection, $query);
    $row = $result->fetch_row();
    return $row[0];

}

function login($username, $password, $connection)
{
    $user_id = get_user_id($username, $connection);
    $username = sanitize($connection, $username);
    $password = sanitize($connection, $password);
    $query = "SELECT COUNT(`id`) FROM `users` WHERE `username` ='$username' AND `password` = '$password'";
    $result = mysqli_query($connection, $query);
    $row = $result->fetch_row();
    //var_dump($row);
    return ($row[0] ==1) ? $user_id : false;
}

?>