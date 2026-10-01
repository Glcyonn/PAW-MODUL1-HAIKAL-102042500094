<?php
include 'data.php';

$total_produk = count($products);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cia Store</title>
    <!-- Memanggil file CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="logo">Cia Store</div>
        <nav>
            <a href="#" class="active">Home</a>
            <a href="#katalog">Products</a>
            <a href="#">About</a>
        </nav>
    </header>

    <section class="hero">
        <div class="subtitle">CIA STORE</div>
        <h1>Simple Tech Store.</h1>
        <p>Temukan berbagai perangkat dan aksesoris teknologi untuk kebutuhanmu.</p>
        <a href="#katalog" class="btn-hero">Lihat Produk</a>
    </section>

    <div class="container" id="katalog">
        <div class="catalog-header">
            <div>
                <div class="section-tag">OUR PRODUCTS</div>
                <h2>Katalog Produk</h2>
            </div>
            <div class="total-badge">
                Total Produk: <?= $total_produk; ?>
            </div>
        </div>

        <main class="product-grid">
            <?php 
            foreach ($products as $product): 
                $harga_normal = $product['harga'];
                $is_discount = $harga_normal >= 1000000;
                $persen_diskon = 10;

                if ($is_discount) {
                    $potongan = $harga_normal * ($persen_diskon / 100);
                    $harga_akhir = $harga_normal - $potongan;
                } else {
                    $harga_akhir = $harga_normal;
                }
            ?>
                <article class="card">
                    <div>
                        <div class="card-header-info">
                            <?= htmlspecialchars($product['kategori']); ?>
                            <?php if ($is_discount): ?>
                                <span class="discount-text">DISKON <?= $persen_diskon; ?>%</span>
                            <?php endif; ?>
                        </div>

                        <h3 class="card-title"><?= htmlspecialchars($product['nama']); ?></h3>

                        <div class="price-container">
                            <?php if ($is_discount): ?>
                                <div class="original-price">Rp<?= number_format($harga_normal, 0, ',', '.'); ?></div>
                            <?php endif; ?>
                            <div class="final-price">Rp<?= number_format($harga_akhir, 0, ',', '.'); ?></div>
                        </div>
                    </div>

                    <div>
                        <div class="stock-row">
                            <span>Stok: <?= $product['stok']; ?></span>
                            <?php if ($product['stok'] > 0): ?>
                                <span class="status-badge available">Tersedia</span>
                            <?php else: ?>
                                <span class="status-badge empty">Stok Habis</span>
                            <?php endif; ?>
                        </div>

                        <?php if ($product['stok'] > 0): ?>
                            <button class="btn-buy">Beli Sekarang</button>
                        <?php else: ?>
                            <button class="btn-buy" disabled>Beli Sekarang</button>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </main>
    </div>

    <footer>
        <p>&copy; <?= date('Y'); ?> Cia Store. All rights reserved.</p>
    </footer>

</body>
</html>