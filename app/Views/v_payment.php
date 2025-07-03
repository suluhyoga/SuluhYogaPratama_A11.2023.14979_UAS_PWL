<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="hero2">
    <div class="content2">
        <p class="content-top">PEMBAYARAN PESANAN</p>

        <div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh; margin-bottom: -120px;">
            <div class="card p-5 shadow-lg border-0 rounded-lg bg-white" style="max-width: 700px; width: 100%;">
                <div class="card-body text-center">
                    <h3 class="card-title mb-4 text-primary fw-bold">Menunggu Pembayaran</h3>
                    <p class="card-text fs-5 mb-3">Pesanan Anda dengan ID:</p>
                    <h4 class="fw-bold text-success mb-4">#<?= $transaction['id'] ?></h4>
                    <p class="card-text fs-5 mb-2">Total yang harus dibayar:</p>
                    <h2 class="fw-bold text-danger mb-4"><?= number_to_currency($transaction['total_harga'], 'IDR') ?></h2>
                    <p class="card-text mb-4 text-muted">Silakan klik tombol di bawah untuk melanjutkan pembayaran melalui Midtrans.</p>

                    <button id="pay-button" class="btn btn-primary btn-lg w-75 py-3 rounded-pill shadow-sm animate__animated animate__pulse animate__infinite">
                        <i class="fas fa-wallet me-2"></i> Bayar Sekarang
                    </button>
                    <div id="loading-spinner" class="mt-3 d-none">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-muted mt-2">Mengarahkan ke halaman pembayaran...</p>
                    </div>
                    <p class="mt-4 text-sm text-muted">Anda akan diarahkan ke halaman pembayaran Midtrans.</p>
                </div>
            </div>
        </div>

    </div><br><br><br><br><br><br>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type="text/javascript">
    // Ambil snap token dari data yang dikirimkan oleh controller
    var snapToken = '<?= $snap_token ?>';
    var payButton = document.getElementById('pay-button');
    var loadingSpinner = document.getElementById('loading-spinner');

    // Ketika tombol "Bayar Sekarang" diklik
    payButton.onclick = function() {
        // Tampilkan spinner dan nonaktifkan tombol
        payButton.classList.add('d-none');
        loadingSpinner.classList.remove('d-none');

        if (snapToken) {
            snap.pay(snapToken, {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    console.log(result);
                    window.location.href = '<?= base_url('profile') ?>';
                },
                onPending: function(result) {
                    alert("Pembayaran tertunda! Silakan selesaikan pembayaran sesuai instruksi.");
                    console.log(result);
                    window.location.href = '<?= base_url('profile') ?>';
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                    console.log(result);
                    window.location.href = '<?= base_url('profile') ?>';
                },
                onClose: function() {
                    alert('Anda menutup pop-up tanpa menyelesaikan pembayaran. Status pesanan Anda adalah Pending.');
                    window.location.href = '<?= base_url('profile') ?>';
                }
            });
        } else {
            alert('Snap token tidak ditemukan. Silakan coba lagi dari halaman profile.');
            window.location.href = '<?= base_url('profile') ?>';
        }
    };
</script>
<?= $this->endSection() ?>