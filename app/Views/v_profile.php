<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h2>History Transaksi Pembelian <strong><?= esc($username) ?></strong></h2>
<hr>

<div class="table-responsive">
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>ID Pembelian</th>
                <th>Waktu Pembelian</th>
                <th>Total Bayar</th>
                <th>Alamat</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($buy)) : ?>
                <?php foreach ($buy as $index => $item) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= esc($item['id']) ?></td>
                        <td><?= esc($item['created_at']) ?></td>
                        <td><?= number_to_currency($item['total_harga'], 'IDR') ?></td>
                        <td><?= esc($item['alamat']) ?></td>
                        <td><?= $item['status'] == "1" ? "Sudah Selesai" : "Belum Selesai" ?></td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal-<?= esc($item['id']) ?>">
                                Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Begin -->
<div class="modal fade" id="detailModal-<?= esc($item['id']) ?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (!empty($product) && isset($product[$item['id']])) : ?>
                    <?php foreach ($product[$item['id']] as $index2 => $item2) : ?>
                        <?php
                            $foto = $item2['foto'] ?? '';
                            $fotoPath = FCPATH . 'img/' . $foto;
                            $harga = $item2['harga'];
                            $jumlah = $item2['jumlah'];
                            $diskon = $item2['diskon'] ?? 0;
                            $subtotal = ($harga - $diskon) * $jumlah;
                        ?>
                        <div class="row align-items-center mb-3 p-3 border rounded">
                            <!-- Nomor urut -->
                            <div class="col-1">
                                <span class="fw-bold"><?= ($index2 + 1) ?>)</span>
                            </div>
                            
                            <!-- Gambar Produk -->
                            <div class="col-3">
                                <?php if (!empty($foto) && file_exists($fotoPath)) : ?>
                                    <img src="<?= base_url('img/' . esc($foto)) ?>" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="max-height: 80px; object-fit: cover;" 
                                         alt="<?= esc($item2['nama']) ?>">
                                <?php else : ?>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="height: 80px; min-width: 80px;">
                                        <small class="text-muted">No Image</small>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Informasi Produk -->
                            <div class="col-5">
                                <h6 class="mb-1 fw-bold"><?= esc($item2['nama']) ?></h6>
                                <div class="text-muted small mb-1">
                                    Harga: <span class="text-primary">IDR <?= number_format($harga) ?></span>
                                </div>
                                <?php if ($diskon > 0) : ?>
                                    <div class="text-muted small mb-1">
                                        Diskon: <span class="text-danger">IDR <?= number_format($diskon) ?></span>
                                    </div>
                                <?php endif; ?>
                                <div class="text-muted small">
                                    (<?= esc($jumlah) ?> pcs)
                                </div>
                            </div>
                            
                            <!-- Harga Total -->
                            <div class="col-3 text-end">
                                <div class="badge bg-primary p-2 fs-6">
                                    IDR <?= number_format($subtotal) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        Tidak ada produk untuk transaksi ini.
                    </div>
                <?php endif; ?>

                <!-- Ongkir Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                            <span class="fw-bold">Ongkir:</span>
                            <span class="badge bg-secondary p-2">
                                IDR <?= number_format($item['ongkir'] ?? 0) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Total Keseluruhan -->
                <?php 
                    $totalBelanja = 0;
                    if (!empty($product) && isset($product[$item['id']])) {
                        foreach ($product[$item['id']] as $item2) {
                            $harga = $item2['harga'];
                            $jumlah = $item2['jumlah'];
                            $diskon = $item2['diskon'] ?? 0;
                            $totalBelanja += ($harga - $diskon) * $jumlah;
                        }
                    }
                    $grandTotal = $totalBelanja + ($item['ongkir'] ?? 0);
                ?>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-3 bg-success text-white rounded">
                            <span class="fw-bold fs-5">Total Keseluruhan:</span>
                            <span class="fw-bold fs-5">
                                IDR <?= number_format($grandTotal) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data transaksi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
