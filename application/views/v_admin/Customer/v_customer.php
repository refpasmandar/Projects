<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-people-carry"></i> Daftar Pelanggan</p>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo base_url('Master_data/Customer/tambahCustomer') ?>" class="btn btn-primary mb-4"> <i class="fa fa-plus"></i> Tambah Pelanggan</a>
            <?php
            $query = $this->db->query("SELECT nama_akun, COALESCE(b.saldo_awal - c.totalPiutang,0) as batasPiutang,COALESCE(b.saldo_awal,0) as saldoAwal,COALESCE(c.totalPiutang,0) as totalPiutang from tb_akun a join (select id_akun,saldo_awal from tb_saldo where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Piutang') and periode_saldo = (select DISTINCT min(periode_saldo) from tb_saldo)) b on b.id_akun = a.id_akun left join (select id_akun,sum(saldo_jurnal) AS totalPiutang from tb_jurnal where id_akun = (select id_akun from tb_linkacc where keterangan_link = 'Akun Piutang') and jenis_transaksi = 'Piutang Awal') c on c.id_akun = a.id_akun")->row_array();
            ?>
            <?php if ($query['totalPiutang'] != $query['saldoAwal']) { ?>
                <a href="<?php echo base_url('Master_data/Customer/tambahPiutang') ?>" class="btn btn-info mb-4"> <i class="fa fa-plus"></i> Piutang Awal</a>
            <?php } ?>
            <?php $this->view('flashdata') ?>
            <div class="table-responsive">
                <table class="table dtTable table-bordered table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <td>No.</td>
                            <td>Kode Pelanggan</td>
                            <td>Nama Pelanggan</td>
                            <td>No. Telp</td>
                            <td>Alamat</td>
                            <td>E-mail</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($cust as $ct) { ?>
                            <tr class="text-center">
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $ct->kode_customer ?></td>
                                <td><?php echo $ct->nama_customer ?></td>
                                <td><?php echo $ct->telp_customer ?></td>
                                <td><?php echo $ct->alamat_customer ?></td>
                                <td><?php echo $ct->email_customer ?></td>
                                <td>
                                    <?php echo anchor('Master_data/Customer/editCustomer/' . $ct->id_customer, '<div class="btn btn-sm btn-info"><i class="fa fa-edit mr-1"></i> Edit</div>') ?>
                                    <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Customer/deleteCustomer/') . $ct->id_customer ?>" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>