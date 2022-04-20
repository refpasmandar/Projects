<div class="container-fluid">
    <p class="title_halaman text-center">Jurnal Umum</p>

    <div class="row">
        <div class="col-lg-10 mx-auto my-auto">
            <table class="table dtTable table-bordered table-striped table-hover dt-responsive">
                <thead class="bg-primary">
                    <tr class="text-center text-white">
                        <td>No.</td>
                        <td>Periode Transaksi</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($periode as $pr){ ?>
                        <tr class="text-center">
                            <td><?php echo $no++ ?></td>
                            <td><?php echo format_indo(date('Y-m',strtotime($pr->periode)));?></td>
                            <td>
                            <?php echo anchor('Laporan/Jurnal/getJurnalByPeriode/'.$pr->id_periode, 
                                '<div class="btn btn-info btn-icon-split">
                                    <span class="icon text-white">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <span class="text">
                                        Lihat Jurnal
                                    </span>
                                </div>')?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>