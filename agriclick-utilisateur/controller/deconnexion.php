<?php
 

session_start();
 

$_SESSION = array();
 

session_destroy();



header("Location: http://localhost/projet/view/front%20office/login.html");
exit();
?>
