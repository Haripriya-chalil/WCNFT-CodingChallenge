<?php
session_start(); // Start session

require_once '../controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;
    $controller = new AuthController();
    $response = $controller->login($data);

    if ($response['success']) { 
        $_SESSION['email'] = $data['email'];
        $_SESSION['user_id'] = $response['user_id'];  
 
        $redirect_url = "admin_home.php";
        echo json_encode(['status' => 'success', 'msg' => $response['msg'], 'redirect_url' => $redirect_url]);
        exit;
    } else { 
        header("Location: login.php?error=invalid_credentials");
        exit;
    }
}
?>
