<?php
session_start();

// store to test if they *were* logged in
$old_user = $_SESSION['valid_user'];
unset($_SESSION['valid_user']);
session_destroy();
?>
<html>

<body>

    <?php
    if (!empty($old_user)) {
        header('Location: /teams');
        exit;
    } else {
        header('Location: /teams');
        exit;
    }
    ?>

</body>

</html>