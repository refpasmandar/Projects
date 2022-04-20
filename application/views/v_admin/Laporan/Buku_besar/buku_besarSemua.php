<!-- Begin Page Content -->
<div class="container-fluid">
    <p class="title_halaman"><i class="fas fa-book"></i> Buku Besar</p>
    <hr>

    <!-- <div class='col-lg-12 text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Laporan/Buku_besar/bukuBesar') ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buku Besar
                <br>
                <span class="text-dark"><?= format_indo(date(($tanggal1))) . " Hingga " .  format_indo(($tanggal2)) ?></span>
            </h6>
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo base_url('Laporan/Buku_besar/prosesfilterBukuBesar') ?>">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="tanggal1">Tanggal <span class="text-danger">*</span></label>
                        <input class="form-control" name="tanggal1jurnal" type="date" value="<?php echo set_value('tanggal1jurnal') ?>">
                        <?php echo form_error('tanggal1jurnal') ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="tanggal2">Tanggal <span class="text-danger">*</span></label>
                        <input class="form-control" name="tanggal2jurnal" type="date" value="<?php echo set_value('tanggal2jurnal') ?>">
                        <?php echo form_error('tanggal2jurnal') ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <div class="form-check form-check-inline col-lg-12 justify-content-center">
                            <label for="">
                                <input class="mr-2 radio" type="radio" name="filterBukuBesar" <?php if ($radioChecked == "1") {
                                                                                                    echo "checked";
                                                                                                } ?> value="1" id="radio_1">Seluruh Akun
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <div class="form-check form-check-inline col-lg-12 justify-content-center">
                            <label for=""><input class="mr-2 radio" type="radio" name="filterBukuBesar" value="2" id="radio_2">Per Akun</label>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 text-center">
                        <?php echo form_error("filterBukuBesar") ?>
                    </div>
                    <div class="form-group col-lg-12" id="filterAkun" style="display:none;">
                        <select class="form-control id_akun" name="id_akun" id="id_akun">
                            <option value="" selected="selected" disabled="disabled">-- Pilih Akun--</option>
                            <?php foreach ($coa as $c) { ?>
                                <option value="<?php echo $c->id_akun ?>">
                                    <?php echo $c->nama_akun ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-12 mt-2">
                        <button type="submit" class=" form-control btn btn-primary btn-submit"><i class="fas fa-search"></i> Tampilkan</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <hr class="mb-4" style="border-bottom:1px solid #007bff">
                    <?php
                    $saldoawal = $this->db->query("SELECT a.*,b.* from tb_saldo a
                                                right Join tb_akun b on a.id_akun = b.id_akun
                                                where b.level = '4' and a.periode_saldo = '$tanggal1' order by b.kode_akun,b.no_akun")->result();
                    foreach ($saldoawal as $jr) { ?>
                        <div class="row" style="font-size:20px;">
                            <div class="col">
                                <div style="font-size:12px;">Nama Akun :</div>
                                <div class="text-primary font-weight-bold"> <?= $jr->nama_akun; ?></div>
                            </div>
                            <div class="col text-right">
                                <div style="font-size:12px;">Nomor Akun :</div>
                                <div class="text-primary font-weight-bold"> <?= $jr->kode_akun . '-' . $jr->no_akun; ?></div>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="bootstrap" class="table table-bordered">
                                <thead class="text-center bg-primary text-white">
                                    <tr>
                                        <td class="align-middle" rowspan="2">Tanggal Transaksi</td>
                                        <td class="align-middle" rowspan="2">Nama Akun</td>
                                        <td class="align-middle" rowspan="2">Debit</td>
                                        <td class="align-middle" rowspan="2">Kredit</td>
                                        <td class="align-middle" colspan="2">Saldo</td>
                                    </tr>
                                    <tr>
                                        <td>Debit</td>
                                        <td>Kredit</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $akun = $this->db->query("SELECT a.*,b.* from tb_saldo a
                                                right Join tb_akun b on a.id_akun = b.id_akun
                                                where b.level = '4' and a.id_akun = '$jr->id_akun' and a.periode_saldo = '$tanggal1'")->result();
                                    foreach ($akun as $sa) { ?>
                                        <?php if ($sa->saldo_awal != 0) { ?>
                                            <tr class="text-center">
                                                <td><?php echo $sa->periode_saldo ?></td>
                                                <td><?php echo $sa->nama_akun ?></td>
                                                <?php if ($sa->saldo_awal > 0) { ?>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . number_format($sa->saldo_awal, 0, ',', '.') ?>
                                                    </td>
                                                    <td class="text-right">Rp. 0</td>
                                                <?php } else { ?>
                                                    <td class="text-right">Rp. 0</td>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . substr(number_format($sa->saldo_awal, 0, ',', '.'), 1) ?>
                                                    </td>
                                                <?php } ?>
                                                <?php if ($sa->saldo_awal > 0) { ?>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . number_format($sa->saldo_awal, 0, ',', '.') ?>
                                                    </td>
                                                    <td class="text-right">-</td>
                                                <?php } else { ?>
                                                    <td class="text-right">-</td>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . substr(number_format($sa->saldo_awal, 0, ',', '.'), 1) ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>

                                    <?php
                                    $id_akun = $jr->id_akun;
                                    $testing = $this->db->query("SELECT * from tb_saldo a
                                                where id_akun = '$id_akun' and periode_saldo = '$tanggal1'")->row_array();
                                    // $daftarTransaksi = $testing->result();
                                    $buku_besar = $this->M_laporan->closingBukuBesar($tanggal1, $tanggal2, $id_akun)->result();
                                    ?>
                                    <?php if (empty($buku_besar) && $testing['saldo_awal'] == 0) { ?>
                                        <tr>
                                            <td colspan='6' class="text-center">Tidak Ada Transaksi & Saldo Awal</td>
                                        </tr>
                                    <?php } else if (empty($buku_besar) && ($testing['saldo_awal'] < 0 || $testing['saldo_awal'] > 0)) {
                                        $no = 1;
                                        if (empty($testing['saldo_awal'])) {
                                            $debit = 0;
                                        } else {
                                            $debit = $testing['saldo_awal'];
                                        }
                                        $kredit = 0;
                                        $hasil = $debit - $kredit; ?>
                                        <tr>
                                            <td class="text-center bg-primary text-white" colspan="4"><b>Total</b></td>
                                            <?php if ($hasil >= 0) { ?>
                                                <td class="text-right text-success font-weight-bold"><?= 'Rp. ' . number_format($hasil, 0, ',', '.') ?></td>
                                                <td class="text-right text-danger"> - </td>
                                            <?php } elseif ($hasil < 0) { ?>
                                                <td class="text-right text-success"> - </td>
                                                <td class="text-right text-danger font-weight-bold"><?= 'Rp. ' . number_format(abs($hasil), 0, ',', '.') ?></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } else { ?>
                                        <?php
                                        $no = 1;
                                        if (empty($testing['saldo_awal'])) {
                                            $debit = 0;
                                        } else {
                                            $debit = $testing['saldo_awal'];
                                        }
                                        $kredit = 0;
                                        foreach ($buku_besar as $bb) { ?>
                                            <tr class="text-center">
                                                <td><?php echo $bb->tanggal_transaksi ?></td>
                                                <td><?php echo $bb->nama_akun ?></td>
                                                <?php if ($bb->posisi == 'Debit') { ?>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . number_format($bb->saldo_jurnal, 0, ',', '.') ?>
                                                    </td>
                                                    <td class="text-right">Rp. 0</td>
                                                <?php } else if ($bb->posisi == 'Kredit' && $bb->saldo_jurnal == 0) { ?>
                                                    <td class="text-right">Rp. 0</td>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . substr(number_format($bb->saldo_jurnal, 0, ',', '.'), 0) ?>
                                                    </td>
                                                <?php } else { ?>
                                                    <td class="text-right">Rp. 0</td>
                                                    <td class="text-right">
                                                        <?= 'Rp. ' . substr(number_format($bb->saldo_jurnal, 0, ',', '.'), 1) ?>
                                                    </td>
                                                <?php } ?>
                                                <?php if ($bb->posisi == "Debit" && $bb->saldo_jurnal > 0) {
                                                    $debit = $debit + $bb->saldo_jurnal;
                                                } else if ($bb->posisi == "Kredit" && $bb->saldo_jurnal < 0) {
                                                    $kredit = $kredit + substr(($bb->saldo_jurnal), 1);
                                                }
                                                $hasil = $debit - $kredit;
                                                ?>
                                                <?php if ($hasil >= 0) { ?>
                                                    <td class="text-right"><?= 'Rp. ' . number_format($hasil, 0, ',', '.') ?></td>
                                                    <td class="text-right"> - </td>
                                                <?php } else { ?>
                                                    <td class="text-right"> - </td>
                                                    <td class="text-right"><?= 'Rp. ' . number_format(abs($hasil), 0, ',', '.') ?></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                        <?php
                                        $debit = 0;
                                        $kredit = 0;
                                        ?>
                                        <td class="text-center bg-primary text-white" colspan="4"><b>Total</b></td>
                                        <?php if ($hasil >= 0) { ?>
                                            <td class="text-right text-success font-weight-bold"><?= 'Rp. ' . number_format($hasil, 0, ',', '.') ?></td>
                                            <td class="text-right text-danger"> - </td>
                                        <?php } elseif ($hasil < 0) { ?>
                                            <td class="text-right text-success"> - </td>
                                            <td class="text-right text-danger font-weight-bold"><?= 'Rp. ' . number_format(abs($hasil), 0, ',', '.') ?></td>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <hr class="mb-4" style="border-bottom:1px solid #007bff">
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#radio_2,#radio_1").click(function() {
            if ($("#radio_2").is(":checked")) {
                $("#filterAkun").css('display', 'block');
                // var html = <?php echo form_error('id_akun') ?>
                // $("#filterAkun").append(html);
                $('select[id="id_akun"] option:eq(1)').attr('selected', 'selected');
            } else {
                $("#filterAkun").css('display', 'none');
            }
        })
    })
</script>