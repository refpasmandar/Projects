$(document).ready(function () {
	$('.dtTable').DataTable({
		"autoWidth": false,
		"lengthMenu": [
			[10, 25, 50, 100, -1],
			[10, 25, 50, 100, "All"]
		]
	});
});

function goBack() {
	window.history.go(-1);
}

//Automatisasi Nomor Akun

function nomor() {
	var x = document.getElementById("kategori_akun").value;

	if (x == 1 || x == 10 || x == 11 || x == 13) {
		document.getElementById("kode_akun").value = "1";
	} else if (x == 2 || x == 12 || x == 14) {
		document.getElementById("kode_akun").value = "2";
	} else if (x == 3) {
		document.getElementById("kode_akun").value = "3";
	} else if (x == 4) {
		document.getElementById("kode_akun").value = "4";
	} else if (x == 5) {
		document.getElementById("kode_akun").value = "5";
	} else if (x == 6) {
		document.getElementById("kode_akun").value = "6";
	} else if (x == 8) {
		document.getElementById("kode_akun").value = "8";
	} else if (x == 9) {
		document.getElementById("kode_akun").value = "9";
	}
}

//Validation Hanya input Angka
function hanyaAngka(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		alert('Hanya menerima inputan Angka/Numeric');
		return false;
	}
	return true;
}

//Validation Hanya input Huruf
function hanyaHuruf(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (!(charCode > 31 && (charCode < 48 || charCode > 57))) {
		alert('Hanya menerima inputan Huruf/Alphabet');
		return false;
	}
	return true;
}


//Form Transaksi Kredit
$(document).ready(function () {
	if (($('#nama_akun').val() === 'Penjualan') || ($('#nama_akun').val() === 'Pembelian')) {
		$('#barang').css('display', 'block');
		$('#f_harga').css('display', 'block');
		$('#f_jumlah').css('display', 'block');
		$('#satuan').css('display', 'block');
		$('#saldo').css('display', 'block');
		$('#jenis').css('display', 'block');
		$('#keterangan').css('display', 'block');
	} else {
		$('#barang').css('display', 'none');
		$('#f_harga').css('display', 'none');
		$('#f_jumlah').css('display', 'none');
		$('#satuan').css('display', 'none');
		$('#saldo').css('display', 'none');
		$('#jenis').css('display', 'none');
		$('#keterangan').css('display', 'none');
	}
});

$(document).ready(function () {
	$('#nama_akun').on('change', function () {
		if ((this.value == 'Penjualan') || (this.value == 'Pembelian')) {
			$('#barang').show();
			$('#f_harga').show();
			$('#f_jumlah').show();
			$('#satuan').show();
			$('#saldo').show();
			$('#jenis').show();
			$('#keterangan').hide();
			$('#pegawai').hide();
		} else if (this.value == 'Beban Gaji') {
			$('#barang').hide();
			$('#f_harga').hide();
			$('#f_jumlah').hide();
			$('#satuan').hide();
			$('#pegawai').show();
			$('#saldo').show();
			$('#jenis').show();
			$('#keterangan').show();
		} else {
			$('#barang').hide();
			$('#f_harga').hide();
			$('#f_jumlah').hide();
			$('#satuan').hide();
			$('#saldo').show();
			$('#jenis').show();
			$('#keterangan').show();
			$('#pegawai').hide();
		}
	});
});

//Form Transaksi Debit
$(document).ready(function () {
	if (($('#nama_akun_2').val() === 'Penjualan') || ($('#nama_akun').val() === 'Pembelian')) {
		$('#barang_2').css('display', 'block');
		$('#f_harga_2').css('display', 'block');
		$('#f_jumlah_2').css('display', 'block');
		$('#satuan_2').css('display', 'block');
		$('#saldo_2').css('display', 'block');
		$('#jenis_2').css('display', 'block');
		$('#keterangan_2').css('display', 'block');
	} else {
		$('#barang_2').css('display', 'none');
		$('#f_harga_2').css('display', 'none');
		$('#f_jumlah_2').css('display', 'none');
		$('#satuan_2').css('display', 'none');
		$('#saldo_2').css('display', 'none');
		$('#jenis_2').css('display', 'none');
		$('#keterangan_2').css('display', 'none');
	}
});

