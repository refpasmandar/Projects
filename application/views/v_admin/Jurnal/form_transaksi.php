<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fa fa-plus-circle"></i> Form Pencatatan Transaksi</p>
    <hr>

    <?php $this->view('flashdata') ?>
    <form class="mb-5" method="post" action="<?php echo base_url('Transaksi/Transaksi/tambahTransaksi')?>">
        <div class="form-row">
        <!-- Saldo Debit -->
        <p class="ketsaldo col-lg-12 bg-primary text-white font-italic rounded-left rounded-right p-3">Transaksi 1 <br>(Saldo Debit)</p>
            <div class="form-group col-lg-6">
                <label for="">Periode Transaksi <span class="text-danger">*</span></label>
                <select class="form-control mb-3" name="periode[]" id="periode">
                    <option value="">--- Pilih Periode ----</option>
                    <?php foreach($periode as $pr){ ?>
                        <option value="<?php echo $pr->id_periode?>"><?php echo format_indo(date('Y-m',strtotime($pr->periode))); ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('periode[]') ?>
            </div>
            <div class="form-group col-lg-6">
                <label for="">Tanggal Transaksi <span class="text-danger">*</span></label>
                <input class="form-control" name="tanggal[]" id="tanggal" type="date">
                <?php echo form_error('tanggal[]') ?>
            </div>
            <!-- Saldo Kredit -->
            <div class="form-group col-lg-6">
                <label for="">Nomor Akun <span class="text-danger">*</span></label>
                <input name="no_akun[]" id="no_akun" class="form-control" type="text" readonly>
            </div>
            <div class="form-group col-lg-6">
                <label for="">Nama Akun <span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" name="id_akun[]" id="id_akun">
                <input class="form-control" name="nama_akun[]" id="nama_akun" type="text">
                <?php echo form_error('id_akun[]') ?>
            </div>
            <div class="form-group col-lg-12" id="pegawai" style="display:none;">
                <label for="">Nama Pegawai <span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" name="id_pegawai[]" id="id_pegawai">
                <input class="form-control" name="nama_pegawai[]" id="nama_pegawai" type="text">
            </div>
            <div class="form-group col-lg-3" id="barang" style="display:none;">
                <label for="">Barang <span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" name="id_barang[]" id="id_barang">
                <input class="form-control" name="nama_barang[]" id="nama_barang" type="text">
                <p id="alert_spc"><?php echo form_error('id_barang[]') ?></p>
            </div>
            <div class="form-group col-lg-3" id="f_harga" style="display:none;">
                <label for="">Harga <span class="text-danger">*</span></label>
                <input class="form-control" name="harga[]" id="harga" type="text" readonly>
            </div>
            <div class="form-group col-lg-3" id="f_jumlah" style="display:none;">
                <label for="">Jumlah <span class="text-danger">*</span></label>
                <input class="form-control" name="jumlah[]" id="jumlah" type="text">
                <p id="alert_spc"><?php echo form_error('jumlah[]') ?></p>
            </div>
            <div class="form-group col-lg-3" id="satuan" style="display:none;">
                <label for="">Satuan<span class="text-danger">*</span></label>
                <input class="form-control" name="id_satuan[]" id="id_satuan" type="hidden">
                <input class="form-control" name="satuan_barang[]" id="satuan_barang" type="text" readonly>
            </div>
            <div class="form-group col-lg-6" id="saldo" style="display:none;">
                <label for="">Saldo <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="saldo[]" id="total">
                <?php echo form_error('saldo[]') ?>
            </div>
            <div class="form-group col-lg-6" id="jenis" style="display:none;">
                <label for="">Jenis Saldo <span class="text-danger">*</span></label>
                <select class="form-control" id="posisi" disabled="true">
                    <option value="">-- Pilih Jenis Saldo -- </option>
                    <option value="1" selected>Debit</option>
                    <option value="2">Kredit</option>
                </select>
                <input type="hidden" name="posisi[]" value="1">
                <?php echo form_error('posisi[]') ?>
            </div>
            <div class="form-group col-lg-12" id="keterangan" style="display:none;">
                <label for="">Keterangan Transaksi</label>
                <input class="form-control" type="text" name="keterangan[]" id="keterangan">
            </div>

            <!-- Saldo Kredit -->
            <p class="ketsaldo col-lg-12 bg-danger text-white font-italic rounded-left rounded-right mt-4 p-3">Transaksi 2 <br>(Saldo Kredit)</p>
            <div class="form-group col-lg-6">
                <label for="">Periode Transaksi <span class="text-danger">*</span></label>
                <select class="form-control mb-3" name="periode[]" id="periode_2">
                    <option value="">--- Pilih Periode ----</option>
                    <?php foreach($periode as $pr){ ?>
                        <option value="<?php echo $pr->id_periode?>"><?php echo format_indo(date('Y-m',strtotime($pr->periode))); ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('periode[]') ?>
            </div>
            <div class="form-group col-lg-6">
                <label for="">Tanggal Transaksi <span class="text-danger">*</span></label>
                <input class="form-control" name="tanggal[]" id="tanggal_2" type="date">
                <?php echo form_error('tanggal[]') ?>
            </div>
            <!-- Saldo Debit -->
            <div class="form-group col-lg-6">
                <label for="">Nomor Akun <span class="text-danger">*</span></label>
                <input name="no_akun[]" id="no_akun_2" class="form-control" type="text" readonly>
            </div>
            <div class="form-group col-lg-6">
                <label for="">Nama Akun <span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" name="id_akun[]" id="id_akun_2">
                <input class="form-control" name="nama_akun[]" id="nama_akun_2" type="text">
                <?php echo form_error('id_akun[]') ?>
            </div>
            <div class="form-group col-lg-12" id="pegawai_2" style="display:none;">
                <label for="">Nama Pegawai <span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" name="id_pegawai[]" id="id_pegawai_2">
                <input class="form-control" name="nama_pegawai[]" id="nama_pegawai_2" type="text">
            </div>
            <div class="form-group col-lg-3" id="barang_2" style="display:none;">
                <label for="">Barang <span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" name="id_barang[]" id="id_barang_2">
                <input class="form-control" name="nama_barang[]" id="nama_barang_2" type="text">
                <?php echo form_error('id_barang[]') ?>
            </div>
            <div class="form-group col-lg-3" id="f_harga_2" style="display:none;">
                <label for="">Harga <span class="text-danger">*</span></label>
                <input class="form-control" name="harga[]" id="harga_2" type="text" readonly>
            </div>
            <div class="form-group col-lg-3" id="f_jumlah_2" style="display:none;">
                <label for="">Jumlah <span class="text-danger">*</span></label>
                <input class="form-control" name="jumlah[]" id="jumlah_2" type="text">
                <?php echo form_error('jumlah[]') ?>
            </div>
            <div class="form-group col-lg-3" id="satuan_2" style="display:none;">
                <label for="">Satuan<span class="text-danger">*</span></label>
                <input class="form-control" name="id_satuan[]" id="id_satuan_2" type="hidden">
                <input class="form-control" name="satuan_barang[]" id="satuan_barang_2" type="text" readonly>
            </div>
            <div class="form-group col-lg-6" id="saldo_2" style="display:none;">
                <label for="">Saldo <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="saldo[]" id="total_2">
                <?php echo form_error('saldo[]') ?>
            </div>
            <div class="form-group col-lg-6" id="jenis_2" style="display:none;">
                <label for="">Jenis Saldo <span class="text-danger">*</span></label>
                <select class="form-control" name="posisi[]" id="posisi_2" disabled="true">
                    <option value="">-- Pilih Jenis Saldo -- </option>
                    <option value="1">Debit</option>
                    <option value="2" selected>Kredit</option>
                </select>
                <input type="hidden" name="posisi[]" value="2">
                <?php echo form_error('posisi[]') ?>
            </div>
            <div class="form-group col-lg-12" id="keterangan_2" style="display:none;">
                <label for="">Keterangan Transaksi</label>
                <input class="form-control" type="text" name="keterangan[]" id="keterangan_2">
            </div>
            <button type="submit" class="btn btn-sm btn-primary mr-2"><i class="fa fa-plus"></i> Tambah</button>
            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-eraser"></i> Bersihkan</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    //Autocomplate form transaksi (Nama Akun & Nomor Akun) -- Form Kredit
        $(document).ready(function () {
            $('#nama_akun').autocomplete({
                source: "<?php echo base_url('Transaksi/Transaksi/get_autocomplete');?>",
                select: function (event, ui) {
                    $('[id="nama_akun"]').val(ui.item.label);
                    $('[id="id_akun"]').val(ui.item.id_akun);
                    $('[id="no_akun"]').val(ui.item.no_akun);
                }
            });
        });
    </script>

    <script type="text/javascript">
    //Autocomplate form transaksi (Nama Akun & Nomor Akun) -- Form Debit
        $(document).ready(function () {
            $('#nama_akun_2').autocomplete({
                source: "<?php echo base_url('Transaksi/Transaksi/get_autocomplete');?>",
                select: function (event, ui) {
                    $('[id="nama_akun_2"]').val(ui.item.label);
                    $('[id="id_akun_2"]').val(ui.item.id_akun);
                    $('[id="no_akun_2"]').val(ui.item.no_akun);
                }
            });
        });
    </script>

    <!-- Autocomplate untuk form transaksi (Nama Pegawai) -- Form Kredit -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#nama_pegawai').autocomplete({
                source: "<?php echo base_url('Transaksi/Transaksi/get_pegawai');?>",
                select: function (event, ui) {
                    $('[id="nama_pegawai"]').val(ui.item.label);
                    $('[id="id_pegawai"]').val(ui.item.id_pegawai);
                }
            });
        });
    </script>

    <!-- Autocomplate untuk form transaksi (Nama Pegawai) -- Form Debit -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#nama_pegawai_2').autocomplete({
                source: "<?php echo base_url('Transaksi/Transaksi/get_pegawai');?>",
                select: function (event, ui) {
                    $('[id="nama_pegawai_2"]').val(ui.item.label);
                    $('[id="id_pegawai_2"]').val(ui.item.id_pegawai);
                }
            });
        });
    </script>

    <script type="text/javascript">
    //Autocomplate daftar barang -- Form kredit
        $(document).ready(function () {
            var akun = document.getElementById("nama_akun").value
            $('#nama_barang').autocomplete({
                source: "<?php echo base_url('Transaksi/Transaksi/get_barang');?>",
                select: function (event, ui) {
                    $('[id="nama_barang"]').val(ui.item.label);
                    $('[id="id_barang"]').val(ui.item.id_barang);
                    if($('#nama_akun').val() == 'Pembelian'){
                        $('[id="harga"]').val(ui.item.harga_beli);
                    }else{
                        $('[id="harga"]').val(ui.item.harga_jual);
                    }
                    $('[id="id_satuan"]').val(ui.item.id_satuan);
                    $('[id="satuan_barang"]').val(ui.item.satuan_barang);
                }
            });
        });
    </script>

    <script type="text/javascript">
    //Autocomplate daftar barang -- Form kredit
        $(document).ready(function () {
            var akun = document.getElementById("nama_akun").value
            $('#nama_barang_2').autocomplete({
                source: "<?php echo base_url('Transaksi/Transaksi/get_barang');?>",
                select: function (event, ui) {
                    $('[id="nama_barang_2"]').val(ui.item.label);
                    $('[id="id_barang_2"]').val(ui.item.id_barang);
                    if($('#nama_akun_2').val() == 'Pembelian'){
                        $('[id="harga_2"]').val(ui.item.harga_beli);
                    }else{
                        $('[id="harga_2"]').val(ui.item.harga_jual);
                    }
                    $('[id="id_satuan_2"]').val(ui.item.id_satuan);
                    $('[id="satuan_barang_2"]').val(ui.item.satuan_barang);
                }
            });
        });
    </script>