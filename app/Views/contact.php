<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<body>

    <div class="hero2">

        <div class="content2">
            <p class="content-top">KONTAK KAMI</p>

            <div class="box-form">
                <div class="imgcontainer">
                    <img src="<?= base_url('assets/img/logo/logo.png'); ?>" class="avatar">
                </div>

                <div class="social-media">
                    <a href="https://www.facebook.com" target="blank"><i class="fab fa-facebook"></i> Facebook</a>
                    <a href="https://www.instagram.com" target="blank"><i class="fab fa-instagram"></i> Instagram</a>
                    <a href="https://wa.me/6283826261034" target="blank"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>

                <div class="container">
                    <form action="<?= base_url('kontak/submit'); ?>" method="post">
                        <label><b>Nama</b></label>
                        <input type="text" placeholder="Masukkan Nama" id="xnama" name="nm">
                        <label><b>Alamat</b></label>
                        <input type="text" placeholder="Masukkan Alamat" id="xalamat" name="almt">
                        <label><b>E-mail</b></label>
                        <input type="email" placeholder="Masukkan Email" id="xemail" name="eml">
                        <label><b>Pesan</b></label>
                        <textarea placeholder="Masukkan Pesan" id="xpesan" name="psn"></textarea>
                        <button type="submit" class="btn-kirim" name="submit" value="Submit">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/script.js'); ?>"></script>

</body>

</html>
<?= $this->endSection() ?>