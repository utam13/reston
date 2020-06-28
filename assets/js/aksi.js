if (window.matchMedia("(orientation: portrait)").matches) {
	alert("Tampilan akan lebih baik dalam posisi landscape \nSilakan aktifkan rotasi layar Anda dan ubah posisi layar menjadi Landscape");
}

function formatNumber(num) {
	return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

//lihat password
function lihatpassword() {
	var x = document.getElementById("password");
	if (x.type === "password") {
		x.type = "text";
		$("#iconlihat").removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	} else {
		x.type = "password";
		$("#iconlihat").removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}
}

//tampilkan loading indikator
function showloading() {
	$("#dvloading").css("display", "block");
}

//pesan proses input edit masih aktif
function pesanprosesdata() {
	alert("Anda masih dalam proses penginputan/perubahan data\nSelesaikan proses tersebut dengan mengklik tombol Simpan/Selesai/Batal (untuk membatalkan penginputan)");
}

/*----------------------------upload file---------------------------------*/
function upload_foto() {
	$("#pilih_foto").click();
}

function upload_ttd() {
	$("#pilih_ttd").click();
}

function upload(kelompok) {
	$("#kelompok_berkas").val(kelompok);
	$("#berkas").click();
}

$('#pilih_foto').change(function () {
	if (this.files[0] != "") {
		if (this.files[0].size > 6000000) {
			alert("Ukuran file melebihi 6 Mb!");
		} else {
			//$("#savebtn").hide();
			$("#progress_div_foto").show();
			$("#progress_bar_foto").attr("aria-valuenow", 0);

			var nama_file = $("#nama_file_foto").val();
			var lokasi = $("#lokasi").val();
			var target_proses = lokasi + "pegawai/upload/" + nama_file;

			var formdata = new FormData();
			formdata.append("berkas", this.files[0]);
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandlerFoto, false);
			ajax.addEventListener("load", completeHandlerFoto, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			ajax.open("POST", target_proses);
			ajax.send(formdata);
		};
	}
})

$('#pilih_ttd').change(function () {
	if (this.files[0] != "") {
		if (this.files[0].size > 6000000) {
			alert("Ukuran file melebihi 6 Mb!");
		} else {
			//$("#savebtn").hide();
			$("#progress_div_ttd").show();
			$("#progress_bar_ttd").attr("aria-valuenow", 0);

			var nama_file = $("#nama_file_ttd").val();
			var lokasi = $("#lokasi").val();
			var target_proses = lokasi + "pegawai/upload/" + nama_file;

			var formdata = new FormData();
			formdata.append("berkas", this.files[0]);
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandlerTtd, false);
			ajax.addEventListener("load", completeHandlerTtd, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			ajax.open("POST", target_proses);
			ajax.send(formdata);
		};
	}
})

$('#berkas').change(function () {
	if (this.files[0] != "") {
		if (this.files[0].size > 6000000) {
			alert("Ukuran file melebihi 6 Mb!");
		} else {
			//$("#progress_div").show();
			//$("#progress_bar").attr("aria-valuenow", 0);
			$("#dvloading").show();

			var lokasi = $("#lokasi").val();
			var kelompok = $("#kelompok_berkas").val();
			switch (kelompok) {
				case "1":
					var nama_file = $("#nama_berkas1").val();
					break;
				case "2":
					var nama_file = $("#nama_berkas2").val();
					break;
				case "3":
					var nama_file = $("#nama_berkas3").val();
					break;
				case "4":
					var nama_file = $("#nama_berkas_lap").val();
					break;
				case "5":
					var nama_file = $("#nama_berkas_pergi").val();
					break;
				case "6":
					var nama_file = $("#nama_berkas_pulang").val();
					break;
				case "7":
					var nama_file = $("#nama_berkas_penginapan").val();
					break;
				case "8":
					var nama_file = $("#nama_berkas_bagasi").val();
					break;
			}
			var target_proses = lokasi + "sppd/upload/" + kelompok + "/" + nama_file;

			var formdata = new FormData();
			formdata.append("berkas", this.files[0]);
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandlerBerkas, false);
			ajax.addEventListener("load", completeHandlerBerkas, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			ajax.open("POST", target_proses);
			ajax.send(formdata);
		};
	}
})

function progressHandlerFoto(event) {
	var percent = (event.loaded / event.total) * 100;
	$("#progress_bar_foto").css("width", Math.round(percent) + "%");
}

function progressHandlerTtd(event) {
	var percent = (event.loaded / event.total) * 100;
	$("#progress_bar_ttd").css("width", Math.round(percent) + "%");
}

function progressHandlerBerkas(event) {
	//var percent = (event.loaded / event.total) * 100;
	//$("#progress_bar").css("width", Math.round(percent) + "%");

	$("#dvloading").show();
}

function errorHandler(event) {
	alert("Upload Failed");
}

function abortHandler(event) {
	alert("Upload Aborted");
}

function completeHandlerFoto(event) {
	var nama_file = event.target.responseText;
	var lokasi = $("#lokasi").val();
	var berkas = lokasi + "upload/pegawai/" + nama_file + "?" + Math.random();

	if (nama_file == "gagal") {
		$("#progress_div_foto").hide();

		alert("Gagal upload file, silakan coba upload file dengan format atau ukuran yang berbeda");
	} else {
		$("#progress_div_foto").hide();
		$("#nama_file_foto").val(nama_file);
		$("#foto").attr("src", berkas);
	}
}

function completeHandlerTtd(event) {
	var nama_file = event.target.responseText;
	var lokasi = $("#lokasi").val();
	var berkas = lokasi + "upload/pegawai/" + nama_file + "?" + Math.random();

	if (nama_file == "gagal") {
		$("#progress_div_ttd").hide();

		alert("Gagal upload file, silakan coba upload file dengan format atau ukuran yang berbeda");
	} else {
		$("#progress_div_ttd").hide();
		$("#nama_file_ttd").val(nama_file);
		$("#ttd").attr("src", berkas);
	}
}

function completeHandlerBerkas(event) {
	var nama_file = event.target.responseText;
	var lokasi = $("#lokasi").val();
	var kelompok = $("#kelompok_berkas").val();
	switch (kelompok) {
		case "1":
		case "2":
		case "3":
		case "4":
			var folder_lokasi = "upload/pelaporan/";
			break;
		case "5":
		case "6":
		case "7":
		case "8":
			var folder_lokasi = "upload/bukti/";
			break;
	}
	var berkas = lokasi + folder_lokasi + nama_file + "?" + Math.random();

	if (nama_file == "gagal") {
		//("#progress_div").hide();
		$("#dvloading").hide();

		alert("Gagal upload file, silakan coba upload file dengan format atau ukuran yang berbeda");
	} else {
		//$("#progress_div").hide();
		$("#dvloading").hide();

		switch (kelompok) {
			case "1":
				$("#nama_berkas1").val(nama_file);
				$("#berkas1").attr("src", berkas);
				$("#berkas1").attr("onclick", "previewberkas('" + berkas + "'," + 1 + ")");
				break;
			case "2":
				$("#nama_berkas2").val(nama_file);
				$("#berkas2").attr("src", berkas);
				$("#berkas2").attr("onclick", "previewberkas('" + berkas + "'," + 2 + ")");
				break;
			case "3":
				$("#nama_berkas3").val(nama_file);
				$("#berkas3").attr("src", berkas);
				$("#berkas3").attr("onclick", "previewberkas('" + berkas + "'," + 3 + ")");
				break;
			case "4":
				$("#nama_berkas_lap").val(nama_file);
				$("#berkas_laporan").attr("src", berkas);
				$("#berkas_laporan").attr("onclick", "previewberkas('" + berkas + "'," + 4 + ")");
				break;
			case "5":
				$("#nama_berkas_pergi").val(nama_file);
				$("#berkas_pergi").attr("src", berkas);
				$("#berkas_pergi").attr("onclick", "previewberkas('" + berkas + "'," + 5 + ")");
				break;
			case "6":
				$("#nama_berkas_pulang").val(nama_file);
				$("#berkas_pulang").attr("src", berkas);
				$("#berkas_pulang").attr("onclick", "previewberkas('" + berkas + "'," + 6 + ")");
				break;
			case "7":
				$("#nama_berkas_penginapan").val(nama_file);
				$("#berkas_penginapan").attr("src", berkas);
				$("#berkas_penginapan").attr("onclick", "previewberkas('" + berkas + "'," + 7 + ")");
				break;
			case "8":
				$("#nama_berkas_bagasi").val(nama_file);
				$("#berkas_bagasi").attr("src", berkas);
				$("#berkas_bagasi").attr("onclick", "previewberkas('" + berkas + "'," + 8 + ")");
				break;
		}
	}
}

function preview(url) {
	$("#preview").attr("src", url);
	$("#preview_newtab").attr("href", url);
	$("#preview-gambar").modal('show');
}

function previewberkas(url, kelompok) {
	switch (kelompok) {
		case 1:
		case 2:
		case 3:
			$("#preview-gambarLabel").html("Berkas SPPD");
			break;
		case 4:
			$("#preview-gambarLabel").html("Berkas Laporan");
			break;
		case 5:
			$("#preview-gambarLabel").html("Berkas Bukti Tiket Pergi");
			break;
		case 6:
			$("#preview-gambarLabel").html("Berkas Bukti Tiket Pulang");
			break;
		case 7:
			$("#preview-gambarLabel").html("Berkas Bukti Penginapan");
			break;
		case 8:
			$("#preview-gambarLabel").html("Berkas Bukti Bagasi");
			break;
	}
	$("#uploadbaru").attr("onclick", "upload(" + kelompok + ")");
	$("#preview").attr("src", url);
	$("#preview_newtab").attr("href", url);
	$("#preview-gambar").modal('show');
}

/*-----------------------------------------------------end----------------------------------*/

/*--------------------pegawai------------------------------------------------------------------*/
$("#persno").change(function () {
	var persno_lama = $("#persno_lama").val();
	var persno = $(this).val();
	var email = $("#email").val();
	var lokasi = $("#lokasi").val();

	if (persno_lama != persno) {
		var url = lokasi + "pegawai/cek_persno/" + persno;
		$.getJSON(url, function (result) {
			console.log(result);
			$.each(result, function (i, field) {
				if (field.jml != 0) {
					$("#persno").val("");
					$("#persno_error").show();
					$("#persno_error").html("Pers. No " + persno + " sudah terdaftar");
					$("#div_persno").addClass("has-error");
					persno = "";
				} else {
					$("#persno_error").hide();
					$("#div_persno").removeClass("has-error");
				}
			});
		});
	} else {
		$("#persno_error").hide();
		$("#div_persno").removeClass("has-error");
	}

	if (persno != "" && email != "") {
		$("#savebtn").attr("type", "submit");
		$("#savebtn").removeClass("btn-danger");
		$("#savebtn").addClass("btn-primary");
	} else {
		$("#savebtn").attr("type", "button");
		$("#savebtn").removeClass("btn-primary");
		$("#savebtn").addClass("btn-danger");
	}
})

$("#email").change(function () {
	var persno = $("#persno").val();
	var email_lama = $("#email_lama").val();
	var email = $(this).val();
	var lokasi = $("#lokasi").val();

	if (email_lama != email) {
		var url = lokasi + "pegawai/cek_email/" + email;
		$.getJSON(url, function (result) {
			console.log(result);
			$.each(result, function (i, field) {
				if (field.jml != 0) {
					$("#email").val("");
					$("#email_error").show();
					$("#email_error").html("Email " + email + " sudah terdaftar");
					$("#div_email").addClass("has-error");
					email = "";
				} else {
					$("#email_error").hide();
					$("#div_email").removeClass("has-error");
				}
			});
		});
	} else {
		$("#email_error").hide();
		$("#div_email").removeClass("has-error");
	}

	if (persno != "" && email != "") {
		$("#savebtn").attr("type", "submit");
		$("#savebtn").removeClass("btn-danger");
		$("#savebtn").addClass("btn-primary");
	} else {
		$("#savebtn").attr("type", "button");
		$("#savebtn").removeClass("btn-primary");
		$("#savebtn").addClass("btn-danger");
	}
})

$("#berkas_bayar").click(function () {
	window.open(this.src);
})
/*-------------------end-----------------------------------------------------------------------*/


/*---------------------------pelaporan--------------------------------------------------------*/
$(document).ready(function () {
	var lokasi = $("#lokasi").val();
	// Toolbar extra buttons
	var btnFinish = $('<button></button>').text('Selesai')
		.attr('type', 'submit')
		.attr('id', 'btn-finish')
		.addClass('btn btn-info')
		.on('click', function () {

		});
	var btnCancel = $('<a></a>').text('Batal')
		.attr('href', lokasi + "sppd")
		.addClass('btn btn-danger');
	/*
	.on('click', function () {
		$('#smartwizard').smartWizard("reset");
	});*/



	// Smart Wizard
	$('#smartwizard').smartWizard({
		selected: 0,
		theme: 'dots',
		transitionEffect: 'fade',
		toolbarSettings: {
			toolbarPosition: 'bottom',
			toolbarExtraButtons: [btnFinish, btnCancel]
		},
		anchorSettings: {
			markDoneStep: true, // add done css
			markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
			removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
			enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
		}
	});

	$('#smartwizard2').smartWizard({
		selected: 0,
		theme: 'dots',
		transitionEffect: 'fade',
		toolbarSettings: {
			toolbarPosition: 'bottom',
			//toolbarExtraButtons: [btnFinish, btnCancel]
		},
		anchorSettings: {
			markDoneStep: true, // add done css
			markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
			removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
			enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
		}
	});

	$("#btn-finish").addClass('disabled');
	$("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
		//alert("You are on step "+stepNumber+" now");
		if (stepPosition == 'first') {
			$("#prev-btn").addClass('disabled');
			$("#btn-finish").addClass('disabled');
		} else if (stepPosition == 'final') {
			$("#next-btn").addClass('disabled');
			$("#btn-finish").removeClass('disabled');
		} else {
			$("#prev-btn").removeClass('disabled');
			$("#next-btn").removeClass('disabled');
			$("#btn-finish").addClass('disabled');
		}
	});

	$("#smartwizard2").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
		//alert("You are on step "+stepNumber+" now");
		if (stepPosition == 'first') {
			$("#prev-btn").addClass('disabled');
		} else if (stepPosition == 'final') {
			$("#next-btn").addClass('disabled');
		} else {
			$("#prev-btn").removeClass('disabled');
			$("#next-btn").removeClass('disabled');
		}
	});
});

