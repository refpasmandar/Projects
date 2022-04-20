<div class="container-fluid">
    <p class="title_halaman"><i class="fas fa-book"></i> Jurnal Umum</p>
    <hr>
    <div class='col-lg-12 text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Laporan/Jurnal/jurnal') ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>
    <?php $this->view('flashdata') ?>
    <div class="card">
        <div class="card-header">
            <p>Jurnal <br>
                <?php echo format_indo(date('Y-m-d', strtotime($tanggal1))) ?> - <?php echo format_indo(date('Y-m-d', strtotime($tanggal2))) ?></p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover tb_laporan mb-5">
                    <thead class="text-center text-white bg-primary">
                        <tr class="table-bordered">
                            <th class="align-middle" rowspan="2">No</th>
                            <th class="align-middle" rowspan="2">Kode Transaksi</th>
                            <th class="align-middle" rowspan="2">Tanggal Transaksi</th>
                            <th class="align-middle" rowspan="2">Nomor Akun</th>
                            <th class="align-middle" colspan="2">Nama Akun</th>
                            <th class="align-middle" rowspan="2">Debet</th>
                            <th class="align-middle" rowspan="2">Kredit</th>
                            <th class="align-middle" rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th>Debit</th>
                            <th>Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $debit = 0;
                        $kredit = 0;
                        foreach ($jurnal as $jr) { ?>
                            <tr class="text-center">
                                <?php if ($jr->saldo_jurnal != 0) { ?>
                                    <td><?php echo $no++ ?></td>
                                    <?php if ($jr->jenis_transaksi == 'Retur Pembelian') { ?>
                                        <td>
                                            <?php echo $jr->kode_jurnal ?> <br>
                                            <span class="text-danger"><small>(Retur Pembelian)</small></span>
                                        </td>
                                    <?php } else if ($jr->jenis_transaksi == 'Retur Penjualan') { ?>
                                        <td>
                                            <?php echo $jr->kode_jurnal ?> <br>
                                            <span class="text-danger"><small>(Retur Penjualan)</small></span>
                                        </td>
                                    <?php } else if ($jr->jenis_transaksi == 'Bayar Utang') { ?>
                                        <td>
                                            <?php echo $jr->kode_jurnal ?> <br>
                                            <span class="text-danger"><small>(Pembayaran Utang)</small></span>
                                        </td>
                                    <?php } else if ($jr->jenis_transaksi == 'Terima Piutang') { ?>
                                        <td>
                                            <?php echo $jr->kode_jurnal ?> <br>
                                            <span class="text-danger"><small>(Penerimaan Piutang)</small></span>
                                        </td>
                                    <?php } else { ?>
                                        <td><?php echo $jr->kode_jurnal ?></td>
                                    <?php } ?>
                                    <td><?php echo format_indo(date('Y-m-d', strtotime($jr->tanggal_transaksi))) ?></td>
                                    <td><?php echo $jr->kode_akun . '-' . $jr->no_akun ?></td>
                                    <!-- Nama Akun -->
                                    <?php if ($jr->posisi == 'Debit') { ?>
                                        <td><?php echo $jr->nama_akun ?><br>
                                        <td></td>
                                        <td class="text-right">Rp <?php echo number_format($jr->saldo_jurnal, 0, ',', '.') ?></td>
                                        <td>-</td>
                                        <?php $debit = $debit + $jr->saldo_jurnal ?>
                                    <?php } elseif ($jr->posisi == 'Kredit') { ?>
                                        <td></td>
                                        <td><?php echo $jr->nama_akun ?><br>
                                        <td>-</td>
                                        <td class="text-right">Rp <?php echo substr(number_format($jr->saldo_jurnal, 0, ',', '.'), 1, 12) ?></td>
                                        <?php $kredit = $kredit + $jr->saldo_jurnal ?>
                                    <?php } ?>
                                    <?php if ($jr->jenis_transaksi == "Jurnal") { ?>
                                        <td>
                                            <?php echo anchor('Laporan/Jurnal/editJurnal/' . $jr->kode_jurnal . '/' . $jr->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Update</div>') ?>
                                            <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Laporan/Jurnal/deleteJurnal/') . $jr->kode_jurnal ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
                                    <?php } elseif ($jr->jenis_transaksi == "Pembelian") { ?>
                                        <td>
                                            <?php echo anchor('Pembelian/Pembelian/editPembelian/' . $jr->kode_jurnal . '/' . $jr->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Update</div>') ?>
                                            <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Pembelian/Pembelian/deletePembelian/') . $jr->kode_jurnal ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
                                    <?php } elseif ($jr->jenis_transaksi == "Penjualan") { ?>
                                        <td>
                                            <?php echo anchor('Penjualan/Penjualan/editPenjualan/' . $jr->kode_jurnal . '/' . $jr->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Update</div>') ?>
                                            <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Penjualan/Penjualan/deletePenjualan/') . $jr->kode_jurnal ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
                                    <?php } elseif ($jr->jenis_transaksi == "Retur Pembelian") { ?>
                                        <td>
                                            <?php echo anchor('Pembelian/Pembelian/editReturPembelian/' . $jr->kode_jurnal . '/' . $jr->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Update</div>') ?>
                                            <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Pembelian/Pembelian/deleteReturPembelian/') . $jr->kode_jurnal ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
                                    <?php } elseif ($jr->jenis_transaksi == "Retur Penjualan") { ?>
                                        <td>
                                            <?php echo anchor('Penjualan/Penjualan/editReturPenjualan/' . $jr->kode_jurnal . '/' . $jr->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Update</div>') ?>
                                            <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Penjualan/Penjualan/deleteReturPenjualan/') . $jr->kode_jurnal ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
                                    <?php } elseif ($jr->jenis_transaksi == "Bayar Utang") { ?>
                                        <td>
                                            <?php echo anchor('Pembelian/Pembelian/editBayarUtang/' . $jr->kode_jurnal . '/' . $jr->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Update</div>') ?>
                                            <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Pembelian/Pembelian/deleteBayarUtang/') . $jr->kode_jurnal ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
                                    <?php } elseif ($jr->jenis_transaksi == "Terima Piutang") { ?>
                                        <td>
                                            <?php echo anchor('Pembelian/Pembelian/editTerimaPiutang/' . $jr->kode_jurnal . '/' . $jr->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Update</div>') ?>
                                            <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Pembelian/Pembelian/deleteTerimaPiutang/') . $jr->kode_jurnal ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                    <tfoot>
                        <tr class="bg-light">
                            <th class="table-bordered text-center" colspan="6">Total</th>
                            <th class="text-right">Rp <?php echo number_format($debit, 0, ',', '.') ?>
                            <th class="text-right">Rp <?php echo substr(number_format($kredit, 0, ',', '.'), 1, 12) ?>
                            <th></th>
                        </tr>
                        <tr class="bg-light">
                            <?php if ($debit == substr($kredit, 1, 12)) { ?>
                                <th class="text-center bg-success text-white" colspan="9">SEIMBANG</th>
                            <?php } else { ?>
                                <th class="text-center bg-danger text-white" colspan="9">TIDAK SEIMBANG</th>
                            <?php } ?>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>