$(document).ready(function () {
	$('#nama_akun_2').on('change', function () {
		if ((this.value == 'Penjualan') || (this.value == 'Pembelian')) {
			$('#barang_2').show();
			$('#f_harga_2').show();
			$('#f_jumlah_2').show();
			$('#satuan_2').show();
			$('#saldo_2').show();
			$('#jenis_2').show();
			$('#keterangan_2').hide();
			$('#pegawai_2').hide();
		} else if (this.value == 'Beban Gaji') {
			$('#barang_2').hide();
			$('#f_harga_2').hide();
			$('#f_jumlah_2').hide();
			$('#satuan_2').hide();
			$('#pegawai_2').show();
			$('#saldo_2').show();
			$('#jenis_2').show();
			$('#keterangan_2').show();
		} else {
			$('#barang_2').hide();
			$('#f_harga_2').hide();
			$('#f_jumlah_2').hide();
			$('#satuan_2').hide();
			$('#saldo_2').show();
			$('#jenis_2').show();
			$('#keterangan_2').show();
			$('#pegawai').hide();
		}
	});
});

// Nomor Akun otomatis
$(document).on('click', '.id_akun', function () {
	$("select[id^='id_akun']").on('change', function () {
		var selected = $(this).find('option:selected');
		var id = $(this).attr('id').split('id_akun')[1];
		$("input[id^='no_akun_" + id + "']").each(function () {
			$(this).val(selected.data('no_akun'));
		})
	})
});

// $(function(){
//     $('#id_akun1').change(function(){
//     	var selected = $(this).find('option:selected');
//     	$("#no_akun_1").val(selected.data('no_akun'));
//     }).change();
// });

// $(function(){
//     $('#id_akun2').change(function(){
//     	var selected = $(this).find('option:selected');
//     	$("#no_akun_2").val(selected.data('no_akun'));
//     }).change();
// });

//Seleksi Posisi dan Saldo

$(document).on('keyup keydown', function () {
	$("input[id^='debit'],input[id^='kredit']").on('click change', function () {
		var id = $(this).attr('id').split('debit')[1];
		var debit = $("#debit" + id).val();
		var kredit = $("#kredit" + id).val();
		// var batas = $(this).val();
            
		if (!$("#debit" + id).val() && $("#kredit" + id).val()) {
			$("#posisi" + id).val("Kredit");
			$("#saldo" + id).val("-" + kredit);
		} else if ($("#debit" + id).val() && !$("#kredit" + id).val()) {
			$("#posisi" + id).val("Debit");
			$("#saldo" + id).val(debit);
		} else if (!$("#debit" + id).val()) {
			$("#kredit" + id).val("");
			$("#posisi" + id).val("");
			$("#saldo" + id).val("");
		} else if (!$("#kredit" + id).val()) {
			$("#kredit" + id).val("");
			$("#posisi" + id).val("");
			$("#saldo" + id).val("");
		} else if ($("#debit" + id).val() && $("#kredit" + id).val()) {
			alert("Mohon hanya isi salah satu posisi saldo");
			$("#debit" + id).val("");
			$("#kredit" + id).val("");
			$("#posisi" + id).val("");
			$("#saldo" + id).val("");
			$("#t_debit").val("");
			$("#t_kredit").val("");
			$("#balance").val("");
		}
	});
	$("input[id^='debit'],input[id^='kredit']").on('click change', function () {
		var id = $(this).attr('id').split('kredit')[1];
		var debit = $("#debit" + id).val();
		var kredit = $("#kredit" + id).val();
		// var batas = $(this).val();
		if (!$("#debit" + id).val() && $("#kredit" + id).val()) {
			$("#posisi" + id).val("Kredit");
			$("#saldo" + id).val("-" + kredit);
		} else if ($("#debit" + id).val() && !$("#kredit" + id).val()) {
			$("#posisi" + id).val("Debit");
			$("#saldo" + id).val(debit);
		} else if (!$("#debit" + id).val()) {
			$("#kredit" + id).val("");
			$("#posisi" + id).val("");
			$("#saldo" + id).val("");
		} else if (!$("#kredit" + id).val()) {
			$("#kredit" + id).val("");
			$("#posisi" + id).val("");
			$("#saldo" + id).val("");
		} else if ($("#debit" + id).val() && $("#kredit" + id).val()) {
			alert("Mohon hanya isi salah satu posisi saldo");
			$("#debit" + id).val("");
			$("#kredit" + id).val("");
			$("#posisi" + id).val("");
			$("#saldo" + id).val("");
			$("#t_debit").val("");
			$("#t_kredit").val("");
			$("#balance").val("");
		}
	});
});

