<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-link"></i> Link Account</p>
    <hr>

    <?php $this->view('flashdata') ?>
    <a href="<?php echo base_url('Pengaturan/Link_acc/tambahLinkAcc') ?>" class="btn btn-primary mb-4 mt-4"> <i class="fa fa-plus"></i> Link Account</a>
    <div class="card">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Link Account <small class="text-dark">Penjualan</small></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table dtTable table-bordered table-striped table-hover dt-responsive">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <td>No.</td>
                            <td>Nomor Akun</td>
                            <td>Nama Akun</td>
                            <td>Keterangan</td>
                            <td>Jenis Transaksi</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($jual as $jl) { ?>
                            <tr class="text-center">
                                <td><?php echo $no++ ?></td>
                                <?php if ($jl->id_akun == 0) { ?>
                                    <td class="text-danger">(Akun Belum di Setting)</td>
                                    <td class="text-danger">(Akun Belum di Setting)</td>
                                <?php } else {  ?>
                                    <td><?php echo $jl->kode_akun . '-' . $jl->no_akun ?></td>
                                    <td><?php echo $jl->nama_akun ?></td>
                                <?php } ?>
                                <td><?php echo $jl->keterangan_link ?></td>
                                <td><?php echo $jl->jenis_link ?></td>
                                <td>
                                    <?php echo anchor('Pengaturan/Link_acc/formEditLink/' . $jl->id_link, '<div class="btn btn-sm btn-info"><span class="icon text-white-50"><i class="fa fa-edit"></i></span><span class="text"> Edit</span></div>') ?>
                                    <!-- <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Customer/deleteCustomer/') . $jl->id_link ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a> -->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <hr class=" mt-4 mb-4">
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Link Account <small class="text-dark">Pembelian</small></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table dtTable table-bordered table-striped table-hover dt-responsive">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <td>No.</td>
                            <td>Nomor Akun</td>
                            <td>Nama Akun</td>
                            <td>Keterangan</td>
                            <td>Jenis Transaksi</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($beli as $bl) { ?>
                            <tr class="text-center">
                                <td><?php echo $no++ ?></td>
                                <?php if ($bl->id_akun == 0) { ?>
                                    <td class="text-danger">(Akun Belum di Setting)</td>
                                    <td class="text-danger">(Akun Belum di Setting)</td>
                                <?php } else {  ?>
                                    <td><?php echo $bl->kode_akun . '-' . $bl->no_akun ?></td>
                                    <td><?php echo $bl->nama_akun ?></td>
                                <?php } ?>
                                <td><?php echo $bl->keterangan_link ?></td>
                                <td><?php echo $bl->jenis_link ?></td>
                                <td>
                                    <?php echo anchor('Pengaturan/Link_acc/formEditLink/' . $bl->id_link, '<div class="btn btn-sm btn-info"><span class="icon text-white-50"><i class="fa fa-edit"></i></span><span class="text"> Edit</span></div>') ?>
                                    <!-- <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Customer/deleteCustomer/') . $jl->id_link ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a> -->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr class=" mt-4 mb-4">

    <div class="card mb-4">
        <div class="card-header">
            <h6 class="text-primary font-weight-bold">Link Account <small class="text-dark">Modal</small></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table dtTable table-bordered table-striped table-hover dt-responsive">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <td>No.</td>
                            <td>Nomor Akun</td>
                            <td>Nama Akun</td>
                            <td>Keterangan</td>
                            <td>Jenis Transaksi</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($modal as $md) { ?>
                            <tr class="text-center">
                                <td><?php echo $no++ ?></td>
                                <?php if ($md->id_akun == 0) { ?>
                                    <td class="text-danger">(Akun Belum di Setting)</td>
                                    <td class="text-danger">(Akun Belum di Setting)</td>
                                <?php } else {  ?>
                                    <td><?php echo $md->kode_akun . '-' . $md->no_akun ?></td>
                                    <td><?php echo $md->nama_akun ?></td>
                                <?php } ?>
                                <td><?php echo $md->keterangan_link ?></td>
                                <td><?php echo $md->jenis_link ?></td>
                                <td>
                                    <?php echo anchor('Pengaturan/Link_acc/formEditLink/' . $md->id_link, '<div class="btn btn-sm btn-info"><span class="icon text-white-50"><i class="fa fa-edit"></i></span><span class="text"> Edit</span></div>') ?>
                                    <!-- <a onclick="return confirm ('Anda Yakin Ingin Menghapus Data ?')" href="<?php echo base_url('Master_data/Customer/deleteCustomer/') . $jl->id_link ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a> -->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>