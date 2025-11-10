<?php
//requires admin account
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true && isset($_SESSION["usertype"])) {
    //nothing
} else {
    header("location: signin.php");
}
?>