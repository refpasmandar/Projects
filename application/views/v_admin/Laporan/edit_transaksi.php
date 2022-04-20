<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fa fa-plus-circle"></i> Edit Transaksi</p>
    <hr>

    <!-- <?php $this->view('flashdata') ?> -->
    <?php foreach($transaksi as $tr) : ?>
        <form class="mb-5" method="post" action="<?php echo base_url('Transaksi/Transaksi/tambahTransaksi')?>">
            <div class="form-row">
            <!-- Saldo Debit -->
            <p class="ketsaldo col-lg-12 bg-primary text-white font-italic rounded-left rounded-right p-3">Transaksi 1 <br>(Saldo Debit)</p>
                <div class="form-group col-lg-6">
                    <label for="">Periode Transaksi <span class="text-danger">*</span></label>
                    <select class="form-control mb-3" name="periode[]" id="periode">
                        <option value="">--- Pilih Periode ----</option>
                        <?php foreach($periode as $pr){ ?>
                            <option value="<?php echo $pr->id_periode?>" <?php echo $pr->id_periode == $tr->id_periode? 'selected' : '' ?>><?php echo format_indo(date('Y-m',strtotime($pr->periode))); ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('periode[]') ?>
                </div>
                <div class="form-group col-lg-6">
                    <label for="">Tanggal Transaksi <span class="text-danger">*</span></label>
                    <input class="form-control" name="tanggal[]" id="tanggal" type="date" value="<?php echo $tr->tanggal_transaksi?>">
                    <?php echo form_error('tanggal[]') ?>
                </div>
                <!-- Saldo Kredit -->
                <div class="form-group col-lg-6">
                    <label for="">Nomor Akun <span class="text-danger">*</span></label>
                    <input name="no_akun[]" id="no_akun" class="form-control" type="text" readonly>
                </div>
                <div class="form-group col-lg-6">
                    <label for="">Nama Akun <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="id_akun[]" id="id_akun" value="">
                    <input class="form-control" name="nama_akun[]" id="nama_akun" type="text">
                    <?php echo form_error('id_akun[]') ?>
                </div>
                <div class="form-group col-lg-12" id="pegawai">
                    <label for="">Nama Pegawai <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="id_pegawai[]" id="id_pegawai">
                    <input class="form-control" name="nama_pegawai[]" type="text" value="<?php echo $tr->nama_pegawai?>">
                </div>
                <div class="form-group col-lg-3" id="barang">
                    <label for="">Barang <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="id_barang[]" id="id_barang">
                    <input class="form-control" name="nama_barang[]"  type="text">
                    <p id="alert_spc"><?php echo form_error('id_barang[]') ?></p>
                </div>
                <div class="form-group col-lg-3" id="f_harga">
                    <label for="">Harga <span class="text-danger">*</span></label>
                    <input class="form-control" name="harga[]"  type="text" readonly>
                </div>
                <div class="form-group col-lg-3" id="f_jumlah">
                    <label for="">Jumlah <span class="text-danger">*</span></label>
                    <input class="form-control" name="jumlah[]"  type="text">
                    <p id="alert_spc"><?php echo form_error('jumlah[]') ?></p>
                </div>
                <div class="form-group col-lg-3" id="satuan">
                    <label for="">Satuan<span class="text-danger">*</span></label>
                    <input class="form-control" name="id_satuan[]" id="id_satuan" type="hidden">
                    <input class="form-control" name="satuan_barang[]" type="text" readonly>
                </div>
                <div class="form-group col-lg-6" id="saldo">
                    <label for="">Saldo <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="saldo[]" >
                    <?php echo form_error('saldo[]') ?>
                </div>
                <div class="form-group col-lg-6" id="jenis">
                    <label for="">Jenis Saldo <span class="text-danger">*</span></label>
                    <select class="form-control" id="posisi" disabled="true">
                        <option value="">-- Pilih Jenis Saldo -- </option>
                        <option value="1" selected>Debit</option>
                        <option value="2">Kredit</option>
                    </select>
                    <input type="hidden" name="posisi[]" value="1">
                    <?php echo form_error('posisi[]') ?>
                </div>
                <div class="form-group col-lg-12" id="keterangan">
                    <label for="">Keterangan Transaksi</label>
                    <input class="form-control" type="text" name="keterangan[]" id="keterangan">
                </div>
        </form>
    <?php endforeach; ?>
</div>
    