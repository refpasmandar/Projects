<!-- Begin Page Content -->
<div class="container-fluid">
    <p class="title_halaman"><i class="fas fa-book"></i> Buku Besar</p>
    <hr>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Periode Buku Besar</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
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
                                    <label for=""><input class="mr-2 radio" type="radio" name="filterBukuBesar" value="1" id="radio_1">Seluruh Akun</label>
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
                                        <option value="<?php echo $c->id_akun ?>" data-no_akun="<?php echo $c->kode_akun . "-" . $c->no_akun ?>">
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