
<nav>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="downloads.php">Downloads</a></li>
        <li><a href="forum.php">Forum</a></li>
        <li><a href="contact.php">Contact us</a></li>

        <?php 

            if(logged_in() ===false){

        ?>
                <li><a href="register.php">Register now!</a></li>
        <?php

            }
           
        ?>    

    </ul>

</nav>