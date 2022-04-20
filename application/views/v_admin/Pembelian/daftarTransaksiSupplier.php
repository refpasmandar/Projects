<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-shopping-cart"></i> Daftar Transaksi Pembelian</p>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold">Nama Pemasok</h6>
                </div>
                <div class="card-body">
                    <?php $hal_ = $this->uri->segment(1); ?>
                    <?php $hal = $this->uri->segment(2); ?>
                    <?php $subhal = $this->uri->segment(3); ?>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link <?= ($subhal == 'daftarPembelian') ? 'active' : ''; ?>" href="<?= base_url('Pembelian/Pembelian/daftarPembelian') ?>">SELURUH PEMBELIAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($subhal == 'daftarSupplierLunas') ? 'active' : ''; ?>" href="<?= base_url('Pembelian/Pembelian/daftarSupplierLunas') ?>">LUNAS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($subhal == 'daftarSupplierHutang') ? 'active' : ''; ?>" href="<?= base_url('Pembelian/Pembelian/daftarSupplierUtang') ?>">UTANG</a>
                        </li>
                    </ul>
                    <div class="table-responsive">
                        <table id="bootstrap" class="table table-striped table-bordered">
                            <thead class="text-white bg-primary text-center">
                                <tr>
                                    <th class="align-middle" rowspan="2">No</th>
                                    <th class="align-middle" rowspan="2">Nama Pemasok</th>
                                    <th class="align-middle" rowspan="2">Total Utang</th>
                                    <th class="align-middle" rowspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($all as $t) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td class="text-center"><?= $t->nama_supplier; ?></td>
                                        <?php if ($t->total_utang == 0) { ?>
                                            <td class="text-right"> Rp <?= substr(number_format($t->total_utang, 0, ',', '.'), 0, 12) ?></td>
                                        <?php } else { ?>
                                            <td class="text-right"> Rp <?= substr(number_format($t->total_utang, 0, ',', '.'), 1, 12) ?></td>
                                        <?php } ?>
                                        <td class="text-center">
                                            <a href="<?= base_url(); ?>Pembelian/Pembelian/detailPembelian/<?= $t->id_supplier; ?>" class="btn btn-info"><i class="fas fa-file-invoice-dollar"></i> Invoice</a></a>
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