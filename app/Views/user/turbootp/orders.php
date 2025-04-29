<?php $this->extend('template'); ?>
<?php $this->section('content'); ?>

<style>
svg path,
svg rect{
  fill: #573EE0;
}
.loading-spinner {
  display: none;
  margin-left: 10px;
}
ol li {
  padding: 5px;
}
</style>

<div class="heading-top d-md-none d-lg-none d-xl-none">
  <div class="item-heading d-flex justify-content-between align-items-center">
    <div class="bg-white" style="width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
      <a href="<?= base_url() ?>user" class="text-dark">
        <i class="ti ti-arrow-narrow-left" style="font-size: 28px;"></i>
      </a>
    </div>
      <span class="fw-semibold text-white fs-6">Beli Nomor</span>
      <ul class="navbar-nav flex-row align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= base_url('public/new/assets/images/profile/user-1.jpg') ?>" alt="" width="35" height="35" class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up border-0 shadow" aria-labelledby="drop2">
            <div class="message-body">
              <a href="<?= base_url(); ?>profile" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-user fs-6"></i>
                <p class="mb-0 fs-3">Profil</p>
              </a>
              <a href="<?= base_url(); ?>hubungi-kami" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-address-book fs-6"></i>
                <p class="mb-0 fs-3">Hubungi Kami</p>
              </a>
              <a href="<?= base_url(); ?>auth/logout" class="btn btn-outline-danger mx-3 mt-2 d-block">Logout</a>
            </div>
          </div>
        </li>
      </ul>
  </div>
</div>

