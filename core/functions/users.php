<?php 


    function register_user($register_data){

        array_walk($register_data, 'sanitize_user_data');

        $register_data['password'] =md5($register_data['password']);

        $keys = '`'. implode('`, `', array_keys($register_data)). '`'; 

        $values = "'". implode("', '", $register_data). "'";

        mysql_query("INSERT INTO `users` ($keys) VALUES ($values)");



        // print_r($values);

    }

    function user_count(){

        return mysql_result(mysql_query("SELECT COUNT('user_id') FROM `users` WHERE `active` = 1"), 0);
    }



    function user_data($user_id){

        $data = array();
        $user_id = (int)$user_id;

        $func_num_args = func_num_args();

        $func_get_args = func_get_args();

        if ($func_num_args > 1) {
            unset($func_get_args[0]);

            $fields = '`'. implode('`, `', $func_get_args). '`';

            $query = mysql_query("SELECT $fields  FROM `users` WHERE `user_id` = '$user_id'");

            $data = mysql_fetch_assoc($query);

            return $data;
        }     

    }

    function logged_in(){

        return (isset($_SESSION['user_id'])) ? true : false;
    }

    function user_exists($username){


        $username = sanitize($username);
        $query = mysql_query("SELECT COUNT(`user_id`) as `CountUser` FROM `users` WHERE `username` = '$username'");

        return (mysql_result($query, 0, 'CountUser') ==1) ? true : false;

    }

    function email_exists($email){

        $email = sanitize($email);

        $query = mysql_query("SELECT COUNT(`user_id`) as `CountUser` FROM `users` WHERE `email` = '$email'");
        return (mysql_result($query, 0,'CountUser') ==1) ? true : false;
    }

    function user_active($username){

        $username = sanitize($username);

        $query = mysql_query("SELECT COUNT(`user_id`) as `CountUser` FROM `users` WHERE `username` = '$username' AND `active` =1");

        return (mysql_result($query, 0, 'CountUser') ==1) ? true : false; 
    }

    function user_id_from_username($username){

        $username = sanitize($username);

        $query = mysql_query("SELECT `user_id` FROM `users` WHERE `username`= '$username'");
        
        //What happens if the user id is not found?

        return mysql_result($query, 0, 'user_id');
    }

    function login($username, $password){

        $user_id = user_id_from_username($username);

        $username = sanitize($username);
        $password = md5(sanitize($password));

        $query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password`= '$password'");
        return (mysql_result($query, 0) ==1) ? $user_id : false;


    }



?>