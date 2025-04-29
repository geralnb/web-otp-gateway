<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?= esc($web_title) ?></title>
    <meta name="description" content="<?= esc($web_description) ?>">
    <meta name="keywords" content="<?= esc($web_keywords) ?>">
    <meta name="author" content="<?= esc($web_author) ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/public/img/web/<?= esc($web_icon) ?>">
    <meta name="robots" content="index, follow">
    
    <!-- NEW CSS -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('public/new/assets/images/logos/favicon.png') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/new/assets/css/styles.min.css') ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
    
    <!-- NEW JS -->
    <script src="<?= base_url('public/new/assets/libs/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/js/sidebarmenu.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/js/app.min.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/libs/apexcharts/dist/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/libs/simplebar/dist/simplebar.js') ?>"></script>
    <script src="<?= base_url('public/new/assets/js/dashboard.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
 
    
  </head>
  <body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed">
      <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
          <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
                <?= $this->renderSection('content') ?>
            </div>
          </div>
        </div>
      </div>
    </div>
   
  </body>
</html>