$("#trip_no").change(function () {
	var tripno_lama = $("#tripno_lama").val();
	var tripno = $(this).val();
	var email = $("#email").val();
	var lokasi = $("#lokasi").val();

	if (tripno_lama != tripno) {
		var url = lokasi + "sppd/cek_tripno/" + tripno;
		$.getJSON(url, function (result) {
			console.log(result);
			$.each(result, function (i, field) {
				if (field.jml != 0) {
					$("#trip_no").val("");
					$("#tripno_error").show();
					$("#tripno_error").html("Trip Number " + tripno + " sudah terdaftar");
					$("#div_tripno").addClass("has-error");
					persno = "";
				} else {
					$("#tripno_error").hide();
					$("#div_tripno").removeClass("has-error");
				}
			});
		});
	} else {
		$("#tripno_error").hide();
		$("#div_tripno").removeClass("has-error");
	}
})

function daftar_pegawai(kelompok) {
	var lokasi = $("#lokasi").val();
	$("#frame_daftar_pegawai").attr("src", lokasi + "sppd/daftar_pegawai/" + kelompok);
}

function total_biaya() {
	var nominal_pergi = $("#nominal_pergi").val();
	var nominal_pulang = $("#nominal_pulang").val();
	var nominal_penginapan = $("#nominal_penginapan").val();
	var nominal_bagasi = $("#nominal_bagasi").val();

	var total = parseInt(nominal_pergi) + parseInt(nominal_pulang) + parseInt(nominal_penginapan) + parseInt(nominal_bagasi);

	$("#total_biaya").val(total);
	$("#table_total_biaya").html(total);
}

