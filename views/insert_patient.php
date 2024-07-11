<?php
require_once __DIR__ . '/../controllers/PatientController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;
    $controller = new PatientController();
    $response = $controller->insertPatientData($data);
    echo json_encode(['status' => 'success', 'msg' => $response]);
}
?>
