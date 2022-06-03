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
if (!empty($old_user))
{
    echo 'Logged out.<br />';
}
else
{
    echo 'You were not logged in! <br />';
}
?>

</body>
</html>