// Seleksi posisi dan saldo 1
// $(document).on('keyup keydown',function(){
//     $("#debit1, #kredit1").change(function(){
//         var debit = $("#debit1").val();
//         var kredit = $("#kredit1").val();
//         if(!$("#debit1").val() && $("#kredit1").val()){
//             $("#posisi1").val("Kredit");
//             $("#saldo1").val(kredit);
//         }else if($("#debit1").val() && !$("#kredit1").val()){
//             $("#posisi1").val("Debit");
//             $("#saldo1").val(debit);
//         }else if(!$("#debit1").val()){
//             $("#debit1").val("").focus();
//             $("#kredit1").val("");
//             $("#posisi1").val("");
//             $("#saldo1").val("");
//         }else if(!$("#kredit1").val()){
//             $("#debit1").val("").focus();
//             $("#kredit1").val("");
//             $("#posisi1").val("");
//             $("#saldo1").val("");
//         }else if($("#debit1").val() && $("#kredit1").val()){
//             alert("Mohon hanya isi salah satu posisi saldo");
//             $("#debit1").val("").focus();
//             $("#kredit1").val("");
//             $("#posisi1").val("");
//             $("#saldo1").val("");
// 			$("#t_debit").val("");
// 			$("#t_kredit").val("");
//         }
//     });
// });

// cek out of balance

$(document).on('keyup keydown', '.kredit', function () {
	var t_kredit = 0;
	$('.kredit').each(function () {
		t_kredit += +$(this).val();
	});
	$("#t_kredit").val(t_kredit);
});

$(document).on('keyup keydown', '.debit', function () {
	var t_debit = 0;
	$('.debit').each(function () {
		t_debit += +$(this).val();
	});
	$("#t_debit").val(t_debit);
});

$(document).on('keyup keydown', function () {
	var t_kredit = parseInt($("#t_kredit").val());
	var t_debit = parseInt($("#t_debit").val());
	var balance = t_debit - t_kredit;
	if (isNaN(balance)) {
		$("#balance").val("");
	} else {
		$("#balance").val(balance);
	}
})

$(document).ready(function () {
	$("#jurnal_entry").on("click", function () {
		var cek_balance = parseInt($("#balance").val());
		if (cek_balance != 0) {
			alert("Saldo Tidak Seimbang");
			return false;
		}
		return true;
	});
})


