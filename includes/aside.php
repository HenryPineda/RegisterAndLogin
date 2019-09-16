
<aside>

    <?php

        if(logged_in()){

            echo 'Logged in!';
        }else{
            include '/includes/widgets/login.php';
        }
    
    ?>

</aside>