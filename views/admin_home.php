<?php
require_once '../controllers/AdminController.php';

$controller = new AdminController();

include '../views/partials-front/breadcrumb.php';
$limit = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$filters = [
  'first_name' => $_POST['firstName'] ?? '',
  'surName' => $_POST['surName'] ?? '',
  'minAge' => $_POST['minAge'] ?? null,
  'maxAge' => $_POST['maxAge'] ?? null,
];

$patients = $controller->getAllPatients($filters = [], $limit, $offset);

$totalPatients = $controller->countAllPatients();
$totalPages = ceil($totalPatients / $limit);
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
                  <h4 class="card-title">Patients List</h4>
                </div>
                <div class="breadcrumb">
                  <?php generateBreadcrumb('admin_home.php'); ?>
                </div>
              </div>
              <div class="iq-card-body">
                <div class="table-responsive">
                  <div class="justify-content-between">
                    <div class="col-sm-12 col-md-6">

                      <form class="mr-3 position-relative filter-head" method="post" action="admin_home.php">

                        <div class="form-group row">

                          <div class="col-sm-4">
                            <input type="text" name="firstName" class="form-control" placeholder="First Name"></br>
                            <input type="text" name="surName" class="form-control" placeholder="SurName">
                          </div>
                        </div>
                        <div class="form-group row">

                          <div class="col-sm-4">
                            <input type="number" name="minAge" class="form-control" placeholder="Min Age"></br>
                            <input type="number" name="maxAge" class="form-control" placeholder="Max Age">
                          </div>
                        </div>

                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">
                            Filter
                          </button>
                        </div>

                    </div>


                    </form>

                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="user-list-files d-flex float-right">

                    </div>
                  </div>
                </div>
                <table id="patientsTable" class="table table-striped table-bordered mt-0" role="grid" aria-describedby="user-list-page-info">
                  <thead>
                    <tr>
                      <th>Date of Submission</th>
                      <th>First Name</th>
                      <th>Surname</th>
                      <th>Age</th>
                      <th>Date of Birth</th>
                      <th>Total Score</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($patients as $patient) : ?>
                      <tr data-id="<?php echo $patient['id']; ?>">
                        <td><?php echo $patient['formatted_created_at']; ?></td>
                        <td><?php echo $patient['first_name']; ?></td>
                        <td><?php echo $patient['surname']; ?></td>
                        <td><?php echo $patient['age']; ?></td>
                        <td><?php echo $patient['formatted_date_of_birth']; ?></td>
                        <td><?php echo $patient['total_score']; ?></td>

                      </tr>
                    <?php endforeach; ?>
                  </tbody>

                </table>
              </div>
              <div class="justify-content-between mt-3">
                <div id="user-list-page-info" class="col-md-6">
                  <span>Showing <?php echo $totalPatients; ?> entries</span>
                </div>
                <div class="col-md-6">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end mb-0">
                      <?php if ($page > 1) : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                      <?php endif; ?>

                      <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                      <?php endfor; ?>

                      <?php if ($page < $totalPages) : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                      <?php endif; ?>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <?php include './partials-front/footer.php' ?>

  <script>
    $(document).ready(function() {
      $('#patientsTable tbody tr').click(function() {
        var patientId = $(this).data('id');
        window.location.href = 'view_patient.php?id=' + patientId;
      });

    });
  </script>
</body>

</html>