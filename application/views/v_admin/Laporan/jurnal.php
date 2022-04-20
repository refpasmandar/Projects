<div class="container-fluid">
    <p class="title_halaman"><i class="far fa-file-alt"></i> Jurnal Umum</p>
    <hr>
    <!-- <div class='col-lg-12 text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Laporan/Jurnal/jurnal') ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div> -->
    <?php $this->view('flashdata') ?>
    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Jurnal <br>
                <span class="text-dark"><?php echo format_indo(date('Y-m-d', strtotime($tanggal1))) ?> - <?php echo format_indo(date('Y-m-d', strtotime($tanggal2))) ?></span>
            </h6>
        </div>
        <div class="card-body">
            <form method="get" action="<?php echo base_url('Laporan/Jurnal/filterJurnal') ?>">
                <div class="form-row">
                    <div class="form-group col-lg-5">
                        <label for="tanggal1">Tanggal<span class="text-danger"> *</span></label>
                        <input class="form-control" name="tanggal1" type="date" value="<?php echo $tanggal1 ?>">
                        <!-- <?php echo form_error('tanggal1') ?> -->
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="tanggal2">Tanggal<span class="text-danger"> *</span></label>
                        <input class="form-control" name="tanggal2" type="date" value="<?php echo $tanggal2 ?>">
                        <!-- <?php echo form_error('tanggal2') ?> -->
                    </div>
                    <div class="form-group col-lg-2">
                        <label class="text-white" for="">aa</label>
                        <button type="submit" class="form-control btn btn-sm btn-primary"> <i class="fas fa-search"></i> Tampilkan</button>
                    </div>
                </div>
            </form>
            <hr class="mb-4">
            <div class="table-responsive">
                <table class="table table-striped table-border table-hover tb_laporan mb-5">
                    <thead class="text-center text-white bg-primary">
                        <tr class="table-bordered">
                            <td class="align-middle" rowspan="2">No</td>
                            <td class="align-middle" rowspan="2">Kode Transaksi</td>
                            <td class="align-middle" rowspan="2">Tanggal Transaksi</td>
                            <td class="align-middle" rowspan="2">Nomor Akun</td>
                            <td class="align-middle" colspan="2">Nama Akun</td>
                            <td class="align-middle" rowspan="2">Debit</td>
                            <td class="align-middle" rowspan="2">Kredit</td>
                            <td class="align-middle" rowspan="2">Aksi</td>
                        </tr>
                        <!-- <tr>
                            <th>Debit</th>
                            <th>Kredit</th>
                        </tr> -->
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $debit = 0;
                        $kredit = 0;
                        foreach ($header as $head) { ?>
                            <tr class="text-center">
                                <!-- Header -->
                                <td><?php echo $no++ ?></td>
                                <?php if ($head->jenis_transaksi == 'Retur Pembelian') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Retur Pembelian)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Retur Penjualan') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Retur Penjualan)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Bayar Utang') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Pembayaran Utang)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Terima Piutang') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Penerimaan Piutang)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Pembelian') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Pembelian)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Penjualan') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Penjualan)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Jurnal') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Entri Jurnal)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Piutang Awal') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Piutang Awal)</small></span>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == 'Utang Awal') { ?>
                                    <td>
                                        <?php echo $head->kode_jurnal ?> <br>
                                        <span class="text-primary"><small>(Utang Awal)</small></span>
                                    </td>
                                <?php } ?>
                                <td><?php echo format_indo($head->tanggal_transaksi) ?></td>
                                <td colspan="5"></td>
                                <?php if ($head->status == 'Close') { ?>
                                    <td>
                                        <button class="btn btn-submit btn-sm text-dark font-weight-bold" style="background-color:#28B5B5;"><i class="far fa-window-close"></i> Periode Ditutup</button>
                                    </td>
                                <?php } else if ($head->jenis_transaksi == "Jurnal") { ?>
                                    <td>
                                        <?php echo anchor('Laporan/Jurnal/editJurnal/' . $head->kode_jurnal . '/' . $head->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                        <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Laporan/Jurnal/deleteJurnal/') . $head->kode_jurnal ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                <?php } elseif ($head->jenis_transaksi == "Pembelian") { ?>
                                    <td>
                                        <?php echo anchor('Pembelian/Pembelian/editPembelian/' . $head->kode_jurnal . '/' . $head->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                        <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Pembelian/Pembelian/deletePembelian/') . $head->kode_jurnal ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                <?php } elseif ($head->jenis_transaksi == "Penjualan") { ?>
                                    <td>
                                        <?php echo anchor('Penjualan/Penjualan/editPenjualan/' . $head->kode_jurnal . '/' . $head->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                        <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Penjualan/Penjualan/deletePenjualan/') . $head->kode_jurnal ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                <?php } elseif ($head->jenis_transaksi == "Retur Pembelian") { ?>
                                    <td>
                                        <?php echo anchor('Pembelian/Pembelian/editReturPembelian/' . $head->kode_jurnal . '/' . $head->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                        <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Pembelian/Pembelian/deleteReturPembelian/') . $head->kode_jurnal . '/' . $head->tanggal_transaksi ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                <?php } elseif ($head->jenis_transaksi == "Retur Penjualan") { ?>
                                    <td>
                                        <?php echo anchor('Penjualan/Penjualan/editReturPenjualan/' . $head->kode_jurnal . '/' . $head->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                        <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Penjualan/Penjualan/deleteReturPenjualan/') . $head->kode_jurnal . '/' . $head->tanggal_transaksi ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                <?php } elseif ($head->jenis_transaksi == "Bayar Utang") { ?>
                                    <td>
                                        <?php echo anchor('Pembelian/Pembelian/editBayarUtang/' . $head->kode_jurnal . '/' . $head->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                        <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Pembelian/Pembelian/deleteBayarUtang/') . $head->kode_jurnal . '/' . $head->tanggal_transaksi ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                <?php } elseif ($head->jenis_transaksi == "Terima Piutang") { ?>
                                    <td>
                                        <?php echo anchor('Penjualan/Penjualan/editTerimaPiutang/' . $head->kode_jurnal . '/' . $head->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                        <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Penjualan/Penjualan/deleteTerimaPiutang/') . $head->kode_jurnal . '/' . $head->tanggal_transaksi ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                <?php } elseif ($head->jenis_transaksi == "Utang Awal") { ?>
                                    <td>
                                        <?php echo anchor('Master_data/Supplier/editUtangAwal/' . $head->kode_jurnal . '/' . $head->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                        <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Supplier/deleteUtangAwal/') . $head->kode_jurnal . '/' . $head->tanggal_transaksi ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                <?php } elseif ($head->jenis_transaksi == "Piutang Awal") { ?>
                                    <td>
                                        <?php echo anchor('Master_data/Customer/editPiutangAwal/' . $head->kode_jurnal . '/' . $head->tanggal_transaksi, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                        <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Customer/deletePiutangAwal/') . $head->kode_jurnal . '/' . $head->tanggal_transaksi ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php
                            $akun = $this->db->query("SELECT a.*,b.*
                            from tb_jurnal a
                            join tb_akun b on a.id_akun = b.id_akun
                            where a.kode_jurnal = '$head->kode_jurnal' and a.tanggal_transaksi ='$head->tanggal_transaksi'
                            and a.jenis_transaksi ='$head->jenis_transaksi' and a.saldo_jurnal <> 0");
                            $jumlahBaris = $akun->num_rows();
                            $daftarAkun = $akun->result();
                            ?>
                            <?php foreach ($daftarAkun as $a) { ?>
                                <tr class="text-center">
                                    <td colspan="3"></td>
                                    <td><?php echo $a->kode_akun . '-' . $a->no_akun ?></td>
                                    <?php if ($a->posisi == 'Debit') { ?>
                                        <td><?php echo $a->nama_akun ?></td>
                                        <td></td>
                                        <td class="text-right">Rp <?php echo number_format($a->saldo_jurnal, 0, ',', '.') ?></td>
                                        <td class="text-right">-</td>
                                        <td></td>
                                        <?php $debit = $debit + $a->saldo_jurnal ?>
                                    <?php } elseif ($a->posisi == 'Kredit') { ?>
                                        <td></td>
                                        <td><?php echo $a->nama_akun ?><br>
                                        <td class="text-right">-</td>
                                        <td class="text-right">Rp <?php echo substr(number_format($a->saldo_jurnal, 0, ',', '.'), 1) ?></td>
                                        <td></td>
                                        <?php $kredit = $kredit + $a->saldo_jurnal ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    <tfoot>
                        <tr class="bg-light">
                            <th class="table-bordered text-center text-primary" colspan="6">Total</th>
                            <th class="text-right text-primary">Rp <?php echo number_format($debit, 0, ',', '.') ?></th>
                            <?php if ($kredit == 0) { ?>
                                <th class="text-right text-primary">Rp <?php echo substr(number_format($kredit, 0, ',', '.'), 0) ?></th>
                            <?php } else { ?>
                                <th class="text-right text-primary">Rp <?php echo substr(number_format($kredit, 0, ',', '.'), 1) ?></th>
                            <?php } ?>
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