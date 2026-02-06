
<?php

session_start();
unset($_SESSION['profile_id']);
header("Location:../page%20acceuil/"); // Redirect to the login page

//session_destroy();
?>