<div class="container-fluid">
  <div class="content-index mb-4">
    <div class="row">
      <div class="col-12 col-lg-6">
        <div class="card border-0 shadow">
          <div class="card-body">
            <form id="orderForm" action="<?= base_url(); ?>orders-proces" method="post" onsubmit="return submitForm()">
              <?= csrf_field() ?>
              <div class="mb-3">
                  <label for="service" class="form-label">Pilih Aplikasi:</label>
                  <select class="form-select" name="service" id="service" onchange="updateSelectedService()">
                      <?php foreach ($services as $service): ?>
                          <option value="<?= $service['service_id'] ?>" data-name="<?= $service['service_name'] ?>" data-price="<?= $service['price'] ?>"><?= $service['service_name'] ?> - Rp <?= number_format($service['price'], 0, ',', '.') ?>
                          </option>
                      <?php endforeach; ?>
                  </select>
              </div>
      
                <input type="hidden" name="selected_service_name" id="selected_service_name" value="">
                <input type="hidden" name="selected_service_price" id="selected_service_price" value="">
                <div class="d-flex align-items-center justify-content-between mt-4">
                    <small class="mb-0">Saldo: Rp. <?php echo number_format($balance, 0, ',', '.'); ?></small>
                    <button id="buyButton" type="submit" class="btn btn-primary" onclick="buyNumber()">Beli Nomor</button>
                    
                </div>
            </form>        
          </div>
        </div>
      </div>
    
      <div class="col-12 col-lg-6">
          <?php if (!empty($orders)) : ?>
              <?php $counter = 1; foreach ($orders as $order) : ?>
                  <?php
                  if (!function_exists('formatCountdown')) {
                      function formatCountdown($seconds)
                      {
                          $minutes = floor($seconds / 60);
                          $seconds = $seconds % 60;
      
                          return sprintf('%02d:%02d', $minutes, $seconds);
                      }
                  }
                  ?>
                  <div class="card border-0 shadow" id="cardContainer<?= $counter ?>">
                      <div class="card-body">
                          <table class="table">
                              <tr>
                                  <th>Aplikasi</th>
                                  <td><?= $order['service_name'] ?></td>
                              </tr>
                              <tr>
                                  <th>Nomor</th>
                                  <td id="orderNumber<?= $counter ?>" class="d-flex text-nowrap">
                                      <?= $order['number'] ?>
                                      <div type="button" onclick="copyData('orderNumber<?= $counter ?>')" class="ms-2"><i class="bi bi-copy"></i></div>
                                  </td>
                              </tr>
                              <tr>
                                  <th>Sms</th>
                                  <td id="smsNumber<?= $counter ?>" class="d-flex align-items-center">
                                    <?php if ($order['sms'] === 'waiting' || $order['sms'] === 'resending') : ?>
                          <div class="loader loader--style8" title="7">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                               width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                              <rect x="0" y="10" width="4" height="10" fill="#333" opacity="0.2">
                                <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0s" dur="0.6s" repeatCount="indefinite" />
                                <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0s" dur="0.6s" repeatCount="indefinite" />
                                <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.6s" repeatCount="indefinite" />
                              </rect>
                              <rect x="8" y="10" width="4" height="10" fill="#333"  opacity="0.2">
                                <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                                <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                                <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                              </rect>
                              <rect x="16" y="10" width="4" height="10" fill="#333"  opacity="0.2">
                                <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                                <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                                <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                              </rect>
                            </svg>
                          </div>
                                    <?php else : ?>
                                    <textarea class="form-control" placeholder="<?= $order['sms'] ?>" disabled></textarea>
                                      <?php endif; ?>
                                  </td>
                              </tr>
                              <tr>
                                  <th>Waktu</th>
                                  <td id="countdown<?= $counter ?>">
                                      <?php
                                      $countdownValue = $order['countdown'];
                                      ?>
                                  </td>
                              </tr>
                          </table>
                            <div class="d-flex float-end" id="buttonContainer<?= $counter ?>">
                              <?php if ($order['status'] === '2' || $order['status'] === '3' || $order['status'] === '4' || $order['status'] === '5' || $order['sms'] === 'resending') : ?>
                                  <?php if ($countdownValue > 0) : ?>
                                      <a id="doneButton<?= $counter ?>" href="<?= site_url("orders/doneOrder/{$order['order_id']}") ?>" class="btn btn-success btn-sm mx-1">Done</a>
                                      <a id="retryButton<?= $counter ?>" href="<?= site_url("orders/retryOrder/{$order['order_id']}") ?>" class="btn btn-secondary btn-sm mx-1">Resend OTP</a>
                                  <?php endif; ?>
                              <?php elseif ($order['sms'] === 'waiting') : ?>
                                  <?php if ($countdownValue > 0) : ?>
                                      <a id="cancelButton<?= $counter ?>" href="<?= site_url("orders/changeStatusCancel/{$order['order_id']}") ?>" class="btn btn-danger btn-sm mx-1">Batal</a>
                                  <?php endif; ?>
                              <?php endif; ?>
                          </div>
                      </div>
                  </div>
                  <?php $counter++; endforeach; ?>
          <?php endif; ?>
      </div>
      
      <div class="col-12 col-lg-6">
        <div class="card border-0 shadow">
          <div class="card-body">
            <ul class="nav nav-pills d-flex justify-content-center mb-3" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link tab active" id="pills-panduan-tab" data-bs-toggle="pill" data-bs-target="#pills-panduan" type="button" role="tab" aria-controls="pills-panduan" aria-selected="true">Panduan</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link tab" id="pills-faq-tab" data-bs-toggle="pill" data-bs-target="#pills-faq" type="button" role="tab" aria-controls="pills-faq" aria-selected="false">FAQ</button>
              </li>
            </ul>
            <hr>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-panduan" role="tabpanel" aria-labelledby="pills-panduan-tab" tabindex="0">
                <ol>
                  <li>Pilih <b>Layanan Aplikasi</b> yang ingin digunakan.</li>
                  <li>Selanjutnya pastikan bahwa <b>Saldo</b> saat ini cukup.</li>
                  <li>Apabila sudah merasa benar, silahkan klik tombol <b>Beli Nomor</b>.</li>
                  <li>Tunggu beberapa saat dan nomor akan muncul.</li>
                </ol>
              </div>
              <div class="tab-pane fade" id="pills-faq" role="tabpanel" aria-labelledby="pills-faq-tab" tabindex="0">
                <ol>
                  <li>Nomor yang dibeli hanya berlaku / aktif selama <b>20 menit.</b></li>
                  <li>Apabila membutuhkan 2 SMS atau lebih, kamu bisa mengirim otp terbaru dari aplikasi lalu menekan tombol <b>Resend</b> untuk mendapatkan SMS terbaru.</li>
                  <li>Jika SMS tidak masuk atau lama, kamu bisa menekan tombol <b>Batal.</b></li>
                  <li>Saldo akan <b>Dikembalikan</b> apabila nomor telah dibatalkan.</li>
                  <li>Apabila nomor tidak digunakan dalam waktu <b>20 menit</b> akan secara otomatis menyelesaikan pesanan.</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    
