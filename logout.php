<?php
    // frontend_logout.php
    //session_name("frontend_session");  // Specify frontend session
    session_start();  // Start the frontend session
    include('function/db_connect.php');
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_GET['logged_id']))
    {
        // Unset all session variables for frontend
        session_unset();

        // Destroy the session
        session_destroy();

        // Optionally, delete the frontend session cookie (if using cookie-based sessions)
        if (ini_get("session.use_cookies")) {
            setcookie(session_name(), '', time() - 42000, '/');  // Expire the frontend session cookie
        }

        // Redirect to the homepage or login page
        header("Location: index.php");  // Redirect user to homepage or login page
        exit();
    }
?>