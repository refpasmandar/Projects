<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-boxes"></i> Edit Barang</p>
    <hr>

    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" href="<?php echo base_url('Master_data/Barang/Persediaan'); ?>"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Button Kembali -->
            <div class="card">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold">Form Edit Barang</h6>
                </div>
                <div class="card-body">
                    <?php foreach ($barang as $brg) : ?>
                        <form method="post" name="coa" action="<?php echo base_url('Master_data/Barang/prosesEdit') ?>">
                            <div class="form-group">
                                <label for="">Kode Barang <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="kode_barang" value="<?php echo $brg->kode_barang ?>">
                                <?php echo form_error('kode_barang') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Kode Pabrik <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="kode_pabrik" value="<?php echo $brg->kode_pabrik ?>">
                                <?php echo form_error('kode_pabrik') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Supplier <span class="text-danger">*</span></label>
                                <select class="form-control" name="id_supplier" id="id_supplier">
                                    <option value="" disabled>--- Pilih Pemasok ---</option>
                                    <?php foreach ($supp as $sp) { ?>
                                        <option value="<?php echo $sp->id_supplier ?>" <?php echo ($brg->id_supplier == $sp->id_supplier) ? 'selected' : '' ?>><?php echo $sp->nama_supplier ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('id_supplier') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Barang <span class="text-danger">*</span></label>
                                <input class="form-control" type="hidden" name="id_barang" value="<?php echo $brg->id_barang ?>">
                                <input class="form-control" type="text" name="nama_barang" value="<?php echo $brg->nama_barang ?>">
                                <?php echo form_error('nama_barang') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Satuan Beli Barang <span class="text-danger">*</span></label>
                                <select class="form-control" name="satuan_beli" id="satuan_beli">
                                    <option value="">--- Pilih Satuan ---</option>
                                    <?php foreach ($satuanbeli as $sb) { ?>
                                        <option value="<?php echo $sb->id_satuanbeli ?>" <?php echo ($brg->satuan_beli == $sb->satuan_beli) ? 'selected' : '' ?>><?php echo $sb->satuan_beli ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('satuan_beli') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Harga Beli Barang <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">Rp.</div>
                                    <input class="form-control" type="text" name="harga_beli" onkeypress="return hanyaAngka(event)" value="<?php echo $brg->harga_beli ?>">
                                    <div class="input-group-addon">.00</div>
                                </div>
                                <?php echo form_error('harga_beli') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Beli <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="stok_beli" id="stok_beli" onkeypress="return hanyaAngka(event)" value="<?php echo $brg->stok_beli ?>">
                                <?php echo form_error('stok_beli') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Satuan Jual Barang <span class="text-danger">*</span></label>
                                <select class="form-control" name="satuan_jual" id="satuan_jual">
                                    <option value="">--- Pilih Satuan ---</option>
                                    <?php foreach ($satuanjual as $sj) { ?>
                                        <option value="<?php echo $sj->id_satuanjual ?>" <?php echo ($brg->satuan_jual == $sj->satuan_jual) ? 'selected' : '' ?>><?php echo $sj->satuan_jual ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('satuan_jual') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Harga Pokok Penjualan <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">Rp.</div>
                                    <input class="form-control" type="text" name="hpp" onkeypress="return hanyaAngka(event)" value="<?php echo $brg->hpp ?>">
                                    <div class="input-group-addon">.00</div>
                                </div>
                                <?php echo form_error('harga_jual') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Harga Jual Barang <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">Rp.</div>
                                    <input class="form-control" type="text" name="harga_jual" onkeypress="return hanyaAngka(event)" value="<?php echo $brg->harga_jual ?>">
                                    <div class="input-group-addon">.00</div>
                                </div>
                                <?php echo form_error('harga_jual') ?>
                            </div>
                            <div class="ket_konversi">
                                <p class="text-danger font-weight-bold">** Keterangan Nilai Konversi</p>
                                <p class="font-weight-bold">Jika Satuan Beli dan Jual Sama, Inputkan 1</p>
                            </div>
                            <div class="form-group">
                                <label for="">Nilai Konversi <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="nilai_konversi" data-initial-value="<?php echo $brg->nilai_konversi ?>" id="nilai_konversi" value="<?php echo $brg->nilai_konversi ?>">
                                <?php echo form_error('nilai_konversi') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Stok Hasil Konversi <span class="text-danger">*/**</span></label>
                                <input class="form-control" type="text" name="stok_jual" id="stok_jual" readonly value="<?php echo $brg->stok_jual ?>">
                                <p class="text-danger text-sm-left" id="ket_konversi"></p>
                                <?php echo form_error('stok_jual') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Kategori Barang <span class="text-danger">*</span></label>
                                <select class="form-control" name="kategori_barang" id="kategori_barang" value="<?php echo $brg->ketegori_barang ?>">
                                    <option value="">--- Pilih kategori ---</option>
                                    <?php foreach ($kategori as $kt) { ?>
                                        <option value="<?php echo $kt->id_kategori ?>" <?php echo ($brg->id_kategori == $kt->id_kategori) ? 'selected' : '' ?>><?php echo $kt->kategori_barang ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('kategori_barang') ?>
                            </div>
                            <p class="text-danger reminder"><span>*</span> : Wajib Diisi</p>
                            <div class="text-center">
                                <button type="submit" class="btn btn-sm btn-submit btn-primary mr-2"><i class="fas fa-save mr-1"></i> Simpan</button>
                                <button type="reset" class="btn btn-sm btn-undo btn-danger"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var satuan_beli = $("#satuan_beli option:selected").text();
        var satuan_jual = $("#satuan_jual option:selected").text();
        if (!$("#satuan_beli").val() && !$("#satuan_jual").val()) {
            $("#ket_konversi").html('');
        } else if (!$("#satuan_beli").val()) {
            $("#ket_konversi").html("Nilai hasil konversi dari ....... Ke <strong?>" + satuan_jual + "</strong>");
        } else if (!$("#satuan_jual").val()) {
            $("#ket_konversi").html("Nilai hasil konversi dari <strong>" + satuan_beli + "</strong> Ke .......");
        } else {
            $("#ket_konversi").html("Nilai hasil konversi dari <strong>" + satuan_beli + "</strong> Ke <strong>" + satuan_jual + "</strong>");
        }
    })

    $("#satuan_beli,#satuan_jual").on('change', function() {
        var satuan_beli = $("#satuan_beli option:selected").text();
        var satuan_jual = $("#satuan_jual option:selected").text();
        var oldValue = $("#nilai_konversi").attr("data-initial-value");
        if (!$("#satuan_beli").val() && !$("#satuan_jual").val()) {
            $("#ket_konversi").html('');
        } else if (!$("#satuan_beli").val()) {
            $("#ket_konversi").html("Nilai hasil konversi dari ....... Ke <strong?>" + satuan_jual + "</strong>");
        } else if (!$("#satuan_jual").val()) {
            $("#ket_konversi").html("Nilai hasil konversi dari <strong>" + satuan_beli + "</strong> Ke .......");
        } else {
            $("#ket_konversi").html("Nilai hasil konversi dari <strong>" + satuan_beli + "</strong> Ke <strong>" + satuan_jual + "</strong>");
        }

        if ($("#satuan_beli").val() == $("#satuan_jual").val()) {
            $("#nilai_konversi").val('1');
            var beli = parseInt($("#stok_beli").val());
            var konversi = parseFloat($("#nilai_konversi").val());
            var stok_jual = beli * konversi;
            $("#stok_jual").val(stok_jual);
            if (isNaN(stok_jual)) {
                $("#stok_jual").val("0");
            } else {
                $("#stok_jual").val(stok_jual);
            }
        } else {
            $("#nilai_konversi").val(oldValue);
        }
    })

    $("#input_barang").on('click', function() {
        if ($("#nilai_konversi").val() == 0 || !$("#nilai_konversi").val()) {
            alert('Mohon Inputkan Nilai Konversi');
            return false;
        }
    })
</script>

<!-- <script type="text/javascript">
	$(document).ready(function(){
	    // Format mata uang.
	    $( '.uang' ).mask('0.000.000.000.000', {reverse: true});
	})
</script> -->