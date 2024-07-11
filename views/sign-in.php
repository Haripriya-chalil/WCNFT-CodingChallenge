<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Patient Care | Signin</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="../public/assets/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../public/assets/css/responsive.css">
    <style>
        .sign-in-page-data {
            padding: 40px;
            margin-left: 25%;
        }
    </style>
</head>
<body>
    <div class="container p-0 signincard">
        <div class="col-md-6 bg-white sign-in-page-data">
            <div class="sign-in-from">
                <div id="infoMessage">
                    <?php
                    if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
                        echo '<div class="alert alert-danger">Invalid email or password. Please try again.</div>';
                    }
                    ?>
                </div>
                <h1 class="mb-0 text-center">Sign in</h1>
                <p class="text-center text-dark">Enter your email address and password to access admin panel.</p>
                <form class="mt-4" id="loginForm" action="login.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="sign-info text-center">
                        <button type="submit" class="btn btn-primary btn-lg d-block w-100 mb-2">Sign in</button>
                    </div>
                    <div class="col-md-6 offset-md-6 text-center">
                        <p>For patient form, <a href="patient_form.php">click here</a></p>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script src="../public/assets/js/jquery.min.js"></script>
    <script src="../public/assets/js/popper.min.js"></script>
    <script src="../public/assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this);
                $.ajax({
                    url: 'login.php',
                    type: 'POST',
                    data: formData.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        let infoMessage = $('#infoMessage');
                        window.location.href = response.redirect_url;
                        if (response.status === 'success') {} else {
                            infoMessage.html('<div class="alert alert-success">' + response.msg + '</div>');
                        }
                        $('html, body').animate({
                            scrollTop: 0
                        }, 'slow');
                    },
                    error: function() {
                        $('#infoMessage').html('<div class="alert alert-danger">Invalid Credentials.</div>');
                    }
                });
            });
        });
    </script>
</body>

</html>