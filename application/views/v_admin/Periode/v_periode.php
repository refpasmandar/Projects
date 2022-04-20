<div class="container">
    <p class="title_halaman text-center">Daftar Periode Transaksi</p>
    
    <div class="row">
        <div class="col-lg-12">
            <!-- <a href="<?php echo base_url('Master_data/Periode/tambahPeriode')?>" class="btn btn-primary mb-4"> <i class="fa fa-plus"></i> Tambah Periode</a> -->
            <form name="periode" method="post" action="<?php echo base_url('Master_data/Periode/tambahPeriode')?>">
                <div class="form-row mb-3">
                    <div class="form-group col-lg-4">
                        <label for="bulan">Periode<span class="font-italic ket_trans">(Bulan/Tanggal/Tahun)</span><span class="text-danger">*</span></label>
                        <input class="form-control" name="periode" type="date">
                        <?php echo form_error('periode') ?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="bulan">Keterangan <span class="text-danger">*</span></label>
                        <input class="form-control" name="keterangan_periode" type="text" placeholder="">
                        <?php echo form_error('keterangan_periode') ?>
                    </div>
                    <div class="form-group col-lg-2">
                    <label class="text-white" for="">aa</label>
                    <button type="submit" class="form-control btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Tambah</button>
                    </div>
                </div>
            </form>
            <?php $this->view('flashdata')?>
            <table class="table dtTable table-bordered table-striped table-hover dt-responsive">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <td>No.</td>
                        <td>Periode Transaksi</td>
                        <td>Keterangan</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        foreach($periode as $pr){ ?>
                            <tr class="text-center">
                                <td><?php echo $no++?></td>
                                <td><?php echo format_indo(date('Y-m',strtotime($pr->periode)));?></td>
                                <td><?php echo $pr->keterangan_periode?></td>
                                <td>
                                    <?php echo anchor('Master_data/Periode/tutupPeriode/'.$pr->id_periode, '<div class="btn btn-sm btn-warning  text-white"><i class="fas fa-times"></i></div>')?>
                                    <?php echo anchor('Master_data/Periode/editPeriode/'.$pr->id_periode, '<div class="btn btn-sm btn-info"><i class="fa fa-edit"></i></div>')?>
                                    <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Periode/deletePeriode/').$pr->id_periode?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>