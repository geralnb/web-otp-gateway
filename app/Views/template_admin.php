<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    
    <!-- NEW CSS -->
    <link rel="stylesheet" href="<?= base_url('public/new/assets/css/styles.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/css/datatable.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    
    <!-- NEW JS -->
    <script src="<?= base_url('public/new/assets/libs/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/js/sidebarmenu.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/js/app.min.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/libs/apexcharts/dist/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/libs/simplebar/dist/simplebar.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/js/dashboard.js') ?>"></script>
    <script src="<?= base_url('public/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('public/js/dataTables.bootstrap5.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    
  </head>
  <body>
    
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar shadow border-0">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="#" class="text-nowrap logo-img">
            <img src="<?= base_url('public/img/web/' . esc($web_logo)) ?>" width="150" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= ($currentSegment === 'admin/') ? 'active' : ''; ?>" href="<?= base_url(); ?>admin/" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= ($currentSegment === 'admin/deposit') ? 'active' : ''; ?>" href="<?= base_url(); ?>admin/deposit" aria-expanded="false">
                <span>
                  <i class="ti ti-report-money"></i>
                </span>
                <span class="hide-menu">Data Deposit</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">DATA LAYANAN</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= ($currentSegment === 'admin/services') ? 'active' : ''; ?>" href="<?= base_url(); ?>admin/services" aria-expanded="false">
                <span>
                  <i class="ti ti-list-details"></i>
                </span>
                <span class="hide-menu">Services</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">DATA PEMBELIAN</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= ($currentSegment === 'admin/orders') ? 'active' : ''; ?>" href="<?= base_url(); ?>admin/orders" aria-expanded="false">
                <span>
                  <i class="ti ti-clipboard-list"></i>
                </span>
                <span class="hide-menu">Orders</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">LAINNYA</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= ($currentSegment === 'admin/user') ? 'active' : ''; ?>" href="<?= base_url(); ?>admin/user" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">Data Pengguna</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= ($currentSegment === 'admin/contact') ? 'active' : ''; ?>" href="<?= base_url(); ?>admin/contact" aria-expanded="false">
                <span>
                  <i class="ti ti-address-book"></i>
                </span>
                <span class="hide-menu">Contact</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= ($currentSegment === 'admin/settings-web') ? 'active' : ''; ?>" href="<?= base_url(); ?>admin/settings-web" aria-expanded="false">
                <span>
                  <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">Pengaturan Website</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header shadow-sm border-bottom">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="<?= base_url('public/new/assets/images/profile/user-1.jpg') ?>" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up border-0 shadow" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="<?= base_url(); ?>profile" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Profile</p>
                    </a>
                    <a href="<?= base_url(); ?>auth/logout" class="btn btn-outline-danger mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    
      <div class="container-fluid">
        <?= $this->renderSection('content') ?>
      </div>
    </div>
  </div>
  
  </body>
</html>