// $(document).ready(function(){
// 	$("#t_debit").val("Rp. "+0);
// 	$("#t_kredit").val("Rp. "+0);
// 	$("#balance").val("Rp. "+0);
// 	$("#debit1,#debit2,#debit3,#kredit1,#kredit2,#kredit3").on("keyup keydown",function(){
// 		var a = parseInt($("#kredit1").val());
// 		var b = parseInt($("#kredit2").val());
// 		var c = parseInt($("#kredit3").val());
// 		var x = parseInt($("#debit1").val());
// 		var y = parseInt($("#debit2").val());
// 		var z = parseInt($("#debit3").val());
// 		if($("#kredit1").val() && !$("#kredit2").val() && !$("#kredit3").val()){
// 			$("#t_kredit").val(a);
// 			$("#balance").val(a);
// 		}else if(!$("#kredit1").val() && $("#kredit2").val() && !$("#kredit3").val()){
// 			$("#t_kredit").val(b);
// 			$("#balance").val(b);
// 		}else if(!$("#kredit1").val() && !$("#kredit2").val() && $("#kredit3").val()){
// 			$("#t_kredit").val(c);
// 			$("#balance").val(c);
// 		}else if($("#kredit1").val() && $("#kredit2").val() && !$("#kredit3").val()){
// 			$("#t_kredit").val(a+b);
// 			$("#balance").val(a+b);
// 		}else if($("#kredit1").val() && $("#kredit2").val() && $("#kredit3").val()){
// 			$("#t_kredit").val(a+b+c);
// 			$("#balance").val(a+b+c);
// 		}else if($("#kredit1").val() && !$("#kredit2").val() && $("#kredit3").val()){
// 			$("#t_kredit").val(a+c);
// 			$("#balance").val(a+c);
// 		}else if(!$("#kredit1").val() && $("#kredit2").val() && $("#kredit3").val()){
// 			$("#t_kredit").val(b+c);
// 			$("#balance").val(b+c);
// 		}else if(!$("#kredit1").val() && !$("#kredit2").val() && !$("#kredit3").val()){
// 			$("#t_kredit").val(0);
// 			$("#balance").val(0);
// 		}

// 		if($("#debit1").val() && !$("#debit2").val() && !$("#debit3").val()){
// 			$("#t_debit").val(x);
// 			$("#balance").val(x);
// 		}else if(!$("#debit1").val() && $("#debit2").val() && !$("#debit3").val()){
// 			$("#t_debit").val(y);
// 			$("#balance").val(y);
// 		}else if(!$("#debit1").val() && !$("#debit2").val() && $("#debit3").val()){
// 			$("#t_debit").val(z);
// 			$("#balance").val(z);
// 		}else if($("#debit1").val() && $("#debit2").val() && !$("#debit3").val()){
// 			$("#t_debit").val(x+y);
// 			$("#balance").val(x+y);
// 		}else if($("#debit1").val() && !$("#debit2").val() && $("#debit3").val()){
// 			$("#t_debit").val(x+z);
// 			$("#balance").val(x+z);
// 		}else if(!$("#debit1").val() && $("#debit2").val() && $("#debit3").val()){
// 			$("#t_debit").val(y+z);
// 			$("#balance").val(y+z);
// 		}else if($("#debit1").val() && $("#debit2").val() && $("#debit3").val()){
// 			$("#t_debit").val(x+y+z);
// 			$("#balance").val(x+y+z);
// 		}else if(!$("#debit1").val() && !$("#debit2").val() && !$("#debit3").val()){
// 			$("#t_debit").val(0);
// 			$("#balance").val(0);
// 		}

// 		var tdebit = parseInt($("#t_debit").val());
// 		var tkredit = parseInt($("#t_kredit").val());
// 		if($("#debit1").val && $("#kredit2").val()){
// 			$("#balance").val(tdebit-tkredit);
// 		}else if($("#kredit1").val && $("#debit2").val()){
// 			$("#balance").val(tkredit-tdebit);
// 		}
// 	});

// 	$("#jurnal_entry").on("click",function(){
// 		var balance = parseInt($("#balance").val());

// 		if(balance != 0){
// 			alert("Saldo Tidak Seimbang");
// 			return false;
// 		}
// 		return true;
// 	});
// });

