<?php
//requires admin account
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true && isset($_SESSION["usertype"]) && $_SESSION["usertype"] === "admin") {
    //nothing
} else {
    header("location: searchpage.php");
}
?>