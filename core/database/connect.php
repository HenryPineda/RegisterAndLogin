<?php 

    $connection_error = 'Sorry we are experiencing some connection problems';

    // mysql_connect('localhost', 'root', '') or die(mysql_error());
    

    mysql_connect('localhost', 'root', '') or die($connection_error);
    mysql_select_db('forum') or die($connection_error);

?> 