$("#trip_no").change(function () {
	var trip_no = $(this).val();
	$("#table_trip_no").html(trip_no);
})

$("#dari").change(function () {
	var dari = $(this).val();
	$("#table_dari").html(dari);
})

$("#ke").change(function () {
	var ke = $(this).val();
	$("#table_ke").html(ke);
})

$("#tgl_berangkat").change(function () {
	var tgl_berangkat = $(this).val();
	var date = new Date(tgl_berangkat);
	var curr_date = date.getDate();
	var curr_month = date.getMonth();
	var curr_year = date.getFullYear();
	$("#table_tgl_berangkat").html(curr_date + "-" + curr_month + "-" + curr_year);
})

$("#tgl_pulang").change(function () {
	var tgl_pulang = $(this).val();
	var date = new Date(tgl_pulang);
	var curr_date = date.getDate();
	var curr_month = date.getMonth();
	var curr_year = date.getFullYear();
	$("#table_tgl_pulang").html(curr_date + "-" + curr_month + "-" + curr_year);
})

$("#maksud").change(function () {
	var maksud = $(this).val();
	$("#table_maksud").html(maksud);
})

$("#isilap").change(function () {
	var isilap = $(this).val();
	$("#table_lap_singkat").html(isilap);
})

$("#nominal_pergi").change(function () {
	var nominal_pergi = $(this).val();
	var nominal_pulang = $("#nominal_pulang").val();
	$("#table_nominal_transport").html(nominal_pergi + "<br>" + nominal_pulang);

	total_biaya();
})

