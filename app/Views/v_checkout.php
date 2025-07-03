<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="hero2">
    <div class="content2">
        <p class="content-top">KERANJANG BELANJA</p>

        <div class="row">
            <div class="col-lg-6">
                <!-- Vertical Form -->
                <?= form_open('buy', 'class="row g-3"') ?>
                <?= form_hidden('username', session()->get('username')) ?>
                <?= form_input(['type' => 'hidden', 'name' => 'total_harga', 'id' => 'total_harga', 'value' => '']) ?>
                <div class="col-12">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" value="<?php echo session()->get('username'); ?>" readonly>
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
                <div class="col-12">
                    <label for="kelurahan" class="form-label">Kelurahan</label>
                    <select class="form-control" id="kelurahan" name="kelurahan" required></select>
                </div>
                <div class="col-12">
                    <label for="layanan" class="form-label">Layanan</label>
                    <select class="form-control" id="layanan" name="layanan" required>
                        <option value="" selected disabled>-- Pilih Layanan --</option>
                        <!-- Opsi placeholder awal -->
                    </select>
                </div>
                <div class="col-12">
                    <label for="ongkir" class="form-label">Ongkir</label>
                    <input type="text" class="form-control" id="ongkir" name="ongkir" readonly>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Vertical Form -->
                <div class="col-12">
                    <!-- Default Table -->
                    <table class="table-checkout">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if (!empty($items)) :
                                foreach ($items as $index => $item) :
                            ?>
                                    <tr>
                                        <td><?php echo $item['name'] ?></td>
                                        <td><?php echo number_to_currency($item['price'], 'IDR') ?></td>
                                        <td><?php echo $item['qty'] ?></td>
                                        <td><?php echo number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
                                    </tr>
                            <?php
                                endforeach;
                            endif;
                            ?>
                            <tr>
                                <td colspan="2"></td>
                                <td>Subtotal</td>
                                <td><?php echo number_to_currency($total, 'IDR') ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>Ongkir</td>
                                <td><span id="display-ongkir">Rp 0</span></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>Total</td>
                                <td><span id="total"><?php echo number_to_currency($total, 'IDR') ?></span></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
                <div class="text-center">
                    <button style="border-radius: 100px; padding:8px; padding-right:20px; padding-left:20px;" type="submit" class="btn btn-primary">Buat Pesanan</button>
                    <button class="button-product-detail"><a href="<?= base_url('keranjang'); ?>">Kembali</a></button>
                </div>
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </div><br><br><br><br><br><br>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        var ongkir = 0;
        var total = 0;
        hitungTotal();

        $('#kelurahan').select2({
            placeholder: 'Ketik nama kelurahan...',
            ajax: {
                url: '<?= base_url('get-location') ?>',
                dataType: 'json',
                delay: 1500,
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.subdistrict_name + ", " + item.district_name + ", " + item.city_name + ", " + item.province_name + ", " + item.zip_code
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 3
        });

        $("#kelurahan").on('change', function() {
            var id_kelurahan = $(this).val();
            $("#layanan").empty();
            // Tambahkan opsi placeholder "Pilih Layanan"
            $("#layanan").append($('<option>', {
                value: '',
                text: '-- Pilih Layanan --',
                selected: true,
                disabled: true
            }));

            ongkir = 0;
            $("#ongkir").val(ongkir);
            $("#display-ongkir").html("IDR " + ongkir.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
            hitungTotal();

            $.ajax({
                url: "<?= site_url('get-cost') ?>",
                type: 'GET',
                data: {
                    'destination': id_kelurahan,
                },
                dataType: 'json',
                success: function(data) {
                    data.forEach(function(item) {
                        var text = item["description"] + " (" + item["service"] + ") : estimasi " + item["etd"] + "";
                        $("#layanan").append($('<option>', {
                            value: item["cost"],
                            text: text
                        }));
                    });
                },
            });
        });

        $("#layanan").on('change', function() {
            // Hanya update ongkir jika nilai yang dipilih bukan placeholder kosong
            if ($(this).val() !== '') {
                ongkir = parseInt($(this).val());
            } else {
                ongkir = 0;
            }
            $("#ongkir").val(ongkir);
            $("#display-ongkir").html("IDR " + ongkir.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
            hitungTotal();
        });

        function hitungTotal() {
            total = ongkir + <?= $total ?>;

            $("#total").html("IDR " + total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
            $("#total_harga").val(total);
        }
    });
</script>
<?= $this->endSection() ?>