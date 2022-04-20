<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-history"></i> Riwayat Saldo Awal Akun</p>
    <hr>

    <!-- <div class="card">
        <div class="card-header">
            <p class="ket">Masukkan Rentang Periode Pembukuan</p>
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo base_url('Master_data/Coa/prosesFilter') ?>">
                <div class="form-row">
                    <div class="form-group col-lg-5">
                        <label for="tanggal1" class="text-primary">Tanggal</label>
                        <input class="form-control" name="tanggal1" type="date">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="tanggal2" class="text-primary">Tanggal</label>
                        <input class="form-control" name="tanggal2" type="date">
                    </div>
                    <div class="form-group col-lg-2">
                        <label class="text-white" for="">aa</label>
                        <button type="submit" class="form-control btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Terapkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <hr> -->
    <div class="card">
        <div class="card-header">
            <?php foreach ($periode as $per) { ?>
                <h6 class="text-primary font-weight-bold">Periode <?php echo format_indo($per->periode_saldo) ?></h6>
            <?php } ?>
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo base_url('Laporan/Riwayat_saldo/prosesFilter') ?>">
                <div class="form-row">
                    <div class="form-group col-lg-5">
                        <label for="tanggal1">Tanggal <span class="text-danger">*</span></label>
                        <input class="form-control" name="tanggal1" type="date">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="tanggal2">Tanggal <span class="text-danger">*</span></label>
                        <input class="form-control" name="tanggal2" type="date">
                    </div>
                    <div class="form-group col-lg-2">
                        <label class="text-white" for="">aa</label>
                        <button type="submit" class="form-control btn btn-sm btn-primary"> <i class="fas fa-search"></i> Tampilkan</button>
                    </div>
                </div>
            </form>
            <hr class="mb-4">
            <div class="table-wrapper mb-4">
                <table class="table table-striped table-hover sal_awal">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <td class="coa_head">Nama Akun</td>
                            <td class="coa_head">Kategori Akun</td>
                            <td class="coa_head">Saldo</td>
                        </tr>
                    </thead>
                    <tbody class="coa_body">
                        <?php
                        $no = 1;
                        foreach ($saldo as $sal) { ?>
                            <tr class="">
                                <!-- Menentukan Identasi -->
                                <?php if ($sal->level == 1) { ?>
                                    <td class="level_1 font-weight-bolder"><?php echo $sal->kode_akun . '-' . $sal->no_akun ?><span class="nama_akun"><?php echo $sal->nama_akun ?></span></td>
                                <?php } elseif ($sal->level == 2) { ?>
                                    <td class="level_2 font-weight-bolder"><?php echo $sal->kode_akun . '-' . $sal->no_akun ?><span class="nama_akun"><?php echo $sal->nama_akun ?></span></td>
                                <?php } elseif ($sal->level == 3) { ?>
                                    <td class="level_3 font-weight-bolder"><?php echo $sal->kode_akun . '-' . $sal->no_akun ?><span class="nama_akun"><?php echo $sal->nama_akun ?></span></td>
                                <?php } else { ?>
                                    <td class="level_4"><?php echo $sal->kode_akun . '-' . $sal->no_akun ?><span class="nama_akun"><?php echo $sal->nama_akun ?></span></td>
                                <?php } ?>
                                <!-- Kategori Akun -->
                                <?php if ($sal->kategori_akun == 1) { ?>
                                    <td class="text-center">Asset</td>
                                <?php } elseif ($sal->kategori_akun == 2) { ?>
                                    <td class="text-center">Kewajiban</td>
                                <?php } elseif ($sal->kategori_akun == 3) { ?>
                                    <td class="text-center">Ekuitas</td>
                                <?php } elseif ($sal->kategori_akun == 4) { ?>
                                    <td class="text-center">Pendapatan</td>
                                <?php } elseif ($sal->kategori_akun == 5) { ?>
                                    <td class="text-center">Harga Pokok Penjualan</td>
                                <?php } elseif ($sal->kategori_akun == 6) { ?>
                                    <td class="text-center">Pengeluaran</td>
                                <?php } elseif ($sal->kategori_akun == 8) { ?>
                                    <td class="text-center">Pemasukan Lain-Lain</td>
                                <?php } elseif ($sal->kategori_akun == 9) { ?>
                                    <td class="text-center">Pengeluaran Lain-Lain</td>
                                <?php } elseif ($sal->kategori_akun == 10) { ?>
                                    <td class="text-center">Bank</td>
                                <?php } elseif ($sal->kategori_akun == 11) { ?>
                                    <td class="text-center">Piutang</td>
                                <?php } elseif ($sal->kategori_akun == 12) { ?>
                                    <td class="text-center">Utang</td>
                                <?php } elseif ($sal->kategori_akun == 13) { ?>
                                    <td class="text-center">Asset Lain</td>
                                <?php } elseif ($sal->kategori_akun == 14) { ?>
                                    <td class="text-center">Kewajiban Lain</td>
                                <?php } ?>
                                <!-- Saldo -->
                                <!-- <?php if ($sal->saldo_awal < 0) { ?>
                                            <td class="text-right">(Rp <?php echo number_format($sal->saldo_awal, 0, ',', '.') ?>)</td>
                                        <?php } else { ?>
                                            <td class="text-right">Rp <?php echo number_format($sal->saldo_awal, 0, ',', '.') ?></td>
                                        <?php } ?> -->
                                <?php if ($sal->level != 4 && $sal->saldo_awal >= 0) { ?>
                                    <td class="text-right font-weight-bold">Rp <?php echo number_format($sal->saldo_awal, 0, ',', '.') ?></td>
                                <?php } elseif ($sal->level != 4 && $sal->saldo_awal < 0) { ?>
                                    <td class="text-right font-weight-bold">(Rp <?php echo substr(number_format($sal->saldo_awal, 0, ',', '.'), 1) ?>)</td>
                                <?php } elseif ($sal->level = 4 && $sal->saldo_awal > 0) { ?>
                                    <td class="text-right">Rp <?php echo number_format($sal->saldo_awal, 0, ',', '.') ?></td>
                                <?php } else { ?>
                                    <?php if ($sal->saldo_awal < 0) { ?>
                                        <td class="text-right">(Rp <?php echo substr(number_format($sal->saldo_awal, 0, ',', '.'), 1) ?>)</td>
                                    <?php } else { ?>
                                        <td class="text-right">Rp <?php echo substr(number_format($sal->saldo_awal, 0, ',', '.'), 0) ?></td>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>