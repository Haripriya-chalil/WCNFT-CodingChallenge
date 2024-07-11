<?php
require_once dirname(__DIR__, 2) . '/config.php';
?>

<div class="iq-sidebar">
  <div class="iq-navbar-logo d-flex justify-content-between">
    
    <a href="<?php echo $_ENV['BASE_URL']; ?>/admin_home.php" class="header-logo">
      <img src="../public/assets/images/patient-logo.jpg" class="img-fluid rounded" alt="" />
      <span>TWCNFT</span>
    </a>
    <div class="iq-menu-bt align-self-center">
      <div class="wrapper-menu">
        <div class="main-circle"><i class="ri-menu-line"></i></div>
        <div class="hover-circle"><i class="ri-close-fill"></i></div>
      </div>
    </div>
  </div>
  <div id="sidebar-scrollbar">
    <nav class="iq-sidebar-menu">
      <ul id="iq-sidebar-toggle" class="iq-menu">
        <li class="active">
          <a href="<?php echo $_ENV['BASE_URL']; ?>/admin_home.php">
            <span class="ripple rippleEffect"></span>
            <i class="las la-home iq-arrow-left"></i>
            <span>Patient Details</span>
          </a>

        </li>
      </ul>
    </nav>
    <div class="p-3"></div>
  </div>
</div>
<!-- TOP Nav Bar -->
<div class="iq-top-navbar">
  <div class="iq-navbar-custom">
    <nav class="navbar navbar-expand-lg navbar-light p-0">
      <div class="iq-menu-bt d-flex align-items-center">
        <div class="wrapper-menu">
          <div class="main-circle"><i class="ri-menu-line"></i></div>
          <div class="hover-circle"><i class="ri-close-fill"></i></div>
        </div>
        <div class="iq-navbar-logo d-flex justify-content-between ml-3">
          <a href="<?php echo $_ENV['BASE_URL']; ?>/admin_home.php" class="header-logo">
            <img src="../public/assets/images/patient-logo.jpg" class="img-fluid rounded" alt="" />
            <span>TWCNFT</span>
          </a>
        </div>
      </div>

      <div class="collapse navbar-collapse" id="navbarSupportedContent"></div>
      <ul class="navbar-list">
        <li class="line-height">
          <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
            <img src="../public/assets/images/user/1.jpg" class="img-fluid rounded mr-3" alt="user" />
            <div class="caption">
              <h6 class="mb-0 line-height">Admin</h6>
              <p class="mb-0">Admin</p>
            </div>
          </a>
          <div class="iq-sub-dropdown iq-user-dropdown">
            <div class="iq-card shadow-none m-0">
              <div class="iq-card-body p-0">
                <div class="d-inline-block w-100 text-center p-3">
                  <a class="bg-primary iq-sign-btn" href="sign-in.php" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</div>