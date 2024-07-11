<?php
require_once '../controllers/AdminController.php';
include '../views/partials-front/breadcrumb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $controller = new AdminController();

  $data = [
    'patientId' => $_POST['patientId'],
    'firstName' => $_POST['firstName'],
    'surName' => $_POST['surName'],
    'dateOfBirth' => $_POST['dateOfBirth'],
    'age' => $_POST['age'],
    'totalScore' => $_POST['totalScore'],

  ];
  $controller->updatePatient($data);

  if (isset($_POST['responses']) && is_array($_POST['responses'])) {
    $responses = $_POST['responses'];
    foreach ($responses as $responseId => $score) {
      $controller->updatePatientResponse($responseId, $score);
    }
  }

  header("Location: view_patient.php?id=" . $_POST['patientId']);
  exit();
} elseif (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $controller = new AdminController();
  $patient = $controller->getPatientById($id);
  $patientResponses = $controller->getPatientResponseById($id);
} else {
  header("Location: admin_home.php");
  exit();
}
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
                  <?php generateBreadcrumb('edit_patient.php'); ?>
                </div>
              </div>
              <div class="iq-card-body">
                <form method="POST" action="edit_patient.php">
                  <input type="hidden" name="patientId" value="<?php echo $patient['id']; ?>">
                  <div class="form-horizontal">
                    <div class="form-group row">
                      <label class="control-label col-sm-4 align-self-center mb-0" for="firstName">First Name :</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $patient['first_name']; ?>"><br>

                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-sm-4 align-self-center mb-0" for="surname">SurName :</label>
                      <div class="col-sm-8">
                        <input type="text" id="surName" class="form-control" name="surName" value="<?php echo $patient['surname']; ?>"><br>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-sm-4 align-self-center mb-0" for="date_of_birth">Date of Birth :</label>
                      <div class="col-sm-8">
                        <input type="text" id="dateOfBirth" class="form-control" name="dateOfBirth" value="<?php echo $patient['formatted_date_of_birth']; ?>"><br>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-sm-4 align-self-center mb-0" for="age">Age :</label>
                      <div class="col-sm-8">
                        <input type="text" id="age" name="age" class="form-control" value="<?php echo $patient['age']; ?>"><br>

                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-4 align-self-center mb-0" for="age">Total Score :</label>
                      <div class="col-sm-8">
                        <input type="text" id="totalScore" class="form-control" name="totalScore" value="<?php echo $patient['total_score']; ?>"><br>
                      </div>
                    </div>
                    <label>Responses:</label>
                    <ul>
                      <?php if (isset($patientResponses) && is_array($patientResponses)) : ?>

                        <ul>
                          <?php foreach ($patientResponses as $response) : ?>
                            <div class="form-group row">
                              <label class="control-label col-sm-8 align-self-center mb-0" for="responses[<?php echo $response['question_id']; ?>]"><?php echo $response['question_text']; ?>:</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control calculateTotScore" id="responses[<?php echo $response['response_id']; ?>]" name="responses[<?php echo $response['response_id']; ?>]" min="0" max="<?php echo $response['max_score']; ?>" required value="<?php echo $response['score']; ?>" oninput="validateScore(this)"><br>

                              </div>
                            </div>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
                    </ul>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
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
    function validateScore(input) {
      var min = parseInt(input.getAttribute('min'));
      var max = parseInt(input.getAttribute('max'));
      var value = parseInt(input.value);

      if (value < min) {
        input.setCustomValidity('The score must be at least ' + min);
      } else if (value > max) {
        input.setCustomValidity('The score must not exceed ' + max);
      } else {
        input.setCustomValidity('');
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      var inputs = document.querySelectorAll('input[name^="responses"]');
      inputs.forEach(function(input) {
        input.addEventListener('input', function() {
          validateScore(input);
        });
      });
    });

    $('.calculateTotScore').on('input', function() {
      var totalScore = 0;
      $('.calculateTotScore').each(function() {
        var value = parseFloat($(this).val()) || 0;
        totalScore += value;
      });
      $('#totalScore').val(totalScore);
    });
  </script>
</body>

</html>