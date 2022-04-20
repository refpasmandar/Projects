<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pembelian</h6>
        </div>
        <div class="card-body">
            <div class="table-boostrap">
                <table id="bootstrap" class="table table-striped table-bordered">
                    <thead class="text-center bg-primary text-white">
                        <tr>
                            <th class="align-middle" rowspan="2">No</th>
                            <th class="align-middle" rowspan="2">Kode Transaksi</th>
                            <th class="align-middle" rowspan="2">Tanggal Transaksi</th>
                            <th class="align-middle" rowspan="2">Aksi</th>
                        </tr>

                    </thead>
                    <tbody class="text-center">
                        <?php
                        $i  = 1;
                        $debit = 0;
                        $kredit = 0; ?>
                        <?php foreach ($transaksi as $t) : ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td class="text-center"><?= $t->kode_jurnal; ?></td>
                                <td class="text-center"><?= $t->tanggal_transaksi; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url(); ?>Pembelian/Pembelian/returBeli/<?= str_replace(' ', '', $t->kode_jurnal) . '/' . $t->tanggal_transaksi; ?>" class="badge badge-primary">Retur</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>