<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="cache-control" content="max-age=1" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="1" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1900 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="ScreenOrientation" content="autoRotate:disabled">

	<title>REST-ON</title>
	<link href="<?= base_url(); ?>assets/img/icon.png" rel="shortcut icon" type="image/x-icon" />

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
	<!-- Bootstrap Select Css -->
	<link href="<?= base_url(); ?>assets/css/bootstrap-select.css" rel="stylesheet" />

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/font-awesome-4.4.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/AdminLTE2.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
		.login-page {
			background: url("<?= base_url(); ?>assets/img/login-bg.jpg") no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			;
		}

		#dvloading {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url('<?= base_url(); ?>assets/img/page-loader.gif') 50% 50% no-repeat rgb(249, 249, 249);
			opacity: .8;
		}
	</style>
	<script>
		//tampilkan loading indikator
		function showloading() {
			$("#dvloading").css("display", "block");
		}
	</script>
	<? if ($pesan != "") { ?>
	<script>
		alert("<?= str_replace("-", " ", $pesan); ?>");
	</script>
	<? } ?>
</head>

<body class="hold-transition login-page">

	<!-- loading page animated until page ready -->
	<div id="dvloading" style="display:none;"></div>
	<br><br><br><br><br>
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><img src="<?= base_url(); ?>assets/img/icon3.png" width="10%" /> REST-ON</a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Sign In untuk memulai sesi Anda</p>

			<form method="post" action="<?= base_url(); ?>mobilelogin/proses" onsubmit="showloading()">
				<div class="form-group has-feedback">
					<input type="text" name="username" class="form-control" autocomplete="off" placeholder="Pers. No / email" required>
					<span class="fa fa-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<div class="input-group">
						<input type="password" id="password" name="password" class="form-control" autocomplete="new-password" placeholder="Password" required>
						<span class="input-group-btn">
							<button type="button" class="btn btn-default" onclick="lihatpassword()"><span id="iconlihat" class="fa fa-eye"></span></button>
						</span>
					</div>
					<span class="fa fa-key form-control-feedback" style="margin-right:40px;"></span>
				</div>
				<div class="row">
					<div class="col-xs-4 pull-right">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
			<div class="row">
				<div class="col-xs-12"><br></div>
				<div class="col-xs-6">
					<a href="#" data-toggle="modal" data-target="#lupa">Lupa Password</a>
				</div>
				<div class="col-xs-6 text-right">
					<a href="#" data-toggle="modal" data-target="#registrasi">Registrasi Pegawai</a>
				</div>
			</div>

		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- Modal -->
	<div class="modal fade" id="lupa" tabindex="-1" role="dialog" aria-labelledby="lupaLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="lupaLabel">Reset Password</h5>
				</div>
				<form id="frm_lupa" name="frm_lupa" action="<?= base_url(); ?>mobilelogin/reset" method="post">
					<div class="modal-body">
						<div class="form-group">
							<input type="email" class="form-control" id="email_reset" name="email_reset" value="" autocomplete="off" maxlength=150 placeholder="Email" required>
							<span id="email_reset_error" style="display:none;font-size:10pt;color:red;font-style:italic;">Email sudah terdaftar</span>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" id="btn-reset-pass" class="btn btn-primary">Proses</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="registrasi" tabindex="-1" role="dialog" aria-labelledby="registrasiLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="registrasiLabel">Registrasi Pegawai</h5>
				</div>
				<form class="form-horizontal" id="frm_registrasi" name="frm_registrasi" action="<?= base_url(); ?>mobilelogin/registrasi" method="post">
					<input type="hidden" id="nama_file_foto" name="nama_file_foto" value="<?= $foto; ?>">
					<input type="hidden" id="nama_file_ttd" name="nama_file_ttd" value="<?= $ttd; ?>">
					<input type="hidden" id="lokasi" name="lokasi" value="<?= base_url(); ?>">
					<input type="hidden" id="folder_lokasi" name="folder_lokasi" value="pegawai">
					<input type="file" id="pilih_foto" name="pilih_foto" accept=".jpg,.png,.bmp,.gif" style="display:none;">
					<input type="file" id="pilih_ttd" name="pilih_ttd" accept=".jpg,.png,.bmp,.gif" style="display:none;">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12 pre-scrollable">
								<div class="form-group">
									<label class="col-sm-3 control-label">Pers. No</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="persno" name="persno" value="" autocomplete="off" maxlength=100 placeholder="Pers. No" required>
										<span id="persno_error" style="display:none;font-size:10pt;color:red;font-style:italic;">Pers. No sudah terdaftar</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Email</label>
									<div class="col-sm-9">
										<input type="email" class="form-control" id="email" name="email" value="" autocomplete="off" maxlength=150 placeholder="Email" required>
										<span id="email_error" style="display:none;font-size:10pt;color:red;font-style:italic;">Email sudah terdaftar</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Nama</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="nama" name="nama" value="" autocomplete="off" maxlength=150 placeholder="Nama" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Jabatan</label>
									<div class="col-sm-5">
										<select class="form-control" id="jabatan" name="jabatan" style="width: 100%;" required>
											<option value="">Pilih...</option>
											<?
											foreach ($jabatan as $j) {
												echo "<option value='" . $j->nama . "'>" . $j->nama . "</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Unit Organisasi</label>
									<div class="col-sm-5">
										<select class="form-control" id="unit" name="unit" style="width: 100%;" required>
											<!--<option value="">Pilih...</option>-->
											<?
											foreach ($unit as $u) {
												echo "<option value='" . $u->nama . "'>" . $u->nama . "</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Bidang</label>
									<div class="col-sm-5">
										<select class="form-control" id="bidang" name="bidang" style="width: 100%;" required>
											<option value="">Pilih...</option>
											<?
											foreach ($bidang as $b) {
												echo "<option value='" . $b->nama . "'>" . $b->nama . "</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Business Area</label>
									<div class="col-sm-3">
										<select class="form-control" id="area" name="area" style="width: 100%;" required>
											<!--<option value="">Pilih...</option>-->
											<?
											foreach ($area as $a) {
												echo "<option value='" . $a->nomor . "'>" . $a->nomor . "</option>";
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Proses</button>
						</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.modal-content -->

	<!-- jQuery 3 -->
	<script src="<?= base_url(); ?>assets/js/jquery-1.12.0.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
	<!-- Select Plugin Js -->
	<script src="<?= base_url(); ?>assets/js/bootstrap-select.js"></script>

	<script>
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

		/*----------------------------upload file---------------------------------*/
		function upload_foto() {
			$("#pilih_foto").click();
		}

		function upload_ttd() {
			$("#pilih_ttd").click();
		}

		$('#pilih_foto').change(function() {
			if (this.files[0] != "") {
				if (this.files[0].size > 6000000) {
					alert("Ukuran file melebihi 6 Mb!");
				} else {
					//$("#savebtn").hide();
					$("#progress_div").show();
					$("#progress_bar").attr("aria-valuenow", 0);

					var nama_file = $("#nama_file_foto").val();
					var lokasi = $("#lokasi").val();
					var target_proses = lokasi + "mobilelogin/upload/" + nama_file;

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

		$('#pilih_ttd').change(function() {
			if (this.files[0] != "") {
				if (this.files[0].size > 6000000) {
					alert("Ukuran file melebihi 6 Mb!");
				} else {
					//$("#savebtn").hide();
					$("#progress_div").show();
					$("#progress_bar").attr("aria-valuenow", 0);

					var nama_file = $("#nama_file_foto").val();
					var lokasi = $("#lokasi").val();
					var target_proses = lokasi + "mobilelogin/upload/" + nama_file;

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

		function progressHandlerFoto(event) {
			var percent = (event.loaded / event.total) * 100;
			$("#progress_bar_foto").css("width", Math.round(percent) + "%");
		}

		function progressHandlerTtd(event) {
			var percent = (event.loaded / event.total) * 100;
			$("#progress_bar_ttd").css("width", Math.round(percent) + "%");
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
		/*-----------------------------------------------------end----------------------------------*/

		$("#persno").change(function() {
			var persno = $(this).val();
			var lokasi = $("#lokasi").val();

			var url = lokasi + "mobilelogin/cek_persno/" + persno;
			$.getJSON(url, function(result) {
				console.log(result);
				$.each(result, function(i, field) {
					if (field.jml != 0) {
						$("#persno").val("");
						$("#persno_error").show();
						$("#persno_error").html("Pers. No " + persno + " sudah terdaftar");
					} else {
						$("#persno_error").hide();
					}
				});
			});
		})

		$("#email").change(function() {
			var email = $(this).val();
			var lokasi = $("#lokasi").val();

			var url = lokasi + "mobilelogin/cek_email/" + email;
			$.getJSON(url, function(result) {
				console.log(result);
				$.each(result, function(i, field) {
					if (field.jml != 0) {
						$("#email").val("");
						$("#email_error").show();
						$("#email_error").html("Email " + email + " sudah terdaftar");
					} else {
						$("#email_error").hide();
					}
				});
			});
		})

		$("#email_reset").change(function() {
			var email = $(this).val();
			var lokasi = $("#lokasi").val();

			var url = lokasi + "mobilelogin/cek_email/" + email;
			$.getJSON(url, function(result) {
				console.log(result);
				$.each(result, function(i, field) {
					if (field.jml == 0) {
						$("#email_reset").val("");
						$("#email_reset_error").show();
						$("#email_reset_error").html("Email tidak terdaftar");
						$("#btn-reset-pass").hide();
					} else {
						$("#email_reset_error").hide();
						$("#btn-reset-pass").show();
					}
				});
			});
		})
	</script>

</body>

</html>