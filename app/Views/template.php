<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#4D34D5">
    
    <title><?= esc($web_title) ?></title>
    <meta name="description" content="<?= esc($web_description) ?>">
    <meta name="keywords" content="<?= esc($web_keywords) ?>">
    <meta name="author" content="<?= esc($web_author) ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/public/img/web/<?= esc($web_icon) ?>">
    <meta name="robots" content="index, follow">
    
    <!-- NEW CSS -->
    <link rel="stylesheet" href="<?= base_url('public/new/assets/css/styles.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/css/datatable.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
    
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
    
<style>
    .navbar {
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(4px);
        transition: background-color 0.5s ease;
    }
    .buy-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
    }
    .navbar-nav .nav-item {
        width: 100%;
        display: flex;
        justify-content: space-between;
        position: relative;
        align-items: center;
    }
    .navbar-nav .nav-item.buy-button a{
        background-color: #4D34D5;
    }
    .navbar-nav .nav-item.buy-button .small {
        margin-top: 20px;
        color: #000;
    }
    .navbar-nav .nav-item::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 0 3px 0;
        border-color: transparent transparent #4D34D5 transparent;
        transition: all 0.3s ease;
        transform: translateX(-50%);
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    .navbar-nav .nav-item.active::before {
        width: 100%;
    }
    
    .heading-top {
      position: relative;
      top: 0;
      height: 210px;
      width: 100%;
      padding: 20px;
      background: #4D34D5;
      border-bottom-left-radius: 25%;
      border-bottom-right-radius: 25%;
    }
    @media only screen and (max-width: 767px) {
      .content-index {
        margin-top: -110px;
      }
    }
    @media only screen and (min-width: 767px) {
      .content {
        Padding-top: 90px;
      }
    }
    
     @keyframes slideInUp {
        from {
          transform: translateY(100%);
        }
        to {
          transform: translateY(0);
        }
      }
      .card {
        animation: slideInUp 0.8s ease-in-out;
      }
</style>
    
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
                <span class="hide-menu">MENU</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link <?= ($currentSegment === 'user') ? 'active' : ''; ?>" href="<?= base_url(); ?>user" aria-expanded="false">
                  <span>
                    <i class="ti ti-home"></i>
                  </span>
                  <span class="hide-menu">Dashboard</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link <?= ($currentSegment === 'orders') ? 'active' : ''; ?>" href="<?= base_url(); ?>orders" aria-expanded="false">
                  <span>
                    <i class="ti ti-message"></i>
                  </span>
                  <span class="hide-menu">Beli Nomor</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link <?= ($currentSegment === 'deposit') ? 'active' : ''; ?>" href="<?= base_url(); ?>deposit" aria-expanded="false">
                  <span>
                    <i class="ti ti-report-money"></i>
                  </span>
                  <span class="hide-menu">Deposit</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link <?= ($currentSegment === 'history') ? 'active' : ''; ?>" href="<?= base_url(); ?>history" aria-expanded="false">
                  <span>
                    <i class="ti ti-report-search"></i>
                  </span>
                  <span class="hide-menu">Riwayat</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link <?= ($currentSegment === 'mutasi') ? 'active' : ''; ?>" href="<?= base_url(); ?>mutasi" aria-expanded="false">
                  <span>
                    <i class="ti ti-businessplan"></i>
                  </span>
                  <span class="hide-menu">Mutasi Saldo</span>
                </a>
              </li>
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">LAINNYA</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link <?= ($currentSegment === 'hubungi-kami') ? 'active' : ''; ?>" href="<?= base_url(); ?>hubungi-kami" aria-expanded="false">
                  <span>
                    <i class="ti ti-address-book"></i>
                  </span>
                  <span class="hide-menu">Hubungi Kami</span>
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
        <header class="app-header border-bottom shadow-sm d-none d-md-block d-lg-block d-xl-block">
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
      
        <div class="content mb-5">
          <?= $this->renderSection('content') ?>
        </div>
      </div>
    </div>
    
    <!-- Bottom Navbar -->
<nav class="navbar navbar-light navbar-expand shadow border-top fixed-bottom d-md-none d-lg-none d-xl-none p-0">
    <ul class="navbar-nav nav-justified w-100 d-flex">
        <li class="nav-item <?= ($currentSegment === 'user') ? 'active' : ''; ?>">
            <a href="<?= base_url(); ?>user" class="nav-link text-center">
                <i class="ti ti-home fs-6"></i>
                <span class="small d-block">Home</span>
            </a>
        </li>
        <li class="nav-item <?= ($currentSegment === 'deposit') ? 'active' : ''; ?>">
            <a href="<?= base_url(); ?>deposit" class="nav-link text-center">
                <i class="ti ti-cash fs-6"></i>
                <span class="small d-block">Deposit</span>
            </a>
        </li>
        <li class="nav-item d-flex justify-content-center buy-button">
            <a href="<?= base_url(); ?>orders" class="nav-link text-center text-white" style="border-radius: 50%; width: 40px; height: 40px;">
                <i class="ti ti-message fs-6"></i>
                <span class="small d-block">Beli</span>
            </a>
        </li>
        <li class="nav-item <?= ($currentSegment === 'history') ? 'active' : ''; ?>">
            <a href="<?= base_url(); ?>history" class="nav-link text-center">
                <i class="ti ti-history fs-6"></i>
                <span class="small d-block">Riwayat</span>
            </a>
        </li>
        <li class="nav-item <?= ($currentSegment === 'mutasi') ? 'active' : ''; ?>">
            <a href="<?= base_url(); ?>mutasi" class="nav-link text-center">
                <i class="ti ti-report-money fs-6"></i>
                <span class="small d-block">Mutasi</span>
            </a>
        </li>
    </ul>
</nav>
    
    <footer class="footer">
     <div class="container-fluid pb-3 d-none d-md-block">
         <div class="row">
             <div class="col-md-12 footer-copyright text-center">
                 <p class="mb-0">Copyright 2023 © <?= esc($web_title) ?></p>
             </div>
         </div>
     </div>
    </footer>
  
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var greetingText = document.querySelector('.greeting-text');
    var currentTime = new Date().getHours();

    if (currentTime >= 5 && currentTime < 10) {
      greetingText.textContent = 'Selamat Pagi';
    } else if (currentTime >= 10 && currentTime < 15) {
      greetingText.textContent = 'Selamat Siang';
    } else if (currentTime >= 15 && currentTime < 18) {
      greetingText.textContent = 'Selamat Sore';
    } else {
      greetingText.textContent = 'Selamat Malam';
    }
  });
</script>
  
  </body>
</html>