// Saldo Awal
$(document).ready(function () {
	$("input[id^='awal_debit'],input[id^='awal_kredit']").on('change', function () {
		var id = $(this).attr('id').split('debit')[1];
		var debit = $("#awal_debit" + id).val();
		var kredit = $("#awal_kredit" + id).val();
		if ($("#awal_debit" + id).val() && !$("#awal_kredit" + id).val()) {
			$("#saldo_awal" + id).val(debit);
		} else if (!$("#awal_debit" + id).val() && $("#awal_kredit" + id).val()) {
			$("#saldo_awal" + id).val("-" + kredit);
		} else if ($("#awal_debit" + id).val() && $("#awal_kredit" + id).val()) {
			alert("Mohon hanya isi salah satu posisi saldo");
			$("#awal_debit" + id).val("").focus();
			$("#awal_kredit" + id).val("");
			$("#saldo_awal" + id).val("");
		}
		// alert(id)
	});
	$("input[id^='awal_debit'],input[id^='awal_kredit']").on('change', function () {
		var id = $(this).attr('id').split('kredit')[1];
		var debit = $("#awal_debit" + id).val();
		var kredit = $("#awal_kredit" + id).val();
		if ($("#awal_debit" + id).val() && !$("#awal_kredit" + id).val()) {
			$("#saldo_awal" + id).val(debit);
		} else if (!$("#awal_debit" + id).val() && $("#awal_kredit" + id).val()) {
			$("#saldo_awal" + id).val("-" + kredit);
		} else if ($("#awal_debit" + id).val() && $("#awal_kredit" + id).val()) {
			alert("Mohon hanya isi salah satu posisi saldo");
			$("#awal_debit" + id).val("").focus();
			$("#awal_kredit" + id).val("");
			$("#saldo_awal" + id).val("");
		}
		// alert(id)
	});
});

$(document).on('keyup keydown', '.awal_kredit', function () {
	var saldo_kredit = 0;
	$('.awal_kredit').each(function () {
		saldo_kredit += +$(this).val();
	});
	$("#saldo_kredit").val(saldo_kredit)
});

$(document).on('keyup keydown', '.awal_debit', function () {
	var saldo_debit = 0;
	$('.awal_debit').each(function () {
		saldo_debit += +$(this).val();
	});
	$("#saldo_debit").val(saldo_debit);
});

$(document).on('keyup keydown', function () {
	var saldo_kredit = parseInt($("#saldo_kredit").val());
	var saldo_debit = parseInt($("#saldo_debit").val());
	var awal_balance = saldo_debit - saldo_kredit;
	if (isNaN(awal_balance)) {
		$("#awal_balance").val(0);
	} else {
		$("#awal_balance").val(awal_balance);
	}
})

// $(document).ready(function(){
// 	$("#input_saldo").on("click",function(){
// 		var cek_balance = parseInt($("#awal_balance").val());
// 		if(cek_balance != 0){
// 			alert("Saldo Tidak Seimbang");
// 			return false;
// 		}
// 			return true;
// 	});
// })

//Konversi Stok Jual

$(document).ready(function () {
	$("#nilai_konversi").on('change', function () {
		var beli = parseInt($("#stok_beli").val());
		var konversi = parseFloat($("#nilai_konversi").val());
		var stok_jual = beli * konversi;
		$("#stok_jual").val(stok_jual);
		if (isNaN(stok_jual)) {
			$("#stok_jual").val("0");
		} else {
			$("#stok_jual").val(stok_jual);
		}
	})

	$("#stok_beli").on('change', function () {
		var beli = parseInt($("#stok_beli").val());
		var konversi = parseFloat($("#nilai_konversi").val());
		var stok_jual = beli * konversi;
		$("#stok_jual").val(stok_jual);
		if (isNaN(stok_jual)) {
			$("#stok_jual").val("0");
		} else {
			$("#stok_jual").val(stok_jual);
		}
	})
})