$("#nominal_pulang").change(function () {
	var nominal_pulang = $(this).val();
	var nominal_pergi = $("#nominal_pergi").val();
	$("#table_nominal_transport").html(nominal_pergi + "<br>" + nominal_pulang);

	total_biaya();
})

$("#nama_penginapan").change(function () {
	var nama_penginapan = $(this).val();
	$("#table_nama_penginapan").html(nama_penginapan);
})

$("#nominal_penginapan").change(function () {
	var nominal_penginapan = $(this).val();
	$("#table_nominal_penginapan").html(nominal_penginapan);

	total_biaya();
})

$("#nominal_bagasi").change(function () {
	var nominal_bagasi = $(this).val();
	$("#table_nominal_bagasi").html(nominal_bagasi);

	total_biaya();
})

$("#total_biaya").change(function () {
	var total_biaya = $(this).val();
	$("#table_total_biaya").html(total_biaya);
})

$("#catatan").change(function () {
	var catatan = $(this).val();
	$("#table_catatan").html(catatan);
})

function approval(trip_no, url1, url2) {
	$("#nomor_trip").html(trip_no);
	$("#btn-approved").attr("href", url1);
	$("#btn-rejected").attr("href", url2);
}

$("#kategori_lap_sppd").change(function () {
	var kategori = $(this).val();

	$("#cari").hide();
	$("#cari_approval").hide();
	$("#cari_proses").hide();

	$("#cari").removeAttr("required");
	$("#cari_approval").removeAttr("required");
	$("#cari_proses").removeAttr("required");

	switch (kategori) {
		case "a.approve":
			$("#cari_approval").show();
			$("#cari_approval").attr("required", true);
			break;
		case "a.selesai":
			$("#cari_proses").show();
			$("#cari_proses").attr("required", true);
			break;
		default:
			$("#cari").show();
			$("#cari").attr("required", true);
			break;
	}
})
/*-------------------end-----------------------------------------------------------------------*/

