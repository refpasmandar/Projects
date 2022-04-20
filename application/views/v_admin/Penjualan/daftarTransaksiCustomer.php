<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-shopping-cart"></i> Daftar Transaksi Penjualan</p>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold text-primary">Nama Pelanggan</h6>
                </div>
                <div class="card-body">
                    <?php $hal_ = $this->uri->segment(1); ?>
                    <?php $hal = $this->uri->segment(2); ?>
                    <?php $subhal = $this->uri->segment(3); ?>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link <?= ($subhal == 'daftarPenjualan') ? 'active' : ''; ?>" href="<?= base_url('Penjualan/Penjualan/daftarPenjualan') ?>">SELURUH PENJUALAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($subhal == 'daftarCustomerLunas') ? 'active' : ''; ?>" href="<?= base_url('Penjualan/Penjualan/daftarCustomerLunas') ?>">LUNAS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($subhal == 'daftarCustomerPiutang') ? 'active' : ''; ?>" href="<?= base_url('Penjualan/Penjualan/daftarCustomerPiutang') ?>">PIUTANG</a>
                        </li>
                    </ul>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="text-center bg-primary text-white">
                                <tr>
                                    <td>No</td>
                                    <td>Nama Pelanggan</td>
                                    <td>Total Piutang</td>
                                    <td>Aksi</td>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($all as $t) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td class="text-center"><?= $t->nama_customer; ?></td>
                                        <?php if ($t->total_piutang == 0) { ?>
                                            <td class="text-right"> Rp <?= substr(number_format($t->total_piutang, 0, ',', '.'), 0, 12) ?></td>
                                        <?php } else { ?>
                                            <td class="text-right"> Rp <?= substr(number_format($t->total_piutang, 0, ',', '.'), 0, 12) ?></td>
                                        <?php } ?>
                                        <td class="text-center">
                                            <a href="<?= base_url(); ?>Penjualan/Penjualan/detailPenjualan/<?= $t->id_customer; ?>" class="btn btn-info"><i class="fas fa-file-invoice-dollar"></i> Invoice</a></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>