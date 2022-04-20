<!-- Begin Page Content -->
<div class="container-fluid">
    <p class="title_halaman"><i class="fas fa-times"></i> Tutup Buku</p>
    <hr>
    <?php $this->view('flashdata') ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Periode Tutup Buku</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="<?php echo base_url('Closing/closingJurnal') ?>">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="tanggal1">Tanggal <span class="text-danger">*</span></label>
                                <input class="form-control" name="tanggal1closing" type="date">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tanggal2">Tanggal <span class="text-danger">*</span></label>
                                <input class="form-control" name="tanggal2closing" type="date">
                            </div>
                        </div>
                        <div class="text-center">
                            <label class="text-white" for="">aa</label>
                            <button type="submit" class="btn btn-primary font-weight-bold" style="width:100%;"><i class="fas fa-search"></i> Tampilkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>