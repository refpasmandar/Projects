<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-money-bill-wave"></i> Saldo Awal</p>
    <hr>

    <?php $this->view('flashdata') ?>
    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Saldo Awal
                <span class="text-dark"><br>
                    <?php foreach ($periode as $per) { ?>
                        <?php echo format_indo($per->periode_saldo) ?>
                    <?php } ?>
                </span>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-wrapper table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <td class="$sal_head">Nama Akun</td>
                            <td class="$sal_head">Kategori Akun</td>
                            <td class="$sal_head">Saldo</td>
                        </tr>
                    </thead>
                    <tbody class="$sal_body">
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