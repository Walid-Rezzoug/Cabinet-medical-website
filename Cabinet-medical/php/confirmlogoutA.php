
<?php

session_start();
unset($_SESSION['mama']);
header("Location:../page%20acceuil/"); // Redirect to the login page

//session_destroy();
?>