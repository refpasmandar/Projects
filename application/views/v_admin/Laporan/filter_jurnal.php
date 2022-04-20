<div class="container-fluid">
    <p class="title_halaman"><i class="far fa-file-alt"></i> Jurnal Umum</p>
    <hr>
    <?php $this->view('flashdata') ?>
    <div class="card">
        <div class="card-header">
            <h6 class="font-weight-bold text-primary">Periode Jurnal</h6>
        </div>
        <div class="card-body">
            <form method="get" action="<?php echo base_url('Laporan/Jurnal/filterJurnal') ?>">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="tanggal1">Tanggal<span class="text-danger"> *</span></label>
                        <input class="form-control" name="tanggal1" type="date" value="<?php echo set_value('tanggal1') ?>">
                        <!-- <?php echo form_error('tanggal1') ?> -->
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="tanggal2">Tanggal<span class="text-danger"> *</span></label>
                        <input class="form-control" name="tanggal2" type="date" value="<?php echo set_value('tanggal2') ?>">
                        <!-- <?php echo form_error('tanggal2') ?> -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-white" for="">aa</label>
                    <button type="submit" class="form-control btn btn-sm btn-primary" style="width:100%;"><i class=" fas fa-search"></i> Tampilkan</button>
                </div>
            </form>
        </div>
    </div>
</div>