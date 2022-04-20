<div class="container-fluid">
    <div class='text-right btnBack'>
        <a class="btn btn-sm btn-warning" onclick="goBack()"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>
    <?php $this->view('flashdata') ?>
    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Form Edit Jurnal Entry</h6>
        </div>
        <div class="card-body">
            <form method="post" action="<?php echo base_url('Laporan/Jurnal/prosesEditJurnal') ?>">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-row">
                            <?php foreach ($single as $jr) : ?>
                                <div class="form-group col-lg-6">
                                    <?php foreach ($setting as $set) : ?>
                                        <label for="Kode Transaksi"><?php echo $set->kode_entry ?></label>
                                        <input type="hidden" name="kode_entry" value="<?php echo $set->kode_entry ?>">
                                    <?php endforeach; ?>
                                    <input class="form-control" type="text" name="kode_jurnal" id="kode_jurnal" value="<?php echo $jr->kode_jurnal ?>" readonly>
                                    <input class="form-control" type="hidden" name="jenis_transaksi" id="jenis_transaksi" value="Jurnal">
                                    <?php echo form_error('kode_jurnal') ?>
                                </div>
                                <div class="form-group col-lg-6">
                                    <!-- Pindah Baris -->
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="Tanggal Transaksi">Tanggal Transaksi</label>
                                    <input class="form-control" type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?php echo $jr->tanggal_transaksi ?>">
                                    <?php echo form_error('tanggal_transaksi') ?>
                                </div>
                                <div class="form-group col-lg-6">
                                    <!-- Pindah Baris -->
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="Memo Transaksi">Memo</label>
                                    <input class="form-control" type="text" name="memo" id="memo" value="<?php echo $jr->memo ?>">
                                    <?php echo form_error('memo') ?>
                                </div>
                            <?php endforeach; ?>
                            <div class="form-group col-lg-6">
                                <!-- Pindah Baris -->
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="entry">
                                    <thead class="text-center text-white bg-primary">
                                        <tr>
                                            <td>Nama Akun</td>
                                            <td>Nomor Akun</td>
                                            <td>Debit</td>
                                            <td>Kredit</td>
                                            <td hidden>test</td>
                                            <td hidden>test</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($transaksi as $tr) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="hidden" name="id_jurnal[]" value="<?php echo $tr->id_jurnal ?>">
                                                        <select class="form-control id_akun" name="id_akun[]" id="id_akun<?php echo $no ?>">
                                                            <option value="">-- Pilih Akun --</option>
                                                            <?php foreach ($coa as $c) { ?>
                                                                <option value="<?php echo $c->id_akun ?>" <?php echo $c->id_akun == $tr->id_akun ? 'selected' : '' ?> data-no_akun="<?php echo $c->kode_akun . "-" . $c->no_akun ?>">
                                                                    <?php echo $c->nama_akun ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                        <?php echo form_error('id_akun[]') ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input class="form-control no_akun" name="no_akun[]" id="no_akun_<?php echo $no ?>" type="text" readonly value="<?php echo $tr->kode_akun . '-' . $tr->no_akun ?>">
                                                    </div>
                                                </td>
                                                <?php if ($tr->posisi == 'Debit') { ?>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="debit[]" id="debit<?php echo $no ?>" class="form-control debit" onkeypress="return hanyaAngka(event)" value="<?php echo $tr->saldo_jurnal ?>">
                                                        </div>
                                                        <?php echo form_error('saldo[]') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="kredit[]" id="kredit<?php echo $no ?>" class="form-control kredit" onkeypress="return hanyaAngka(event)">
                                                        </div>
                                                        <?php echo form_error('saldo[]') ?>
                                                    </td>
                                                <?php } else { ?>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="debit[]" id="debit<?php echo $no ?>" class="form-control debit uang" onkeypress="return hanyaAngka(event)">
                                                        </div>
                                                        <?php echo form_error('saldo[]') ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="kredit[]" id="kredit<?php echo $no ?>" class="form-control kredit uang" onkeypress="return hanyaAngka(event)" value="<?php echo substr($tr->saldo_jurnal, 1) ?>">
                                                        </div>
                                                        <?php echo form_error('saldo[]') ?>
                                                    </td>
                                                <?php } ?>
                                                <td hidden>
                                                    <div class="form-group">
                                                        <input type="text" name="posisi[]" id="posisi<?php echo $no ?>" class="form-control" value="<?php echo $tr->posisi ?>">
                                                    </div>
                                                </td>
                                                <td hidden>
                                                    <div class="form-group">
                                                        <input type="text" name="saldo[]" id="saldo<?php echo $no ?>" class="form-control" value="<?php echo $tr->saldo_jurnal ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $no++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a class="btn btn-sm  text-white btn-tambah" id="tambah_baris" hidden><i class="fas fa-plus mr-1"></i>Tambah Baris</a>
                        <!-- <a class="btn btn-sm btn-danger text-white" id="test">Tambah Baris</a> -->
                        <br>
                        <div class="col-lg-6 float-right">
                            <div class="form-group row col-lg-12">
                                <label class="col-form-label col-sm-4 text-right" for="">Total Debit :</label>
                                <div class="col-sm-8">
                                    <input class="form-control uang" type="text" id="t_debit" readonly>
                                </div>
                            </div>
                            <div class="form-group row col-lg-12">
                                <label class="col-form-label col-sm-4 text-right" for="">Total Kredit :</label>
                                <div class="col-sm-8">
                                    <input class="form-control uang" type="text" id="t_kredit" readonly>
                                </div>
                            </div>
                            <div class="form-group row col-lg-12">
                                <label class="col-form-label col-sm-4 text-right" for="">Selisih :</label>
                                <div class="col-sm-8">
                                    <input class="form-control uang" type="text" id="balance" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button id="jurnal_entry" type="submit" class="btn btn-sm btn-submit btn-primary mr-2"><i class="fas fa-save mr-1"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-undo btn-danger"><i class="fas fa-undo-alt mr-1"></i> Ulang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function(){
    // 	var counter = 2;
    // 	var counterNext = parseInt(counter) + 1;
    // 	$("#tambah_baris").on("click",function(){
    // 	var html="<tr>"
    // 		+ "<td>"
    // 			+"<div class='form-group'>"
    // 				+"<select class='form-control id_akun' name='id_akun[]' id='id_akun"+counterNext+"'>"
    // 					+ "<option value=''>-- Pilih Akun --</option>"
    // 					+"<?php foreach ($coa as $c) { ?>"
    // 						+"<option value='<?php echo $c->id_akun ?>' data-no_akun='<?php echo $c->kode_akun . '-' . $c->no_akun ?>'>"
    // 							+"<?php echo $c->nama_akun ?>"
    // 						+"</option>"
    // 					+"<?php } ?>"
    // 				+"</select>"
    // 			+"</div>"
    //             +"<span><a href='javascript:void(0);' id='hapus'>Remove</a></span>"
    // 		+"</td>"
    // 		+"<td>"
    // 			+"<div class='form-group'>"
    // 				+"<input class='form-control no_akun' name='no_akun[]' id=no_akun_"+counterNext+"' type='text' readonly>"
    // 			+"</div>"
    // 		+"</td>"
    // 		+"<td>"
    // 			+"<div class='form-group'>"
    // 				+"<input type='text' name='debit[]' id='debit"+counterNext+"' class='form-control debit' onkeypress='return hanyaAngka(event)'>"
    // 			+"</div>"
    // 		+"</td>"
    // 		+"<td>"
    // 			+"<div class='form-group'>"
    // 				+"<input type='text' name='kredit[]' id='kredit"+counterNext+"' class='form-control kredit' onkeypress='return hanyaAngka(event)'>"
    // 			+"</div>"
    // 		+"</td>"
    // 		+"<td >"
    // 			+"<div class='form-group'>"
    // 				+"<input type='text' name='posisi[]' id='posisi"+counterNext+"' class='form-control' >"
    // 			+"</div>"
    // 		+"</td>"
    // 		+"<td >"
    // 			+"<div class='form-group'>"
    // 				+"<input type='text' name='saldo[]' id='saldo"+counterNext+"' class='form-control' >"
    // 			+"</div>"
    // 		+"</td>"
    // 	+"</tr>"
    // 	$("#entry tbody").append(html);
    // 	counterNext++;
    // 	});

    //     $("#entry").on('click','#hapus',function(){
    //         $(this).closest('tr').remove();
    //     });

    // });

    // 
</script>

<script>
    $(document).ready(function() {

        var t_kredit = 0;
        $('.kredit').each(function() {
            t_kredit += +$(this).val().replace(/\./g, '');
        });
        $("#t_kredit").val(t_kredit)

        var t_debit = 0;
        $('.debit').each(function() {
            t_debit += +$(this).val().replace(/\./g, '');
        });
        $("#t_debit").val(t_debit);

        var t_kredit = parseInt($("#t_kredit").val());
        var t_debit = parseInt($("#t_debit").val());
        var balance = t_debit - t_kredit;
        if (isNaN(balance)) {
            $("#balance").val("");
        } else {
            $("#balance").val(balance);
        }
    });

    function goBack() {
        window.history.go(-1);
    }

    // $(document).ready(function() {
    //     // Format mata uang.
    //     $('.uang').mask('0.000.000.000.000', {
    //         reverse: true
    //     });
    // })
</script>