//setting bidang ---------------------------------------------------------------------------------
function ambil_bidang(a, nama) {
	$("#frm_bidang").attr("action", a);

	$("#bidang_awal").val(nama);
	$("#nama_bidang").val(nama);
}

$('#form_bidang').on('shown.bs.modal', function () {
	$('#nama_bidang').focus();
})

$('#nama_bidang').change(function () {
	var value = $(this).val();

	if (value.indexOf('\'') >= 0 || value.indexOf('"') >= 0) {
		alert("Nama bidang TIDAK BOLEH ada tanda petik ganda atau pun petik tunggal");
		$('#nama_bidang').val("");
		$('#nama_bidang').focus();
	}
});
/*---------------------end--------------------------------------------------------------------*/

//setting area ---------------------------------------------------------------------------------
function ambil_area(a, nama) {
	$("#frm_area").attr("action", a);

	$("#area_awal").val(nama);
	$("#nama_area").val(nama);
}

$('#form_area').on('shown.bs.modal', function () {
	$('#nama_area').focus();
})

$('#nama_area').change(function () {
	var value = $(this).val();

	if (value.indexOf('\'') >= 0 || value.indexOf('"') >= 0) {
		alert("Nama area TIDAK BOLEH ada tanda petik ganda atau pun petik tunggal");
		$('#nama_area').val("");
		$('#nama_area').focus();
	}
});
/*---------------------end--------------------------------------------------------------------*/


