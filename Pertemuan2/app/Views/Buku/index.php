<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/Buku/create" class="btn btn-primary mt-3">Tambah Data Buku</a>
            <h1 class="mt-2"> Daftar Buku </h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-succes" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($Buku as $B) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $B['sampul']; ?>" alt="" class="sampul"></td>
                            <td> <?= $B['judul']; ?> </td>
                            <td>
                                <a href="/Buku/<?= $B['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>

        </div>
    </div>
</div>
<?php endforeach; ?>
</tbody>
</table>
<?= $this->endSection(); ?>