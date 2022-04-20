<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-people-carry"></i> Daftar Pemasok</p>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo base_url('Master_data/Supplier/tambahSupplier') ?>" class="btn btn-primary mb-4"> <i class="fa fa-plus"></i> Tambah Pemasok</a>
            <?php
            $query = $this->db->query("SELECT nama_akun, COALESCE(b.saldo_awal - c.totalUtang,0) as batasUtang,COALESCE(c.totalUtang,0) as totalUtang,b.saldo_awal from tb_akun a 
            join (select id_akun,saldo_awal from tb_saldo where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang') and periode_saldo = (select distinct min(periode_saldo) from tb_saldo)) b on b.id_akun = a.id_akun 
            left join (select id_akun,sum(saldo_jurnal) AS totalUtang from tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Utang') and jenis_transaksi = 'Utang Awal') c on c.id_akun = a.id_akun")->row_array();
            ?>
            <?php if ($query['totalUtang'] != $query['saldo_awal']) { ?>
                <a href="<?php echo base_url('Master_data/Supplier/tambahUtangAwal') ?>" class="btn btn-info mb-4"> <i class="fa fa-plus"></i> Utang Awal</a>
            <?php } ?>
            <?php $this->view('flashdata') ?>
            <div class="table-responsive">
                <table class="table dtTable table-bordered table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <td>No.</td>
                            <td>Kode Pemasok</td>
                            <td>Nama Pemasok</td>
                            <td>No. Telp</td>
                            <td>Alamat</td>
                            <td>E-mail</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($supp as $sp) { ?>
                            <tr class="text-center">
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $sp->kode_supplier ?></td>
                                <td><?php echo $sp->nama_supplier ?></td>
                                <td><?php echo $sp->telp_supplier ?></td>
                                <td><?php echo $sp->alamat_supplier ?></td>
                                <td><?php echo $sp->email_supplier ?></td>
                                <td>
                                    <?php echo anchor('Master_data/Supplier/editSupplier/' . $sp->id_supplier, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                    <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Supplier/deleteSupplier/') . $sp->id_supplier ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash mr-1"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>