// Form Pembelian
// Barang
$(document).on('keyup keydown click', '.id_barang', function () {
	$("select[id^='id_barang']").on('change', function () {
		var selected = $(this).find('option:selected');
		var id = $(this).attr('id').split('id_barang')[1];
		$("input[id^='no_akun_" + id + "']").each(function () {
			$(this).val(selected.data('no_akun'));
		})
		$("input[id^='kode_barang" + id + "']").each(function () {
			$(this).val(selected.data('kode_barang'));
		})
		$("input[id^='kode_pabrik" + id + "']").each(function () {
			$(this).val(selected.data('kode_pabrik'));
		})
		$("input[id^='harga_beli" + id + "']").each(function () {
			$(this).val(selected.data('harga_beli'));
		})
		$("input[id^='hpp" + id + "']").each(function () {
			$(this).val(selected.data('hpp'));
		})
		$("input[id^='satuan" + id + "']").each(function () {
			$(this).val(selected.data('satuan'));
		})

		if ($("#jenis_transaksi").val() == "Penjualan" || $("#jenis_transaksi").val() == "Piutang Awal") {
			var harga_beli = parseInt($("#harga_beli" + id).val());
			var qty = parseInt($("#qty" + id).val());
			var disc = parseInt($("#diskon" + id).val());
			var hpp = parseInt($("#hpp" + id).val());
			var t_diskon = qty * disc;
			var total = harga_beli * qty;
			var total_hpp = hpp * qty;
			var t_total = total - t_diskon
			$("#total" + id).val(t_total);
			$("#total_hpp" + id).val(total_hpp);

			if (!$('#diskon' + id).val()) {
				$("input[id^='diskon" + id + "']").each(function () {
					$(this).val("0");
				})
			}
			if (isNaN(t_total) || isNaN(total_hpp)) {
				$("#total" + id).val("");
				$("#total_hpp" + id).val("");
			} else {
				$("#total" + id).val(t_total);
				$("#total_hpp" + id).val(total_hpp);
			}
		} else {
			var harga_beli = parseInt($("#harga_beli" + id).val());
			var qty = parseInt($("#qty" + id).val());
			var disc = parseInt($("#diskon" + id).val());
			var t_diskon = qty * disc;
			var total = harga_beli * qty;
			var t_total = total - t_diskon
			$("#total" + id).val(t_total);
			if (!$('#diskon' + id).val()) {
				$("input[id^='diskon" + id + "']").each(function () {
					$(this).val("0");
				})
			}
			if (isNaN(t_total)) {
				$("#total" + id).val("");
			} else {
				$("#total" + id).val(t_total);
			}
		}
	})
});

// Halaman Retur
$(document).on('keyup keydown click change', function () {
	$("input[id^='qty_retur']").on('change click load', function () {
		var id = $(this).attr('id').split('qty_retur')[1];
		var harga_beli = parseInt($("#harga_beli" + id).val());
		var qty = parseInt($("#qty_retur" + id).val());
		var qty_beli = parseInt($("#qty_beli" + id).val());
		// var jumlah_retur = parseInt($("#jumlahRetur" + id).val());
		// var oldValue = $("#qty_retur"+id).attr("data-qty_lama");
		var disc = parseInt($("#diskon_beli" + id).val());
		var hpp = parseInt($("#hpp" + id).val());
		var t_diskon = qty * disc;
		var total = harga_beli * qty;
		var total_hpp = hpp * qty;
		var t_total = total - t_diskon
		$("#total_retur" + id).val(t_total);
		$("#total_hpp" + id).val(total_hpp);
		if (!$('#diskon_beli' + id).val()) {
				$("input[id^='diskon" + id + "']").each(function () {
					$(this).val("0");
				})
			}
		if (isNaN(t_total)) {
			$("#total_retur" + id).val("");
		} else {
			$("#total_retur" + id).val(t_total);
		}

		if (qty > qty_beli) {
			alert("Quantity Retur Tidak Boleh Lebih Dari Quantity Beli");
			$("#qty_retur" + id).val("0");
			return false;
		} else {
			return true;
		}
		// } else if (qty > oldValue) {
		// 	if ((jumlah_retur + qty) >= qty_beli) {
		// 		alert("Jumlah Barang Di Retur Telah Melebihi Pembelian");
		// 		$("#qty_retur" + id).val(oldValue);
		// 		return false;
		// 	} else if ((jumlah_retur - qty <= qty_beli)) {
		// 		return true;
		// 	}
		// } else if(qty < oldValue) {
		// 	if ((jumlah_retur - qty) >= qty_beli) {
		// 		alert("Jumlah Barang Di Retur Telah Melebihi Pembelian");
		// 		$("#qty_retur" + id).val(oldValue);
		// 		return false;
		// 	} else if ((jumlah_retur - qty <= qty_beli)) {
		// 		return true;
		// 	}
		// }
	});
});
// BACA SUB TOTAL ////

// format mata uang
// $(document).on('click change',function() {
//     // Format mata uang.
//     $('.uang').mask('0.000.000.000.000', {
//         reverse: true
// 	});
// })