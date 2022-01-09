<aside>

    <?php if (logged_in()) { ?>

        <h3>Welcome username!</h3>
        <a href="logout.php">Logout</a>
    <?php
    } else {

        include 'includes/widgets/loginform.php';
    }
    ?>
</aside>