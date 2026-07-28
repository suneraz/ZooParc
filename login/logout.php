<?php
session_start();
session_unset(); 
session_destroy(); 

// Ensure no output before this
header('Location: ../index.php');
exit();
?>