//setting unit ---------------------------------------------------------------------------------
function ambil_unit(a, nama) {
	$("#frm_unit").attr("action", a);

	$("#unit_awal").val(nama);
	$("#nama_unit").val(nama);
}

$('#form_unit').on('shown.bs.modal', function () {
	$('#nama_unit').focus();
})

$('#nama_unit').change(function () {
	var value = $(this).val();

	if (value.indexOf('\'') >= 0 || value.indexOf('"') >= 0) {
		alert("Nama unit TIDAK BOLEH ada tanda petik ganda atau pun petik tunggal");
		$('#nama_unit').val("");
		$('#nama_unit').focus();
	}
});
/*---------------------end--------------------------------------------------------------------*/

//setting jabatan----------------------------------------------------------------------
function ambil_jabatan(a, nama, approval) {
	$("#frm_jabatan").attr("action", a);

	$("#jabatan_awal").val(nama);
	$("#nama_jabatan").val(nama);
	$("#approval").val(approval);
}

$('#form_bank').on('shown.bs.modal', function () {
	$('#nama_jabatan').focus();
})

$('#nama_jabatan').change(function () {
	var value = $(this).val();

	if (value.indexOf('\'') >= 0 || value.indexOf('"') >= 0) {
		alert("Nama barang TIDAK BOLEH ada tanda petik ganda atau pun petik tunggal");
		$('#nama_jabatan').val("");
		$('#nama_jabatan').focus();
	}
});
/*--------------------------------------end--------------------------------------------*/

/*----------------------------------Laporan--------------------------------------------*/
$("#kelompok_laporan").change(function () {
	var kelompok_laporan = $(this).val();

	$("#hasil").find('option').remove();

	switch (kelompok_laporan) {
		case "3":
			$("#hasil").append('<option value="3">ZIP Download</option>');
			break;
		default:
			$("#hasil").append('<option value="1">Web Cetak</option>');
			$("#hasil").append('<option value="2">Excel</option>');
			break;
	}
})

$("#status").change(function () {
	var status = $(this).val();

	$("#approval").find('option').remove();
	$("#approval").append('<option value="">Semua</option>');

	switch (status) {
		case "0":
			$("#cap_dari").html("Tanggal Pelaporan Dari");
			$("#cap_sampai").html("Tanggal Pelaporan Sampai");
			$("#approval").append('<option value="0">Belum Di Approve</option>');
			$("#approval").append('<option value="1">Approved</option>');
			$("#approval").append('<option value="2">Rejected</option>');
			break;
		case "1":
			$("#cap_dari").html("Tanggal Selesai Dari");
			$("#cap_sampai").html("Tanggal Selesai Sampai");
			break;
	}
})
/*------------------------------------end----------------------------------------------*/
