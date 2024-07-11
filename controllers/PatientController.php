<?php

require_once __DIR__ . '/../config/database.php';

class PatientController
{
    private $conn;
    public function __construct()
    {
        $this->conn = getDatabaseConnection();
    }

    public function getQuestions()
    {
        $panelName = 'Brief Pain Inventory (BPI)';
        $sql = "{CALL sp_GetQuestionsByPanel(?)}";
    $params = [
        [$panelName, SQLSRV_PARAM_IN]
    ];

    // Execute the stored procedure
    $stmt = sqlsrv_query($this->conn, $sql, $params);

    // Check for errors
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch the results into an array
    $items = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $items[] = $row;
    }

    // Free the statement resource
    sqlsrv_free_stmt($stmt);

    // Return the fetched items
    return $items;
    }
    public function getQuestionsByPatientId()
    {
        $sql = "SELECT * FROM dbo.questions WHERE panel = 'Brief Pain Inventory (BPI)'";
        $stmt = sqlsrv_query($this->conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $items = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $items[] = $row;
        }

        sqlsrv_free_stmt($stmt);
        return $items;
    }
    public function insertPatientData($data)
    {

        $createdDate = null;

        // Check if patient already exists
        $sqlCheck = "{CALL sp_CheckPatientExists(?, ?, ?)}";
        $paramsCheck = [
            [$data['firstName'], SQLSRV_PARAM_IN],
            [$data['surName'], SQLSRV_PARAM_IN],
            [$data['DateOfBirth'], SQLSRV_PARAM_IN]
        ];
        $stmtCheck = sqlsrv_query($this->conn, $sqlCheck, $paramsCheck);
    
        if ($stmtCheck === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_fetch($stmtCheck)) {
            $createdDate = sqlsrv_get_field($stmtCheck, 1);
        }
    
        sqlsrv_free_stmt($stmtCheck);
    
        if ($createdDate != null) {
            return "User data already created on: $createdDate";
        }
    
        // Insert new patient
        $sqlInsert = "{CALL sp_InsertPatient(?, ?, ?, ?, ?, ?)}";
        $patient_id = 0; 
        $paramsInsert = [
            [$data['firstName'], SQLSRV_PARAM_IN],
            [$data['surName'], SQLSRV_PARAM_IN],
            [$data['DateOfBirth'], SQLSRV_PARAM_IN],
            [$data['age'], SQLSRV_PARAM_IN],
            [$data['totalScore'], SQLSRV_PARAM_IN],
            [&$patient_id, SQLSRV_PARAM_OUT]
        ];
    
        $stmtInsert = sqlsrv_query($this->conn, $sqlInsert, $paramsInsert);
    
        if ($stmtInsert === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        sqlsrv_free_stmt($stmtInsert);

        $stmtCheck = sqlsrv_query($this->conn, $sqlCheck, $paramsCheck);

        if ($stmtCheck === false) {
            
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_fetch($stmtCheck)) {
            $patient_id = sqlsrv_get_field($stmtCheck, 0);
        }
    
       // Get question IDs for the panel
        $panelName = 'Brief Pain Inventory (BPI)';
        $sqlQuestions = "{CALL sp_GetQuestionIDs(?)}";
        $paramsQuestions = [
            [$panelName, SQLSRV_PARAM_IN]
        ];
        $stmtQuestions = sqlsrv_query($this->conn, $sqlQuestions, $paramsQuestions);

        if ($stmtQuestions === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        while ($row = sqlsrv_fetch_array($stmtQuestions, SQLSRV_FETCH_ASSOC)) {
            $question_id = $row['id'];
            $score = $data['question_' . $question_id];
    
            $sqlInsertResponse = "{CALL sp_InsertPatientResponse(?, ?, ?)}";
            $paramsInsertResponse = [$patient_id, $question_id, $score];
            $stmtInsertResponse = sqlsrv_query($this->conn, $sqlInsertResponse, $paramsInsertResponse);
    
            if ($stmtInsertResponse === false) {
                die(print_r(sqlsrv_errors(), true));
            }
    
            sqlsrv_free_stmt($stmtInsertResponse);
        }
    
        sqlsrv_free_stmt($stmtQuestions);
    
        return "Form submitted successfully";

        /*
        $createdDate = null;
        $sql = "SELECT FORMAT(created_at, 'yyyy-MM-dd') AS formatted_created_at 
        FROM patients 
        WHERE first_name = ? AND surname = ? AND FORMAT(date_of_birth, 'yyyy-MM-dd') = ?";

        $params = [$data['firstName'], $data['surName'], $data['DateOfBirth']];
        $stmt = sqlsrv_query($this->conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        if (sqlsrv_fetch($stmt)) {
            $createdDate = sqlsrv_get_field($stmt, 0);
        }
        if($createdDate != null)
        {
            return "User data already created on : $createdDate";
            //return($createdDate);
        }
        

        $sql = "INSERT INTO patients (first_name, surname, date_of_birth, age, total_score) VALUES (?, ?, ?, ?, ?)";
        $params = [$data['firstName'], $data['surName'], $data['DateOfBirth'], $data['age'], $data['totalScore']];
        $stmt = sqlsrv_query($this->conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $sql = "SELECT IDENT_CURRENT('patients') AS id";
        $stmt = sqlsrv_query($this->conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        if (sqlsrv_fetch($stmt)) {
            $patient_id = sqlsrv_get_field($stmt, 0);
        }

        sqlsrv_free_stmt($stmt);

        $sql = "SELECT id FROM questions WHERE panel = 'Brief Pain Inventory (BPI)'";
        $stmt = sqlsrv_query($this->conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $question_id = $row['id'];
            $score = $data['question_' . $question_id];

            $sql_insert = "INSERT INTO patient_responses (patient_id, question_id, score) VALUES (?, ?, ?)";
            $params_insert = [$patient_id, $question_id, $score];
            $stmt_insert = sqlsrv_query($this->conn, $sql_insert, $params_insert);

            if ($stmt_insert === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            sqlsrv_free_stmt($stmt_insert);
        }

        sqlsrv_free_stmt($stmt);
        return "Form submitted successfully";
        */

        
    }

    public function __destruct()
    {
        sqlsrv_close($this->conn);
    }
}
