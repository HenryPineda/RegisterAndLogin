<?php


    function sanitize($data){

        return mysql_real_escape_string($data);
    }

    function sanitize_user_data(&$item){

    	$item = mysql_real_escape_string($item);
    }

    function print_out_errors($errors){

    	return '<ul><li>'. implode('</li><li>', $errors). '</li></ul>';
    }

    function protect_page(){

    	if(logged_in() ===false){

    		header("Location: protected.php");

    		exit();
    	}
    }

    function logged_in_redirect(){

    	if(logged_in() ===true){

    		header("Location: index.php");

    		exit();
    	}
    }


?>