<script>
$(document).ready(function() {
    $('.form-select').select2({
      theme: "bootstrap-5"
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('service').selectedIndex = 0;
    updateSelectedService();
});

function updateSelectedService() {
    var selectedOption = document.getElementById('service').options[document.getElementById('service').selectedIndex];
    var serviceName = selectedOption.getAttribute('data-name');
    var servicePrice = selectedOption.getAttribute('data-price');

    document.getElementById('selected_service_name').value = serviceName;
    document.getElementById('selected_service_price').value = servicePrice;
}

        
function copyData(elementId) {
    var index = elementId.replace('orderNumber', '');
    
    var smsElementId = 'smsNumber' + index;

    var orderNumber = document.getElementById(elementId).textContent.trim();
    var smsNumber = document.getElementById(smsElementId).textContent.trim();

    var textToCopy = orderNumber;

    var tempInput = document.createElement("textarea");
    tempInput.value = textToCopy;
    document.body.appendChild(tempInput);

    tempInput.select();
    tempInput.setSelectionRange(0, 99999);
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    Swal.fire({
        position: "center",
        icon: "success",
        text: "Nomor berhasil disalin " + textToCopy,
        showConfirmButton: false,
        timer: 1500
    });
}

<?php if(session()->getFlashdata('message')): ?>
    Swal.fire({
        position: "center",
        icon: "warning",
        text: "<?php echo session()->getFlashdata('message') ?>",
        showConfirmButton: false,
        timer: 2500
    });
<?php elseif(session()->getFlashdata('success')): ?>
    Swal.fire({
        position: "center",
        icon: "success",
        text: "<?php echo session()->getFlashdata('success') ?>",
        showConfirmButton: false,
        timer: 1500
    });
<?php elseif(session()->getFlashdata('error')): ?>
    Swal.fire({
        position: "center",
        icon: "error",
        text: "<?php echo session()->getFlashdata('error') ?>",
        showConfirmButton: false,
        timer: 1500
    });
<?php endif; ?>
    
document.addEventListener('DOMContentLoaded', function() {
    <?php for ($i = 1; $i <= count($orders); $i++) : ?>
        var countdownValue<?= $i ?> = <?= $orders[$i - 1]['countdown'] ?>;
        var initialTimestamp<?= $i ?> = Math.floor(Date.now() / 1000); // Timestamp saat halaman dimuat
        var retryButton<?= $i ?> = document.getElementById('retryButton<?= $i ?>');
        var doneButton<?= $i ?> = document.getElementById('doneButton<?= $i ?>');
        var cancelButton<?= $i ?> = document.getElementById('cancelButton<?= $i ?>');

        if (countdownValue<?= $i ?> <= 0) {
            var cardContainer<?= $i ?> = document.getElementById('cardContainer<?= $i ?>');
            cardContainer<?= $i ?>.style.display = 'none';
        } else {
            startCountdown(countdownValue<?= $i ?>, 'countdown<?= $i ?>', retryButton<?= $i ?>, doneButton<?= $i ?>, cancelButton<?= $i ?>, initialTimestamp<?= $i ?>);
        }
    <?php endfor; ?>

    function startCountdown(countdownValue, elementId, retryButton, doneButton, cancelButton, initialTimestamp) {
        var x = setInterval(function() {
            var currentTime = Math.floor(Date.now() / 1000);
            var elapsedSeconds = currentTime - initialTimestamp;

            var adjustedCountdown = countdownValue - elapsedSeconds;
            var minutes = Math.floor(adjustedCountdown / 60);
            var seconds = adjustedCountdown % 60;

            document.getElementById(elementId).innerHTML = minutes + ":" + seconds;

            if (adjustedCountdown < 0) {
                clearInterval(x);
                document.getElementById(elementId).innerHTML = "Kadaluarsa";

                if (retryButton) {
                    retryButton.style.display = 'none';
                }

                if (doneButton) {
                    doneButton.style.display = 'none';
                }

                if (cancelButton) {
                    cancelButton.style.display = 'none';
                }

                var cardContainer = document.getElementById(elementId.replace('countdown', 'cardContainer'));
                cardContainer.style.display = 'none';
            }
        }, 1000);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    function fetchDataAndUpdate() {
        $.ajax({
            url: '<?= base_url('sistem/update-status') ?>',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                updateView(response);
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function updateView(data) {
        for (var i = 0; i < data.length; i++) {
            var orderUpdate = data[i];
            var counter = i + 1;

            if (orderUpdate.success) {
                $('#status' + counter).text(orderUpdate.updated_data.status);
                $('#smsNumber' + counter).text(orderUpdate.updated_data.sms);

                if (orderUpdate.reloadPage) {
                    location.reload();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        text: "SMS berhasil didapatkan",
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
                
            } else {
                console.error('Error updating order:', orderUpdate.message);
            }
        }
    }

    setInterval(fetchDataAndUpdate, 6000);
});
</script>

<?php $this->endSection(); ?>