<div class="container-fluid">
    <p class="title_halaman text-dark"><i class="fas fa-exchange-alt"></i> Retur Penjualan</p>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <?php $this->view('flashdata') ?>
            <div class="card">
                <div class="card-header">
                    <h6 class="text-primary font-weight-bold">Nama Pelanggan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="bootstrap" class="table table-striped table-bordered">
                            <thead class="text-white bg-primary text-center">
                                <tr>
                                    <td class="align-middle" rowspan="2">No</td>
                                    <td class="align-middle" rowspan="2">Nama Pelanggan</td>
                                    <td class="align-middle" rowspan="2">Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no  = 1;
                                ?>
                                <?php foreach ($customer as $cust) : ?>
                                    <tr class="text-center">
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $cust->nama_customer ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?php echo base_url('Penjualan/Penjualan/invoiceReturJual/' . $cust->id_customer) ?>"><button class="btn-info btn btn-sm" type="submit"><i class="fas fa-file-invoice"></i> Invoice</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>