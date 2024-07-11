<?php
function generateBreadcrumb($currentPage) {
     
    if ($currentPage == 'admin_home.php') {
        $breadcrumbs[] = 'Home';
    } elseif (strpos($currentPage, 'view_patient.php') !== false) {
        $breadcrumbs[] = '<a href="admin_home.php">Home</a>';
        $breadcrumbs[] = 'View Patient';
    } elseif (strpos($currentPage, 'edit_patient.php') !== false) {
        $breadcrumbs[] = '<a href="admin_home.php">Home</a>';
        $breadcrumbs[] = '<a href="view_patient.php?id=' . $_GET['id'] . '">View Patient</a>';
        $breadcrumbs[] = 'Edit Patient';
    }

    echo implode(' > ', $breadcrumbs);
}
?> 