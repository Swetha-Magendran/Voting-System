<?php
    session_name("backend_session");
    session_start();
    include('function/db_connect.php');
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST['logged_id']))
    {
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();

        // Optionally, delete the backend session cookie (if using cookie-based sessions)
        if (ini_get("session.use_cookies")) {
            setcookie(session_name(), '', time() - 42000, '/');  // Expire the backend session cookie
        }

        echo json_encode('logout');
    }
?>