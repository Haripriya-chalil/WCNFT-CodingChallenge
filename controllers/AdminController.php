<?php
require_once '../model/Patient.php';

class AdminController {
    private $patientModel;

    public function __construct() {
        $this->patientModel = new Patient();
    }

    public function getAllPatients($filters = [], $limit = 10, $offset = 0) {
        
        return $this->patientModel->fetchAllPatients($filters, $limit, $offset);
    }
 

    public function getPatientById($id) {
        return $this->patientModel->fetchPatientById($id);
    }

    public function getPatientResponseById($id) {
        return $this->patientModel->fetchPatientResponses($id);
    }

    public function updatePatient($data) { 
        return $this->patientModel->updatePatient($data);
    }

    public function deletePatient($id) { 
        $this->patientModel->deletePatientResponses($id);
        return $this->patientModel->deletePatient($id);
    }

    public function getSearchResult($firstName) { 
        return $this->patientModel->getSearchResult($firstName);
    }
    public function updatePatientResponse($responseId, $score) {
        return $this->patientModel->updatePatientResponse($responseId, $score);
    }
    
    public function countAllPatients()
    {
        return $this->patientModel->totalPatients();
    }
}
?>
