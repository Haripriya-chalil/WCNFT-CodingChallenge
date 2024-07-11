<?php
require_once '../controllers/AdminController.php'; 

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $controller = new AdminController();
  $patient = $controller->getPatientById($id);
  $patientResponses = $controller->getPatientResponseById($id); 
} else {
  header("Location: admin_home.php");
  exit();
}
include '../views/partials-front/breadcrumb.php';
?>
<?php include './partials-front/header.php' ?>

<body>
  <div class="wrapper">
    <?php include './partials-front/menu.php' ?>

    <!-- Page Content  -->
    <div id="content-page" class="content-page">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="iq-card">
              <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                  <h4 class="card-title">Patients Details</h4>
                </div>
                <div class="breadcrumb">
                  <?php generateBreadcrumb('view_patient.php'); ?>
                </div>
              </div>

              <div class="iq-card-body">
                <form id="patientDetailsForm">
                  <div class="form-horizontal" action="">
                    <div class="form-group row">
                      <label class="control-label col-sm-4 align-self-center mb-0" for="firstName">First Name :</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $patient['first_name']; ?>" readonly><br>

                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-sm-4 align-self-center mb-0" for="surname">SurName :</label>
                      <div class="col-sm-8">
                        <input type="text" id="surName" class="form-control" name="surName" value="<?php echo $patient['surname']; ?>" readonly><br>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-sm-4 align-self-center mb-0" for="date_of_birth">Date of Birth :</label>
                      <div class="col-sm-8">
                        <input type="text" id="dateOfBirth" class="form-control" name="dateOfBirth" value="<?php echo $patient['formatted_date_of_birth']; ?>" readonly><br>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-sm-4 align-self-center mb-0" for="age">Age :</label>
                      <div class="col-sm-8">
                        <input type="text" id="age" name="age" class="form-control" value="<?php echo $patient['age']; ?>" readonly><br>

                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-4 align-self-center mb-0" for="age">Total Score :</label>
                      <div class="col-sm-8">
                        <input type="text" id="totalScore" class="form-control" name="totalScore" value="<?php echo $patient['total_score']; ?>" readonly><br>
                        <input type="text" class="form-control" id="patientId" name="patientId" hidden />
                      </div>

                    </div>
                    <label>Responses:</label>
                    <ul>
                      <?php foreach ($patientResponses as $response) : ?>
                        <div class="form-group row">
                          <label class="control-label col-sm-8 align-self-center mb-0" for="question_text"><?php echo $response['question_text']; ?> :</label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" id="score" name="score" value="<?php echo $response['score']; ?>" readonly><br>

                          </div>
                        </div>
                      <?php endforeach; ?>
                    </ul>


                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" onclick="editPatient(<?php echo $patient['id']; ?>)">Edit</button>
                      <button type="button" class="btn btn-primary" onclick="deletePatient(<?php echo $patient['id']; ?>)">Delete</button>

                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include './partials-front/footer.php' ?>
  <script>
    function editPatient(patientId) {
      window.location.href = 'edit_patient.php?id=' + patientId;
    }

    function deletePatient(patientId) {
      if (confirm('Are you sure you want to delete this patient?')) {
        $.post('delete_patient.php', {
          id: patientId
        }, function(response) {
          alert(response.message);
          if (response.success) {
            window.location.href = 'admin_home.php';
          }
        }, 'json');
      }
    }
  </script>
</body>
</html>