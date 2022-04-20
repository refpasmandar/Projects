<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('Pengaturan/Perusahaan/formProfil') ?>">
                <div class="sidebar-brand-icon">
                    <?php foreach ($profil as $pr) { ?>
                        <img src="<?php echo base_url('/uploads/') . $pr->logo ?>" class="logo">
                    <?php } ?>
                </div>
                <?php foreach ($profil as $pr) { ?>
                    <div class="sidebar-brand-text mx-3" style="font-size:13px;"><?php echo $pr->nama_perusahaan ?></div>
                <?php } ?>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Seleksi Segment URL -->
            <?php $hal_ = $this->uri->segment(1); ?>
            <?php $hal = $this->uri->segment(2); ?>
            <?php $subhal = $this->uri->segment(3); ?>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($hal_ == 'Dashboard') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('Dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">
            <!-- Setting Website -->
            <div class="sidebar-heading">
                Pengaturan
            </div>
            <li class="nav-item <?= ($hal_ == 'Pengaturan') ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#setting" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
                <div id="setting" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($subhal == 'formProfil') ? 'active' : ''; ?>" href="<?php echo base_url('Pengaturan/Perusahaan/formProfil') ?>">Profil Usaha</a>
                        <a class="collapse-item <?= ($subhal == 'updateLink' || $subhal == 'formLink') ? 'active' : ''; ?>" href="<?php echo base_url('Pengaturan/Link_acc/kondisiLink') ?>">Link Account</a>
                        <a class="collapse-item <?= ($subhal == 'saldoAwal'  ||  $subhal == 'inputSaldoAwal' || $subhal == 'updateSaldoAwal' || $subhal == 'saldoLatest') ? 'active' : ''; ?>" href="<?php echo base_url('Pengaturan/Saldo_awal/kondisiSaldo') ?>">Saldo Awal</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Master Data -->
            <!-- Heading -->
            <div class="sidebar-heading">
                Data
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?= ($hal_ == 'Master_data') ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-database"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Master:</h6>
                        <a class="collapse-item <?= ($subhal == 'account' || $subhal == 'tambahAkun' || $subhal == 'editAkun') ? 'active' : ''; ?>" href="<?php echo base_url('Master_data/coa/account') ?>">Chart Of Account</a>
                        <!-- <a class="collapse-item <?= ($subhal == 'daftarPegawai' || $subhal == 'tambahPegawai' || $subhal == 'editPegawai') ? 'active' : ''; ?>" href="<?php echo base_url('Master_data/Pegawai/daftarPegawai') ?>">Pegawai</a>
                <a class="collapse-item <?= ($subhal == 'daftarPeriode' || $subhal == 'editPeriode') ? 'active' : ''; ?>" href="<?php echo base_url('Master_data/Periode/daftarPeriode') ?>">Periode</a> -->
                        <a class="collapse-item <?= ($subhal == 'daftarSupplier' || $subhal == 'tambahUtangAwal' || $subhal == 'tambahSupplier' || $subhal == 'editSupplier') ? 'active' : ''; ?>" href="<?php echo base_url('Master_data/Supplier/daftarSupplier') ?>">Pemasok</a>
                        <a class="collapse-item <?= ($subhal == 'Persediaan' || $subhal == 'tambahBarang' || $subhal == 'editBarang' || $subhal == 'satuanBeli' || $subhal == 'satuanJual' || $subhal == 'editSatuanBeli' || $subhal == 'editSatuanJual' || $subhal == 'editKategori' || $subhal == 'kategoriBarang') ? 'active' : ''; ?>" href="<?php echo base_url("Master_data/Barang/Persediaan") ?>">Barang</a>
                        <a class="collapse-item <?= ($subhal == 'daftarCustomer' || $subhal == 'tambahPiutang' || $subhal == 'tambahCustomer' || $subhal == 'editCustomer') ? 'active' : ''; ?>" href="<?php echo base_url('Master_data/Customer/daftarCustomer') ?>">Pelanggan</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Menu Transaksi -->
            <!-- Heading -->
            <div class="sidebar-heading test">
                Transaksi
            </div>

            <li class="nav-item <?= ($subhal == 'formJurnal') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('Jurnal/Jurnal_entry/formJurnal') ?>">
                    <i class="fas fa-book"></i>
                    <span>Entri Jurnal</span></a>
            </li>
            <li class="nav-item <?= ($hal == 'Pembelian') ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pembelian" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Pembelian</span>
                </a>
                <div id="pembelian" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pembelian:</h6>
                        <a class="collapse-item  <?= ($subhal == 'formPembelian') ? 'active' : ''; ?>" href="<?php echo base_url('Pembelian/Pembelian/formPembelian') ?>">Input Pembelian</a>
                        <a class="collapse-item <?= ($subhal == 'daftarPembelian' || $subhal == 'daftarSupplierLunas' || $subhal == 'daftarSupplierUtang' || $subhal == 'detailPembelian' || $subhal == 'detailTransaksiPembelian' || $subhal == 'bayarUtang' || $subhal == 'returBeli') ? 'active' : ''; ?>" href="<?php echo base_url('Pembelian/Pembelian/daftarPembelian') ?>">Daftar Pembelian</a>
                        <a class="collapse-item <?= ($subhal == 'daftarReturBeli' || $subhal == 'invoiceReturBeli' || $subhal == 'detailInvoiceReturPembelian') ? 'active' : ''; ?>" href="<?php echo base_url("Pembelian/Pembelian/daftarReturBeli") ?>">Retur Pembelian</a>
                    </div>
                </div>
            </li>
            <li class="nav-item <?= ($hal == 'Penjualan') ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#penjualan" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Penjualan</span>
                </a>
                <div id="penjualan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Penjualan:</h6>
                        <a class="collapse-item <?= ($subhal == 'formPenjualan' || $subhal == 'tambahPenjualan') ? 'active' : ''; ?>" href="<?php echo base_url('Penjualan/Penjualan/formPenjualan') ?>">Input Penjualan</a>
                        <a class="collapse-item <?= ($subhal == 'daftarPenjualan' || $subhal == 'daftarCustomerLunas' || $subhal == 'daftarCustomerPiutang' || $subhal == 'detailPenjualan' || $subhal == 'detailTransaksiPenjualan' || $subhal == 'terimaPiutang' || $subhal == 'returJual') ? 'active' : ''; ?>" href="<?php echo base_url('Penjualan/Penjualan/daftarPenjualan') ?>">Daftar Penjualan</a>
                        <a class="collapse-item <?= ($subhal == 'daftarReturJual' || $subhal == 'invoiceReturJual' || $subhal == 'detailInvoiceReturPenjualan') ? 'active' : ''; ?>" href="<?php echo base_url("Penjualan/Penjualan/daftarReturJual") ?>">Retur Penjualan</a>
                    </div>
                </div>
            </li>

            <!-- Jurnal Transaksi -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Jurnal Transaksi
            </div>

            <li class="nav-item <?= ($hal == 'Jurnal') ? 'active' : ''; ?>">
                <a href="<?php echo base_url('Laporan/Jurnal/jurnal') ?>" class="nav-link">
                    <i class="far fa-file-alt"></i>
                    <span> Jurnal</span></a>
            </li>

            <!-- Menu Laporan -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Laporan
            </div>

            <li class="nav-item <?= ($subhal == 'filterSaldo' || $subhal == 'prosesFilter') ? 'active' : ''; ?>">
                <a href="<?php echo base_url('Laporan/Riwayat_saldo/filterSaldo') ?>" class="nav-link">
                    <i class="fas fa-history"></i>
                    <span> Riwayat Saldo</span></a>
            </li>

            <li class="nav-item <?= ($hal_ == 'Laporan' && ($hal != 'Riwayat_saldo' && $hal != 'Jurnal')) ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Laporan</span>
                </a>
                <div id="laporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Jenis Laporan:</h6>
                        <!-- <a class="collapse-item <?= ($hal == 'Jurnal') ? 'active' : ''; ?>" href="<?php echo base_url('Laporan/Jurnal/jurnal') ?>">
                            Jurnal Umum
                        </a> -->
                        <a class="collapse-item <?= ($hal == 'Buku_besar') ? 'active' : ''; ?>" href="<?php echo base_url('Laporan/Buku_besar/bukuBesar') ?>">
                            Buka Besar
                        </a>
                        <a class="collapse-item <?= ($hal == 'Laba_rugi') ? 'active' : ''; ?>" href=" <?php echo base_url('Laporan/Laba_rugi/filterLabaRugi') ?>">
                            Laba/Rugi
                        </a>
                        <a class="collapse-item <?= ($hal == 'Neraca') ? 'active' : ''; ?>" href="<?php echo base_url('Laporan/Neraca/filterNeraca') ?>">
                            Neraca
                        </a>
                    </div>
                </div>
            </li>

            <li class="nav-item <?= ($hal_ == 'Closing') ? 'active' : ''; ?>">
                <a href="<?php echo base_url('Closing/filterClosing') ?>" class="nav-link">
                    <i class="fas fa-times"></i>
                    <span> Tutup Buku</span></a>
            </li>

            <!-- <li class="nav-item <?= ($subhal == 'filterSaldo' || $subhal == 'prosesFilter') ? 'active' : ''; ?>">
                <a href="<?php echo base_url('Master_data/Coa/filterSaldo') ?>" class="nav-link">
                    <i class="fas fa-wallet"></i>
                    <span> Riwayat Saldo</span></a>
            </li>

            <li class="nav-item <?= ($hal == 'Jurnal') ? 'active' : ''; ?>">
                <a href="<?php echo base_url('Laporan/Jurnal/jurnal') ?>" class="nav-link">
                    <i class="far fa-file-alt"></i>
                    <span> Jurnal Umum</span></a>
            </li>

            <li class="nav-item <?= ($hal == 'Buku_besar') ? 'active' : ''; ?>">
                <a href="<?php echo base_url('Laporan/Buku_besar/bukuBesar') ?>" class="nav-link">
                    <i class="fas fa-book"></i>
                    <span> Buka Besar</span></a>
            </li>

            <li class="nav-item <?= ($hal == 'Laba_rugi') ? 'active' : ''; ?>">
                <a href=" <?php echo base_url('Laporan/Laba_rugi/filterLabaRugi') ?>" class="nav-link">
                    <i class="fas fa-money-check-alt"></i>
                    <span> Laba/Rugi</span></a>
            </li>

            <li class="nav-item <?= ($hal == 'Perubahan_modal') ? 'active' : ''; ?>" hidden>
                <a href=" <?php echo base_url('Laporan/Perubahan_modal/perubahanModal') ?>" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span> Perubahan Modal</span></a>
            </li>

            <li class="nav-item <?= ($hal == 'Neraca') ? 'active' : ''; ?>">
                <a href="<?php echo base_url('Laporan/Neraca/filterNeraca') ?>" class="nav-link">
                    <i class="fas fa-balance-scale"></i>
                    <span> Neraca Saldo</span></a>
            </li>-->

            <hr class="sidebar-divider">

            <!-- Buka tutup (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Navbar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo ($this->fungsi->user_login()->nama_user) ?></span>
                                <i class="fas fa-user"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo base_url("Profil/profilPengguna") ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil Pengguna
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('Auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->