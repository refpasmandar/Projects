<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="far fa-list-alt"></i> Chart Of Account</p>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo base_url('Master_data/Coa/tambahAkun') ?>" class="btn btn-primary mb-4"> <i class="fa fa-plus"></i> Tambah Akun</a>
            <?php $this->view('flashdata') ?>
            <!-- <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="#profile" role="tab" data-toggle="tab">Semua Akun</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#profile" role="tab" data-toggle="tab">Asset</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Kewajiban</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#references" role="tab" data-toggle="tab">Ekuitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#references" role="tab" data-toggle="tab">Pemasukan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#references" role="tab" data-toggle="tab">Harga Pokok Penjualan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#references" role="tab" data-toggle="tab">Pengeluaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#references" role="tab" data-toggle="tab">Pemasukan Lain - Lain</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#references" role="tab" data-toggle="tab">Pengeluaran Lain - Lain</a>
                </li>
            </ul> -->
            <div class="table-wrapper table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <td class="coa_head">Nama Akun</td>
                            <td class="coa_head">Kategori Akun</td>
                            <td class="coa_head">Saldo</td>
                            <td class="coa_head">Aksi</td>
                        </tr>
                    </thead>
                    <tbody class="coa_body">
                        <?php
                        $no = 1;
                        foreach ($coa as $coa) { ?>
                            <tr class="">
                                <!-- Menentukan Identasi -->
                                <?php if ($coa->level == 1) { ?>
                                    <td class="level_1 font-weight-bolder"><?php echo $coa->kode_akun . '-' . $coa->no_akun ?><span class="nama_akun"><?php echo $coa->nama_akun ?></span></td>
                                <?php } elseif ($coa->level == 2) { ?>
                                    <td class="level_2 font-weight-bolder"><?php echo $coa->kode_akun . '-' . $coa->no_akun ?><span class="nama_akun"><?php echo $coa->nama_akun ?></span></td>
                                <?php } elseif ($coa->level == 3) { ?>
                                    <td class="level_3 font-weight-bolder"><?php echo $coa->kode_akun . '-' . $coa->no_akun ?><span class="nama_akun"><?php echo $coa->nama_akun ?></span></td>
                                <?php } else { ?>
                                    <td class="level_4"><?php echo $coa->kode_akun . '-' . $coa->no_akun ?><span class="nama_akun"><?php echo $coa->nama_akun ?></span></td>
                                <?php } ?>
                                <!-- Kategori Akun -->
                                <?php if ($coa->kategori_akun == 1) { ?>
                                    <td class="text-center">Asset</td>
                                <?php } elseif ($coa->kategori_akun == 2) { ?>
                                    <td class="text-center">Kewajiban</td>
                                <?php } elseif ($coa->kategori_akun == 3) { ?>
                                    <td class="text-center">Ekuitas</td>
                                <?php } elseif ($coa->kategori_akun == 4) { ?>
                                    <td class="text-center">Pendapatan</td>
                                <?php } elseif ($coa->kategori_akun == 5) { ?>
                                    <td class="text-center">Harga Pokok Penjualan</td>
                                <?php } elseif ($coa->kategori_akun == 6) { ?>
                                    <td class="text-center">Pengeluaran</td>
                                <?php } elseif ($coa->kategori_akun == 8) { ?>
                                    <td class="text-center">Pendapatan Lain-Lain</td>
                                <?php } elseif ($coa->kategori_akun == 9) { ?>
                                    <td class="text-center">Pengeluaran Lain-Lain</td>
                                <?php } elseif ($coa->kategori_akun == 10) { ?>
                                    <td class="text-center">Bank</td>
                                <?php } elseif ($coa->kategori_akun == 11) { ?>
                                    <td class="text-center">Piutang</td>
                                <?php } elseif ($coa->kategori_akun == 12) { ?>
                                    <td class="text-center">Utang</td>
                                <?php } elseif ($coa->kategori_akun == 13) { ?>
                                    <td class="text-center">Asset Lain</td>
                                <?php } elseif ($coa->kategori_akun == 14) { ?>
                                    <td class="text-center">Kewajiban Lain</td>
                                <?php } ?>
                                <!-- Saldo -->
                                <?php if ($coa->level != 4 && $coa->saldo >= 0) { ?>
                                    <td class="text-right font-weight-bold">Rp <?php echo number_format($coa->saldo, 0, ',', '.') ?></td>
                                <?php } elseif ($coa->level != 4 && $coa->saldo < 0) { ?>
                                    <td class="text-right font-weight-bold">(Rp <?php echo substr(number_format($coa->saldo, 0, ',', '.'), 1) ?>)</td>
                                <?php } elseif ($coa->level = 4 && $coa->saldo > 0) { ?>
                                    <td class="text-right">Rp <?php echo number_format($coa->saldo, 0, ',', '.') ?></td>
                                <?php } else { ?>
                                    <?php if ($coa->saldo < 0) { ?>
                                        <td class="text-right">(Rp <?php echo substr(number_format($coa->saldo, 0, ',', '.'), 1) ?>)</td>
                                    <?php } else { ?>
                                        <td class="text-right">Rp <?php echo substr(number_format($coa->saldo, 0, ',', '.'), 0) ?></td>
                                    <?php } ?>
                                <?php } ?>
                                <td class="text-center">
                                    <?php echo anchor('Master_data/Coa/editAkun/' . $coa->id_akun, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                    <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Coa/deleteAkun/') . $coa->id_akun ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>