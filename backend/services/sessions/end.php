<?php
// Unset all session variables
$_SESSION = [];

// If using cookies to store the session ID, delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),    // Session cookie name
        '',                // Empty value
        time() - 42000,    // Expire in the past
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroy the session data on the server
session_destroy();
?>