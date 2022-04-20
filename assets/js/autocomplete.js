//Autocomplate form transaksi (Nama Akun & Nomor Akun) -- Form Debit
$(document).ready(function () {
    $('#nama_akun_2').autocomplete({
        source: "<?php echo base_url('Transaksi/Transaksi/get_autocomplete');?>",
        select: function (event, ui) {
            $('[id="nama_akun_2"]').val(ui.item.label);
            $('[id="id_akun_2"]').val(ui.item.id_akun);
            $('[id="no_akun_2"]').val(ui.item.no_akun);
        }
    });
});

// <!-- Autocomplate untuk form transaksi (Nama Pegawai) -- Form Kredit -->
$(document).ready(function () {
    $('#nama_pegawai').autocomplete({
        source: "<?php echo base_url('Transaksi/Transaksi/get_pegawai');?>",
        select: function (event, ui) {
            $('[id="nama_pegawai"]').val(ui.item.label);
            $('[id="id_pegawai"]').val(ui.item.id_pegawai);
        }
    });
});

$(document).ready(function () {
    // Autocomplate untuk form transaksi (Nama Pegawai) -- Form Debit
    $('#nama_pegawai_2').autocomplete({
        source: "<?php echo base_url('Transaksi/Transaksi/get_pegawai');?>",
        select: function (event, ui) {
            $('[id="nama_pegawai_2"]').val(ui.item.label);
            $('[id="id_pegawai_2"]').val(ui.item.id_pegawai);
        }
    });
});

    //Autocomplate daftar barang -- Form kredit
$(document).ready(function () {
    var akun = document.getElementById("nama_akun").value
    $('#nama_barang').autocomplete({
        source: "<?php echo base_url('Transaksi/Transaksi/get_barang');?>",
        select: function (event, ui) {
            $('[id="nama_barang"]').val(ui.item.label);
            $('[id="id_barang"]').val(ui.item.id_barang);
            if($('#nama_akun').val() == 'Pembelian'){
                $('[id="harga"]').val(ui.item.harga_beli);
            }else{
                $('[id="harga"]').val(ui.item.harga_jual);
            }
            $('[id="id_satuan"]').val(ui.item.id_satuan);
            $('[id="satuan_barang"]').val(ui.item.satuan_barang);
        }
    });
});

//Autocomplate daftar barang -- Form kredit
$(document).ready(function () {
    var akun = document.getElementById("nama_akun").value
    $('#nama_barang_2').autocomplete({
        source: "<?php echo base_url('Transaksi/Transaksi/get_barang');?>",
        select: function (event, ui) {
            $('[id="nama_barang_2"]').val(ui.item.label);
            $('[id="id_barang_2"]').val(ui.item.id_barang);
            if($('#nama_akun_2').val() == 'Pembelian'){
                $('[id="harga_2"]').val(ui.item.harga_beli);
            }else{
                $('[id="harga_2"]').val(ui.item.harga_jual);
            }
            $('[id="id_satuan_2"]').val(ui.item.id_satuan);
            $('[id="satuan_barang_2"]').val(ui.item.satuan_barang);
        }
    });
});

//Menghitung jumlah saldo Debit
$('#jumlah').keyup(function(){
    if($('#nama_akun').val() === "Penjualan" || $('#nama_akun').val() === "Pembelian" ){
        var jumlah;
        var harga;
        jumlah = parseInt($('#jumlah').val());
        harga = parseInt($('#harga').val());
        var result = jumlah * harga;
        $('#total').val(result);
        $('#total_2').val(result);
    }
});

//Menghitung jumlah saldo Kredit
$('#jumlah_2').keyup(function(){
    if($('#nama_akun_2').val() === "Penjualan" || $('#nama_akun_2').val() === "Pembelian" ){
        var jumlah;
        var harga;
        jumlah = parseInt($('#jumlah_2').val());
        harga = parseInt($('#harga_2').val());
        var result = jumlah * harga;
        $('#total').val(result);
        $('#total_2').val(result);
    }
});

//Otomatisasi penyamaan saldo
$('#total').keyup(function(){
    if($('#nama_akun_2').val() !== "Penjualan" || $('#nama_akun_2').val() !== "Pembelian" ){
        var saldo = $('#total').val();
        $('#total_2').val(saldo);
    }
});

$('#total_2').keyup(function(){
    if($('#nama_akun').val() !== "Penjualan" || $('#nama_akun').val() !== "Pembelian" ){
        var saldo = $('#total_2').val();
        $('#total').val(saldo);
    }
});