<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Deskripsi informatif dan singkat mengenai website Anda">
  <meta name="keywords" content="<?= esc($web_keywords) ?>">
  <meta name="author" content="<?= esc($web_author) ?>">
  <meta name="robots" content="index, follow">
  <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/public/img/web/<?= esc($web_icon) ?>">
  <link rel="canonical" href="<?= base_url(); ?>">
  
  <title><?= esc($web_title) ?></title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('public/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/css/custom.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- JS -->
    <script src="<?= base_url('public/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/js/jquery-3.6.0.min.js') ?>"></script>
    
  </head>
  <body>
    <nav class="navbar navbar-light bg-white navbar-expand-lg sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url(); ?>">
          <img src="<?= base_url('public/img/web/' . esc($web_logo)) ?>" alt="<?= esc($web_title) ?>" width="150" height="40">
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link mx-1" href="#home">Beranda</a>
            <a class="nav-link mx-1" href="#fitur">Fitur Layanan</a>
            <a class="nav-link mx-1" href="#faq">Pertanyaan Umum</a>
            <a href="<?= base_url(); ?>auth/login" class="btn btn-primary rounded-3 mx-1 px-lg-4">Login</a>
          </div>
        </div>
      </div>
    </nav>
  
<div class="content">
<div class="mt-5">
  <section class="section-1 p-3" id="home">
    <div class="row align-items-center justify-content-between">
      <div class="col-sm-12 col-md-6">
        <h1 class="text-center fw-bold">Jasa Penerima SMS OTP Aplikasi Terbaik</h1>
        <div class="d-flex align-items-center justify-content-center mt-3">
            <a href="<?= base_url(); ?>auth/login" type="button" class="btn btn-primary rounded-3 mx-1">Masuk</a>
            <a href="<?= base_url(); ?>auth/register" type="button" class="btn btn-dark rounded-3 mx-1">Daftar</a>
        </div>
      </div>
      <div class="col-sm-12 col-md-6 pt-5 pt-lg-0">
        <div class="d-flex justify-content-center">
          <img src="public/img/vector/xosgames.png" alt="<?= esc($web_title) ?>" class="w-50">
        </div>
      </div>
    </div>
  </section>
  
  <section class="section-2" id="fitur" style="margin-top: -16px;">
    <div class="bg-primary text-white p-3 p-lg-5">
      <div class="row">
        <div class="col-12 col-lg-6 mt-4">
          <i class="bi bi-check-circle fs-2 p-2 rounded-3 text-warning" style="background: #695EE8;"></i>
          <h2 class="fw-bold mt-3">Mudah digunakan</h2>
          <p class="text-light">Kemudahan pengguna dalam menggunakan layanan kami adalah prioritas kami.</p>
        </div>
        <div class="col-12 col-lg-6 mt-4">
          <i class="bi bi-wallet2 fs-2 p-2 rounded-3 text-warning" style="background: #695EE8;"></i>
          <h2 class="fw-bold mt-3">Pembayaran otomatis</h2>
          <p class="text-light">Tanpa buang-buang waktu, top up saldo sudah otomatis dan proses cepat.</p>
        </div>
        <div class="col-12 col-lg-6 mt-4">
          <i class="bi bi-globe-americas fs-2 p-2 rounded-3 text-warning" style="background: #695EE8;"></i>
          <h2 class="fw-bold mt-3">Stok nomor dari berbagai negara</h2>
          <p class="text-light">Tidak hanya nomor Indonesia, Kami juga menyediakan stok nomor dari berbagai negara.</p>
        </div>
        <div class="col-12 col-lg-6 mt-4">
          <i class="bi bi-aspect-ratio fs-2 p-2 rounded-3 text-warning" style="background: #695EE8;"></i>
          <h2 class="fw-bold mt-3">Akses di semua perangkat</h2>
          <p class="text-light">Kamu bisa akses dari berbagai perangkat dimana saja dan kapan saja.</p>
        </div>
      </div>
      
    </div>
  </section>
  
  <section class="section-3 bg-white p-3 p-lg-5">
    <div class="row mt-5">
      <h1 class="text-center fw-bold">
        Sekarang Terima SMS OTP Makin Mudah dan Cepat
      </h1>
      <div class="col-12 col-lg-6 mt-3">
        <div class="card border-0 rounded-4" style="background: #F1EEFF;">
          <div class="card-body align-items-center justify-content-between mt-2">
            <h2 class="text-center fw-bold">1.000+</h2>
            <p class="text-center">SMS diterima per hari</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 mt-3">
        <div class="card border-0 rounded-4" style="background: #EBF2FA;">
          <div class="card-body align-items-center justify-content-between mt-2">
            <h2 class="text-center fw-bold">100+</h2>
            <p class="text-center">Pengguna per hari</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 mt-3">
        <div class="card border-0 rounded-4" style="background: #FDF9ED;">
          <div class="card-body align-items-center justify-content-between mt-2">
            <h2 class="text-center fw-bold">500+</h2>
            <p class="text-center">Layanan terdaftar</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 mt-3">
        <div class="card border-0 rounded-4" style="background: #FDEDED;">
          <div class="card-body align-items-center justify-content-between mt-2">
            <h2 class="text-center fw-bold">100+</h2>
            <p class="text-center">Negara yang didukung</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section class="section-4 p-3 p-lg-5 pb-5" id="faq">
    <div class="row mt-5">
      <h1 class="text-center fw-bold">
        Ada pertanyaan? Cek FAQ berikut
      </h1>
      <div class="col-12 col-lg-6 mt-3">
        <div class="card border-0 rounded-4">
          <div class="card-body">
            <div class="accordion accordion-flush" id="accordion1">
              <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapseOne">
                      Apa itu Appku?
                    </button>
                  </h2>
                  <div id="flush-collapse1" class="accordion-collapse collapse" data-bs-parent="#accordion1">
                    <div class="accordion-body">Appku merupakan platform yang menyediakan layanan terima SMS OTP online yang bisa kamu gunakan dengan mudah dan cepat.</div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 mt-3">
        <div class="card border-0 rounded-4">
          <div class="card-body">
            <div class="accordion accordion-flush" id="accordion2">
              <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapseOne">
                      Bagaimana cara menggunakan AppKu?
                    </button>
                  </h2>
                  <div id="flush-collapse2" class="accordion-collapse collapse" data-bs-parent="#accordion2">
                    <div class="accordion-body">Silahkan melakukan pendaftaran akun terlebih dahulu, selanjutnya kamu bisa login untuk melihat beberapa panduannya.</div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 mt-3">
        <div class="card border-0 rounded-4">
          <div class="card-body">
            <div class="accordion accordion-flush" id="accordion3">
              <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapseOne">
                      Apakah ada nomor Indonesia?
                    </button>
                  </h2>
                  <div id="flush-collapse3" class="accordion-collapse collapse" data-bs-parent="#accordion3">
                    <div class="accordion-body">Ya ada, AppKu menyediakan nomor dari Indonesia dan beberapa negara lain.</div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 mt-3">
        <div class="card border-0 rounded-4">
          <div class="card-body">
            <div class="accordion accordion-flush" id="accordion4">
              <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapseOne">
                      Berapa harga layanan AppKu?
                    </button>
                  </h2>
                  <div id="flush-collapse4" class="accordion-collapse collapse" data-bs-parent="#accordion4">
                    <div class="accordion-body">Harga layanan AppKu dimulai dari Rp300, harga bisa berbeda tergantung dengan jenis layanan dan negara nomor yang dipilih.</div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section class="section-5">
    <div class="bg-primary text-white p-3 p-lg-5 pt-5 pb-5">
      <h1 class="text-center fw-bold" style="font-size: 46px;">
        Siap untuk mulai?
      </h1>
      <h2 class="text-center fw-bold mt-3">
        Rasakan mudahnya terima OTP di <span class="text-warning">AppKu</span>
      </h2>
      <div class="d-flex justify-content-center mt-4">
        <a href="<?= base_url(); ?>auth/register" type="button" class="btn btn-light border-0 fw-bold rounded-4 p-3 px-4">Daftar Sekarang</a>
      </div>
    </div>
  </section>
  
  <footer class="bottom-0 p-3 mt-5">
    <div class="d-flex justify-content-center">
      <img src="<?= base_url('public/img/web/' . esc($web_logo)) ?>" class="w-50" alt="<?= esc($web_title) ?>">
    </div>
    <p class="text-center mt-5 mb-0"><span class="">©2023 <?= esc($web_title) ?> All rights reserved.</span></p>
  </footer>
  
</div>
</div>

  </body>
</html>