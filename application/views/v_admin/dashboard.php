<!-- <?php if ($this->fungsi->user_login()->role_id == 1) { ?>
    <p class="admin">
        Hai Admin
    </p>
<?php } else { ?>
    <p>
        Hai Pegawai
    </p>
<?php } ?> -->

<div class="container-fluid">
    <!-- Content Row -->
    <?php $this->view('flashdata') ?>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card h-100 py-2 heloUser">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-ungu text-uppercase mb-1" style="font-size: 1.3rem">
                                Halo <?php echo ($this->fungsi->user_login()->nama_user) ?> ! </div>
                            <div class=" font-weight-bold text-gray" style="font-size: 0.7rem">Semoga hari mu menyenangkan :)</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-9x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 py-2 totalAkun">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?php echo base_url('Master_data/Coa/account') ?>">
                                <div class="text-xs font-weight-bold text-pink text-uppercase mb-1" style="font-size: 0.9rem">
                                    Data Akun</div>
                                <div class="font-weight-bold text-pink"><?= $totalAkun; ?></div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x" style="color: white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 py-2 totalBarang">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?php echo base_url('Master_data/Barang/Persediaan') ?>">
                                <div class="text-xs font-weight-bold text-ungu text-uppercase mb-1" style="font-size: 0.9rem">
                                    Barang</div>
                                <div class=" font-weight-bold text-ungu"><?= $totalBarang; ?></div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x" style="color: white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 py-2 totalCustomer">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?php echo base_url('Master_data/Customer/daftarCustomer') ?>">
                                <div class="text-xs font-weight-bold text-hijau text-uppercase mb-1" style="font-size: 0.9rem">Pelanggan
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="font-weight-bold text-hijau "><?= $totalCustomer; ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x" style="color: white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card info-tosca h-100 py-2 totalSupplier">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="<?php echo base_url('Master_data/Supplier/daftarSupplier') ?>">
                                <div class="text-xs font-weight-bold text-tosca text-uppercase mb-1" style="font-size: 0.9rem">
                                    Pemasok</div>
                                <div class="h5 mb-0 font-weight-bold text-tosca"><?= $totalSupplier; ?></div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x" style="color: white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->