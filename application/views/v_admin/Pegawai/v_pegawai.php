<div class="container">
    <p class="title_halaman text-center">Daftar Pegawai</p>

    <div class="row">
        <div class="col-lg-12">
        <a class="btn btn-primary mb-4 mt-4" href="<?php echo base_url('Master_data/Pegawai/tambahPegawai')?>"><i class="fa fa-plus"></i> Tambah Pegawai</a> 
        <?php $this->view('flashdata')?>
            <div class="table-responsive">
                <table class="table dtTable table-bordered table-striped table-hover">
                    <thead>
                        <tr class="text-center text-white bg-primary">
                            <td>No.</td>
                            <td>Nama Pegawai</td>
                            <td>Alamat Pegawai</td>
                            <td>Nomor Telepon</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach ($pegawai as $peg ){?>
                            <tr class="text-center">
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $peg->nama_pegawai ?></td>
                                <td><?php echo $peg->alamat_pegawai ?></td>
                                <td><?php echo $peg->no_telp ?></td>
                                <td>
                                    <?php echo anchor('Master_data/Pegawai/editPegawai/'.$peg->id_pegawai, '<div class="btn btn-sm btn-info"><i class="fa fa-edit"></i></div>')?>
                                    <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Pegawai/deletePegawai/').$peg->id_pegawai?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>