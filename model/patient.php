<?php
require_once '../config/database.php';

class Patient {
    private $conn;

    public function __construct() {
        $this->conn = getDatabaseConnection();
    }

    public function fetchAllPatients($filters = [], $limit = 10, $offset = 0) {
        $sql = "{CALL FetchAllPatientsWithPaginationAndFilters(?, ?, ?, ?, ?, ?)}";

        // Parameters array
        $params = [
            $filters['firstName'] ?? null,
            $filters['surName'] ?? null,
            $filters['minAge'] ?? 0,
            $filters['maxAge'] ?? 100,
            $limit ?? 10,
            $offset ?? 0
        ];
        // Execute stored procedure
        $stmt = sqlsrv_query($this->conn, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        // Fetch results
        $patients = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $patients[] = $row;
        }
    
       
        return $patients;
    }

    public function fetchPatientById($id) {
        $sql = "{CALL FetchPatientById(?)}";
        $params = [$id];

        $stmt = sqlsrv_query($this->conn, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $patient = null;
        if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $patient = $row;
        }

        return $patient;    
    }

    public function fetchPatientResponses($id) {
        $sql = "{CALL FetchPatientResponses(?)}";
        $params = [$id];

        $stmt = sqlsrv_query($this->conn, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $responses = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $responses[] = $row;
        }

        return $responses;
    }

    public function updatePatient($data) { 
        $sql = "{CALL UpdatePatient(?, ?, ?, ?, ?, ?)}";
        $params = [
            $data['patientId'],
            $data['firstName'],
            $data['surName'],
            $data['dateOfBirth'],
            $data['age'],
            $data['totalScore']
        ];

        $stmt = sqlsrv_query($this->conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        return true;
    }

    public function deletePatient($id) {
        $sql = "{CALL DeletePatient(?)}";
        $params = [$id];

        $stmt = sqlsrv_query($this->conn, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        return true;
    }

    public function deletePatientResponses($patientId) { 
        $sqlDelete = "{CALL sp_DeletePatient(?)}";
        $paramsDelete = [
            [$patientId, SQLSRV_PARAM_IN]
        ];
    
        $stmtDelete = sqlsrv_query($this->conn, $sqlDelete, $paramsDelete);
    
        if ($stmtDelete === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        sqlsrv_free_stmt($stmtDelete);
    
        return true;

    }
    public function getSearchResult($firstName) { 
        $sql = "SELECT first_name FROM patients WHERE first_name LIKE ?";
        $params = ["%$firstName%"];
        $stmt = sqlsrv_query($this->conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $patients = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $patients[] = $row;
        }

        return $patients; 
    }
    public function updatePatientResponse($responseId, $score) {  
        $sql = "{CALL UpdatePatientResponse(?, ?)}";
        $params = [$responseId, $score];
        $stmt = sqlsrv_query($this->conn, $sql, $params);
    
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        return true;
    }
    public function totalPatients($firstName = null) {
        $sql = "SELECT COUNT(*) AS total FROM patients";
        $params = [];
    
        if ($firstName !== null) {
            $sql .= " WHERE first_name LIKE ?";
            $params[] = "%$firstName%";
        }
    
        $stmt = sqlsrv_query($this->conn, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        return $row['total'];
    }
}
?>
