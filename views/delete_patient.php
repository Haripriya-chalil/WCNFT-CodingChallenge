<?php
require_once '../controllers/AdminController.php';
$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);

    
    $controller = new AdminController(); 
    if ($controller->deletePatient($id)) {
        $response['message'] = 'Patient deleted successfully.';
        $response['success'] = true;
    } else {
        $response['message'] = 'Failed to delete patient.';
        $response['success'] = false;
    }
} else {
    $response['message'] = 'Invalid request.';
    $response['success'] = false;
}

echo json_encode($response);
?>
