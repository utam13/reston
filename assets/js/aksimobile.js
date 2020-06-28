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
var fileReader = new FileReader();
var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

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
		if (this.files[0].size >= 6000000) {
			alert("Ukuran file melebihi 6 Mb!");
		} else {

			$("#progress_div_foto").show();
			$("#progress_bar_foto").attr("aria-valuenow", 0);

			var nama_file = $("#nama_file_foto").val();
			var lokasi = $("#lokasi").val();
			var target_proses = lokasi + "mobileprofil/upload/" + nama_file;

			var formdata = new FormData();
			formdata.append("berkas", this.files[0]);
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandlerFoto, false);
			ajax.addEventListener("load", completeHandlerFoto, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			ajax.open("POST", target_proses);
			ajax.send(formdata);


			alert("Klik tombol update untuk mengupdate data Anda");
		}
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
			var target_proses = lokasi + "mobileprofil/upload/" + nama_file;

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
			$("#progress_div").show();
			$("#progress_bar").attr("aria-valuenow", 0);

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
			var target_proses = lokasi + "mobilesppd/upload/" + kelompok + "/" + nama_file;

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
	var percent = (event.loaded / event.total) * 100;
	$("#progress_bar").css("width", Math.round(percent) + "%");
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
	var folder_lokasi = $("#folder_lokasi").val();
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
	var folder_lokasi = $("#folder_lokasi").val();
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
		("#progress_div").hide();

		alert("Gagal upload file, silakan coba upload file dengan format atau ukuran yang berbeda");
	} else {
		$("#progress_div").hide();

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
/*------------------------------end---------------------------------------------------*/

/*-------------------------sugnature pad-------------------------------------------*/

$("#ttddigital").click(function () {
	var signaturePad = new SignaturePad(document.getElementById('signature-pad'));

	$("#ttdpic").hide();
	$("#signature").show();
	$("#ttddigital").hide();
	$("#ttddigital_clear").show();
	$("#capturettd").show();
	$("#ttdupload").show();

	signaturePad.clear();

	alert("Jangan lupa meng-klik/touch tombol capture !!!");
})

$("#ttdupload").click(function () {
	$("#ttdpic").show();
	$("#signature").hide();
	$("#ttddigital").show();
	$("#ttddigital_clear").hide();
	$("#capturettd").hide();
	$("#ttdupload").hide();
})

$("#ttddigital_clear").click(function () {
	var signaturePad = new SignaturePad(document.getElementById('signature-pad'));

	signaturePad.clear();
})

$("#capturettd").click(function () {
	var signaturePad = document.getElementById('signature-pad');

	var ttdimage = signaturePad.toDataURL("image/png");

	$("#ttd").attr("src", ttdimage);

	$("#ttdpic").show();
	$("#signature").hide();
	$("#ttddigital").show();
	$("#ttddigital_clear").hide();
	$("#capturettd").hide();
	$("#ttdupload").hide();

	$("#nama_file_ttd").val(ttdimage);

	alert("Tanda tangan Anda ter-capture silakan kembali dan tekan tombol update");
})
/*-----------------------------------------------------end----------------------------------*/

/*--------------------pegawai------------------------------------------------------------------*/
$("#uploadfoto").click(function () {
	$("#divformulir").hide();
	$("#divfoto").show();
	$("#divttd").hide();
})

$("#uploadttd").click(function () {
	$("#divformulir").hide();
	$("#divfoto").hide();
	$("#divttd").show();
})

$("#closefoto").click(function () {
	$("#divformulir").show();
	$("#divfoto").hide();
	$("#divttd").hide();
})

$("#closettd").click(function () {
	$("#divformulir").show();
	$("#divfoto").hide();
	$("#divttd").hide();
})

$("#persno").change(function () {
	var persno_lama = $("#persno_lama").val();
	var persno = $(this).val();
	var email = $("#email").val();
	var lokasi = $("#lokasi").val();

	if (persno_lama != persno) {
		var url = lokasi + "mobileprofil/cek_persno/" + persno;
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
		var url = lokasi + "mobileprofil/cek_email/" + email;
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
function step(aksi, urutan) {
	$("#step-1").addClass("hide");
	$("#step-2").addClass("hide");
	$("#step-3").addClass("hide");
	$("#step-4").addClass("hide");
	$("#step-5").addClass("hide");
	$("#step-6").addClass("hide");
	$("#step-7").addClass("hide");
	$("#step-8").addClass("hide");
	$("#step-9").addClass("hide");
	$("#step-10").addClass("hide");
	$("#step-11").addClass("hide");
	$("#step-12").addClass("hide");
	$("#step-13").addClass("hide");
	$("#step-14").addClass("hide");

	var trip_no = $("#trip_no").val();
	var dari = $("#trip_darino").val();
	var ke = $("#ke").val();
	var tgl_berangkat = $("#tgl_berangkat").val();
	var tgl_pulang = $("#tgl_pulang").val();
	var maksud = $("#maksud").val();
	var nama_berkas1 = $("#nama_berkas1").val();
	var nama_berkas2 = $("#nama_berkas2").val();
	var nama_berkas3 = $("#nama_berkas3").val();
	var isilap = $("#isilap").val();
	var nominal_pergi = $("#nominal_pergi").val();
	var nominal_pulang = $("#nominal_pulang").val();
	var nama_berkas_pergi = $("#nama_berkas_pergi").val();
	var nama_berkas_pulang = $("#nama_berkas_pulang").val();
	var nama_penginapan = $("#nama_penginapan").val();
	var tgl_check_in = $("#tgl_check_in").val();
	var tgl_check_out = $("#tgl_check_out").val();
	var nominal_penginapan = $("#nominal_penginapan").val();
	var nama_berkas_penginapan = $("#nama_berkas_penginapan").val();
	var nominal_bagasi = $("#nominal_bagasi").val();
	var nama_berkas_bagasi = $("#nama_berkas_bagasi").val();
	var kd_atasan = $("#kd_atasan").val();

	switch (urutan) {
		case 1:
			$("#step-1").removeClass("hide");
			break;
		case 2:
			if (aksi == "lanjut") {
				if (trip_no != "" && dari != "" && ke != "" && tgl_berangkat != "" && tgl_pulang != "" && maksud != "") {
					$("#step-2").removeClass("hide");
				} else {
					alert("Data belum lengkap !!!");
					$("#step-1").removeClass("hide");
				}
			} else {
				$("#step-2").removeClass("hide");
			}
			break;
		case 3:
			//if (aksi == "lanjut") {
			//	if (nama_berkas1.includes(".")) {
			//		$("#step-3").removeClass("hide");
			//	} else {
			//		alert("Upload berkas SPPD 1 !!!");
			//		$("#step-2").removeClass("hide");
			//	}
			//} else {
			$("#step-3").removeClass("hide");
			//}
			break;
		case 4:
			//if (aksi == "lanjut") {
			//	if (nama_berkas2.includes(".")) {
			//		$("#step-4").removeClass("hide");
			//	} else {
			//		alert("Upload berkas SPPD 2 !!!");
			//		$("#step-3").removeClass("hide");
			//	}
			//} else {
			$("#step-4").removeClass("hide");
			//}
			break;
		case 5:
			//if (aksi == "lanjut") {
			//	if (nama_berkas3.includes(".")) {
			//		$("#step-5").removeClass("hide");
			//	} else {
			//		alert("Upload berkas SPPD 3 !!!");
			//		$("#step-4").removeClass("hide");
			//	}
			//} else {
			$("#step-5").removeClass("hide");
			//}
			break;
		case 6:
			if (aksi == "lanjut") {
				if (isilap != "") {
					$("#step-6").removeClass("hide");
				} else {
					alert("Isi laporan singkat perjalanan dinas Anda !!!");
					$("#step-5").removeClass("hide");
				}
			} else {
				$("#step-6").removeClass("hide");
			}
			break;
		case 7:
			if (aksi == "lanjut") {
				$("#step-7").removeClass("hide");
			} else {
				$("#step-7").removeClass("hide");
			}
			break;
		case 8:
			if (aksi == "lanjut") {
				if ((nominal_pergi != "" && nominal_pergi != "0") || (nominal_pulang != "" && nominal_pulang != "0")) {
					$("#step-8").removeClass("hide");
				} else {
					alert("Isi biaya transportasi pergi atau pulang atau keduanya !!!");
					$("#step-7").removeClass("hide");
				}
			} else {
				$("#step-8").removeClass("hide");
			}
			break;
		case 9:
			if (aksi == "lanjut") {
				if (nama_berkas_pergi.includes(".")) {
					$("#step-9").removeClass("hide");
				} else {
					alert("Upload berkas transportasi pergi !!!");
					$("#step-8").removeClass("hide");
				}
			} else {
				$("#step-9").removeClass("hide");
			}
			break;
		case 10:
			if (aksi == "lanjut") {
				if (nominal_pulang != "" && nominal_pulang != "0") {
					if (nama_berkas_pulang.includes(".")) {
						$("#step-10").removeClass("hide");
					} else {
						alert("Upload berkas transportasi pulang !!!");
						$("#step-9").removeClass("hide");
					}
				} else {
					$("#step-10").removeClass("hide");
				}
			} else {
				$("#step-10").removeClass("hide");
			}
			break;
		case 11:
			//if (aksi == "lanjut") {
			//	if (nama_penginapan != "" || tgl_check_in != "" || tgl_check_out != "" || nominal_penginapan != "") {
			//		if (nama_penginapan != "" && tgl_check_in != "" && tgl_check_out != "" && nominal_penginapan != "") {
			//			$("#step-11").removeClass("hide");
			//		} else {
			//			alert("Data belum lengkap !!!");
			//			$("#step-10").removeClass("hide");
			//		}
			//	} else {
			//		$("#step-11").removeClass("hide");
			//	}
			//} else {
			$("#step-11").removeClass("hide");
			//}
			break;
		case 12:
			if (aksi == "lanjut") {
				//if (nama_penginapan != "" || tgl_check_in != "" || tgl_check_out != "" || nominal_penginapan != "") {
				if (nama_penginapan != "" || (nominal_penginapan != "" && nominal_penginapan != "0")) {
					if (nama_berkas_penginapan.includes(".")) {
						$("#step-12").removeClass("hide");
					} else {
						alert("Upload berkas penginapan !!!");
						$("#step-11").removeClass("hide");
					}
				} else {
					$("#step-12").removeClass("hide");
				}
			} else {
				$("#step-12").removeClass("hide");
			}
			break;
		case 13:
			if (aksi == "lanjut") {
				$("#step-13").removeClass("hide");
			} else {
				$("#step-13").removeClass("hide");
			}
			break;
		case 14:
			if (aksi == "lanjut") {
				if (nominal_bagasi != "" && nominal_bagasi != "0") {
					if (nama_berkas_bagasi.includes(".")) {
						$("#step-14").removeClass("hide");
					} else {
						alert("Upload berkas bagasi !!!");
						$("#step-13").removeClass("hide");
					}
				} else {
					$("#step-14").removeClass("hide");
				}
			} else {
				$("#step-14").removeClass("hide");
			}
			break;
	}
}

$("#trip_no").change(function () {
	var tripno_lama = $("#tripno_lama").val();
	var tripno = $(this).val();
	var email = $("#email").val();
	var lokasi = $("#lokasi").val();

	if (tripno_lama != tripno) {
		var url = lokasi + "mobilesppd/cek_tripno/" + tripno;
		$.getJSON(url, function (result) {
			console.log(result);
			$.each(result, function (i, field) {
				if (field.jml != 0) {
					$("#trip_no").val("");
					$("#tripno_error").show();
					$("#tripno_error").html("Trip Number " + tripno + " sudah terdaftar");
					$("#div_tripno").addClass("has-error");
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

function daftar_pegawai() {
	var lokasi = $("#lokasi").val();
	$("#frame_daftar_pegawai").attr("src", lokasi + "mobilesppd/daftar_pegawai");
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

/*
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
*/

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
function ambil_jabatan(a, nama) {
	$("#frm_jabatan").attr("action", a);

	$("#jabatan_awal").val(nama);
	$("#nama_jabatan").val(nama);
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
$("#status").change(function () {
	var status = $(this).val();

	switch (status) {
		case "0":
			$("#cap_dari").html("Tanggal Pelaporan");
			$("#cap_sampai").html("Tanggal Pelaporan");
			break;
		case "1":
			$("#cap_dari").html("Tanggal Selesai");
			$("#cap_sampai").html("Tanggal Selesai");
			break;
	}
})
/*------------------------------------end----------------------------------------------*/
