<?php
require_once '../controllers/PatientController.php'; 
$controller = new PatientController();
$questions = $controller->getQuestions();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TWCNFT-Coding Challenge | Patient Form</title>
    <link rel="shortcut icon" href="../public/assets/images/favicon.ico" />
    <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/assets/css/typography.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link rel="stylesheet" href="../public/assets/css/responsive.css">
</head>

<body>
    <header class="fixed-top header-style" id="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-between align-items-center">
                    <div class="iq-navbar-logo d-flex justify-content-between">
                        <a href="#" class="header-logo">
                            <img src="../public/assets/images/patient-logo.jpg" class="img-fluid rounded" alt="" />
                            <span>TWCNFT-Coding Challenge</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="wrapper">
        <div class="patientform-page">
            <div class="container">
                <div class="row patient-form">
                    <div class="col-lg-9">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Neuro Modulation</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="list-group">
                                    <div id="infoMessage" class="mt-3"></div>
                                    <form class="form-horizontal" id="patientForm" action="../views/insert_patient.php" method="post">
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1 text-light mb-3">Patient Details</h5>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-4 align-self-center mb-0" for="firstName">First Name :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-4 align-self-center mb-0" for="surName">Last Name :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="surName" name="surName" placeholder="Surname" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-4 align-self-center mb-0" for="dateOfBirth">Date of Birth :</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" id="dateOfBirth" name="DateOfBirth" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-4 align-self-center mb-0" for="age">Age :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="age" name="age" placeholder="Age">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item question-block">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1 text-light mb-3">Brief Pain Inventory (BPI)</h5>
                                            </div>
                                            <small class="text-muted mb-3 d-block f14">First question scores 0 - 100 , all other questions 0 - 10</small>
                                            <?php foreach ($questions as $question) { ?>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-10 align-self-center mb-0" for="question_<?php echo $question['id']; ?>">
                                                        <?php echo htmlspecialchars($question['question_text']) . ' (' . htmlspecialchars($question['max_score']) . ')'; ?>
                                                    </label>
                                                    <div class="col-sm-2">
                                                        <input type="number" class="form-control number-field calculateTotScore" id="question_<?php echo $question['id']; ?>" name="question_<?php echo $question['id']; ?>" min="0" max="<?php echo htmlspecialchars($question['max_score']); ?>" required>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-6 align-self-center mb-0" for="totalScore">Total Score :</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="totalScore" name="totalScore" placeholder="-" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-cta">
                                            <button type="button" class="btn btn-outline-secondary">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../public/assets/js/jquery.min.js"></script>
    <script src="../public/assets/js/popper.min.js"></script>
    <script src="../public/assets/js/bootstrap.min.js"></script> 

    <script>
        $(document).ready(function() { 
            var today = new Date().toISOString().split('T')[0];
            $('#dateOfBirth').attr('max', today);

            function calculateAge(dateOfBirth) {
                var DOB = new Date(dateOfBirth);
                var today = new Date(); 
                var ageDifMs = today - DOB;
                var ageDate = new Date(ageDifMs);   
                var age = Math.abs(ageDate.getUTCFullYear() - 1970); 
                return age;
            }

            $('#dateOfBirth').on('input', function() {
                var dateOfBirth = $(this).val();
                var age = calculateAge(dateOfBirth);                 
                    $('#age').val(age);                
            });

            $('.calculateTotScore').on('input', function() {
                var totalScore = 0;
                $('.calculateTotScore').each(function() {
                    var value = parseFloat($(this).val()) || 0;
                    totalScore += value;
                });
                $('#totalScore').val(totalScore);
            });

            $('#patientForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this);
                $.ajax({
                    url: '../views/insert_patient.php',
                    type: 'POST',
                    data: formData.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        let infoMessage = $('#infoMessage');
                        if (response.status === 'success') {
                            if (response.msg == 'Form submitted successfully') {
                                infoMessage.html('<div class="alert alert-success">' + response.msg + '</div>');
                            } else {
                                infoMessage.html('<div class="alert alert-danger">' + response.msg + '</div>');
                            }

                        } else {
                            infoMessage.html('<div class="alert alert-danger">' + response.msg + '</div>');
                        }
                        $('html, body').animate({
                            scrollTop: 0
                        }, 'slow');
                        formData[0].reset();
                    },
                    error: function() {
                        $('#infoMessage').html('<div class="alert alert-danger">Something went wrong.</div>');
                    }
                });
            });

            $('.number-field').on('keypress', function(event) {
                var keyCode = event.which ? event.which : event.keyCode;
                if (keyCode < 48 || keyCode > 57) {
                    event.preventDefault();
                }
            });

        });
    </script>
</body> 
</html>