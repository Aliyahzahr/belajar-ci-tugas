<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php echo form_open('keranjang/edit') ?>

<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Foto</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $diskon = session()->get('diskon') ?? 0;
        $totalSetelahDiskon = 0;
        $i = 1;

        if (!empty($items)) :
            foreach ($items as $index => $item) :
                $hargaSetelahDiskon = max(0, $item['price'] - $diskon);
                $subtotal = $hargaSetelahDiskon * $item['qty'];
                $totalSetelahDiskon += $subtotal;
        ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><img src="<?= base_url("img/" . $item['options']['foto']) ?>" width="100px"></td>
                    <td><?= number_to_currency($hargaSetelahDiskon, 'IDR') ?></td>
                    <td>
                        <input type="number" min="1" name="qty<?= $i++ ?>" class="form-control" value="<?= $item['qty'] ?>">
                    </td>
                    <td><?= number_to_currency($subtotal, 'IDR') ?></td>
                    <td>
                        <a href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
        <?php
            endforeach;
        endif;
        ?>
    </tbody>
</table>
<!-- End Table with stripped rows -->

<div class="alert alert-info">
    <?= "Total = " . number_to_currency($totalSetelahDiskon, 'IDR') ?>
</div>

<button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
<a class="btn btn-warning" href="<?= base_url('keranjang/clear') ?>">Kosongkan Keranjang</a>
<?php if (!empty($items)) : ?>
    <a class="btn btn-success" href="<?= base_url('checkout') ?>">Selesai Belanja</a>
<?php endif; ?>

<?php echo form_close() ?>

<?= $this->endSection() ?>
