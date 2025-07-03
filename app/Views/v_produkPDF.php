<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Produk</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            margin: 0;
            padding: 10px;
        }
        .header { 
            text-align: center; 
            margin-bottom: 20px; 
        }
        .header img { 
            width: 60px; 
            height: auto; 
            display: block;
            margin: 0 auto;
        }
        h2 { 
            margin: 5px 0; 
            font-size: 16px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        th, td { 
            border: 1px solid #000; 
            padding: 6px; 
            text-align: center; 
            vertical-align: middle;
        }
        th { 
            background-color: #f0f0f0; 
            font-weight: bold;
        }
        .img-produk { 
            width: 50px; 
            height: 50px; 
            object-fit: cover;
            display: block;
            margin: 0 auto;
        }
        .no-image {
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>

<div class="header">
    <?php
    $logoPath = FCPATH . 'assets/img/logo/logo.png';
    if (file_exists($logoPath)) {
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoSrc = 'data:image/png;base64,' . $logoData;
    } else {
        $logoSrc = '';
    }
    ?>
    
    <?php if ($logoSrc): ?>
        <img src="<?= $logoSrc ?>" alt="Logo">
    <?php endif; ?>
    
    <h2>Laporan Data Produk</h2>
    <p>Dicetak: <?= date('d-m-Y H:i:s') ?></p>
</div>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="20%">Nama</th>
            <th width="15%">Harga</th>
            <th width="10%">Satuan</th>
            <th width="15%">Kategori</th>
            <th width="10%">Jumlah</th>
            <th width="25%">Foto</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($product as $p): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td style="text-align: left;"><?= htmlspecialchars($p['nama']) ?></td>
            <td style="text-align: right;">Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($p['satuan']) ?></td>
            <td><?= htmlspecialchars($p['kategori_id']) ?></td>
            <td><?= number_format($p['jumlah']) ?></td>
            <td>
                <?php if (!empty($p['foto'])): ?>
                    <?php
                    $imagePath = FCPATH . 'assets/img/product/' . $p['foto'];
                    if (file_exists($imagePath)) {
                        // Deteksi tipe file
                        $imageInfo = getimagesize($imagePath);
                        $mimeType = $imageInfo['mime'];
                        
                        // Encode gambar ke base64
                        $imageData = base64_encode(file_get_contents($imagePath));
                        $imageSrc = 'data:' . $mimeType . ';base64,' . $imageData;
                    } else {
                        $imageSrc = '';
                    }
                    ?>
                    
                    <?php if ($imageSrc): ?>
                        <img class="img-produk" src="<?= $imageSrc ?>" alt="<?= htmlspecialchars($p['nama']) ?>">
                    <?php else: ?>
                        <span class="no-image">File tidak ditemukan</span>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="no-image">Tidak Ada Foto</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div style="margin-top: 20px; text-align: right; font-size: 10px; color: #666;">
    Total Produk: <?= count($product) ?> item
</div>

</body>
</html>