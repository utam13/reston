<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class='content-header'>
		<h1>Pegawai</h1>
	</section>

	<section class="content">
		<div class="row">
			<!-- Message area -->
			<?
			extract($alert);
			if ($kode_alert != "") {
			?>
			<div class="col-lg-12">
				<div class="alert <?= $jenisbox ?>">
					<?= str_replace("-br-", "<br>", str_replace("-", " ", $isipesan)); ?>
				</div>
			</div>
			<? } ?>
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 align class="box-title">
							<a href="<?= base_url(); ?>pegawai/formulir/1" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
						</h3>

						<div style="float:right;margin-top:-10px;">
							<form class="form-inline" method="post" action="<?= base_url(); ?>pegawai" method="post" style="float:right;" onsubmit="showloading()">
								<div class="form-group">
									<label>Pencarian dengan:</label>
									<div class="input-group margin">
										<div class="input-group-btn">
											<a href="<?= base_url(); ?>pegawai" class="btn btn-info btn-sm" onclick="showloading()"><i class="fa fa-refresh"></i></a>
										</div>
										<select class="form-control input-sm" name="kategori">
											<option value="pers_no">Pers. No</option>
											<option value="nama">Nama</option>
											<option value="jabatan">Jabatan</option>
											<option value="unit">Unit Organisasi</option>
											<option value="bidang">Bidang</option>
											<option value="area">Business Area</option>
											<option value="email">Email</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group margin">
										<input type="text" class="form-control input-sm" name="cari" required autocomplete="off" value="" />
										<div class="input-group-btn">
											<button type="submit" class="btn bg-olive btn-sm"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /.box-header -->

					<div class="box-body table-responsive">
						<table class="table table-bordered table-striped" id="mytable">
							<thead>
								<tr>
									<th width="10px">No</th>
									<th>Foto</th>
									<th>Data Pegawai</th>
								</tr>
							</thead>
							<tbody>
								<?
								$hasil = json_decode($pegawai);
								foreach ($hasil as $p) {
								?>
								<tr>
									<td align="center"><?= $no; ?></td>
									<td align="center" style="width:10%;">
										<img src="<?= $p->file_foto . "?" . rand(); ?>" style="width:100%;cursor:pointer;" onclick="preview('<?= $p->file_foto . '?' . rand(); ?>')">
									</td>
									<td nowrap>
										<div class="col-xs-6">
											<b>Pers. No:</b> <?= $p->pers_no; ?>
											<br><b>Nama:</b> <?= $p->nama; ?>
											<br><b>Jabatan:</b> <?= $p->jabatan; ?>
											<br><b>Unit Organisasi:</b> <?= $p->unit; ?>
										</div>
										<div class="col-xs-6">
											<b>Bidang:</b> <?= $p->bidang; ?>
											<br><b>Business Area:</b> <?= $p->area; ?>
											<br><b>Email:</b> <?= $p->email; ?>
											<br><b>Level Akses:</b> <?= $p->level; ?>
										</div>
										<div class="col-xs-12 text-right">
											<? if ($p->status_email == "0") { ?>
											<a href="<?= base_url(); ?>pegawai/verifikasi/<?= $p->kd_pegawai; ?>" class="btn btn-default btn-xs" onclick="return confirm('Mengirim link verifikasi email ?')">
												<i class="fa fa-envelope"></i> Kirim link verifikasi
											</a>
											<? } ?>
											<a href="<?= base_url(); ?>pegawai/proses/4/<?= $p->kd_pegawai; ?>/<?= $p->pers_no; ?>/<?= $p->nama; ?>/<?= $p->status_pegawai; ?>" class="btn <?= $p->btn_status; ?> btn-xs" onclick="return confirm('<?= $p->btn_pesan_status; ?> ?')"><?= $p->nama_status; ?></a>
											<a href="<?= base_url(); ?>pegawai/formulir/2/<?= $p->kd_pegawai; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
											<a href="<?= base_url(); ?>pegawai/proses/3/<?= $p->kd_pegawai; ?>/<?= $p->pers_no; ?>/<?= $p->nama; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Menghapus pegawai <?= $p->pers_no; ?> - <?= $p->nama; ?> ?')"><i class="fa fa-trash"></i></a>
										</div>
									</td>
								</tr>
								<? $no++;
								} ?>
							</tbody>

						</table>
					</div>
					<div class="box-footer with-border">
						<? if ($jumlah_page > 0) { ?>
						<ul class="pagination" style="float:right;">
							<? if ($page == 1) { ?>
							<li class="disabled"><a href="#"><span class="fa fa-fast-backward"></a></li>
							<li class="disabled"><a href="#"><span class="fa fa-step-backward"></a></li>
							<? } else {
									$link_prev = ($page > 1) ? $page - 1 : 1; ?>
							<li><a href="<?= base_url(); ?>pegawai/index/1/<?= $cari; ?>/<?= $kategori; ?>"><span class="fa fa-fast-backward"></a></li>
							<li><a href="<?= base_url(); ?>pegawai/index/<?= $link_prev; ?>/<?= $cari; ?>/<?= $kategori; ?>"><span class="fa fa-step-backward"></a></li>
							<?
								}

								for ($i = $start_number; $i <= $end_number; $i++) {
									if ($page == $i) {
										$link_active = "";
										$link_color = "class='disabled'";
									} else {
										$link_active = base_url() . "pegawai/index/$i/$cari/$kategori";
										$link_color = "";
									}
								?>
							<li <?= $link_color; ?>><a href="<?= $link_active; ?>"><?= $i; ?></a></li>
							<? }

								if ($page == $jumlah_page) {
								?>
							<li class="disabled"><a href="#"><span class="fa fa-step-forward"></a></li>
							<li class="disabled"><a href="#"><span class="fa fa-fast-forward"></a></li>
							<? } else {
									$link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page; ?>
							<li><a href="<?= base_url(); ?>pegawai/index/<?= $link_next; ?>/<?= $cari; ?>/<?= $kategori; ?>"><span class="fa fa-step-forward"></a></li>
							<li><a href="<?= base_url(); ?>pegawai/index/<?= $jumlah_page; ?>/<?= $cari; ?>/<?= $kategori; ?>"><span class="fa fa-fast-forward"></a></li>
							<? } ?>
						</ul>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="preview-gambar" tabindex="-1" role="dialog" aria-labelledby="preview-gambarLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="preview-gambarLabel">Foto Pegawai</h5>
			</div>
			<div class="modal-body">
				<img src="" id="preview" width="100%">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
				<a id="preview_newtab" href="" target="_blank" rule="button" class="btn btn-warning btn-sm">Tampilkan lebih besar</a>
			</div>
		</div>
	</div>
</div>
<!-- end modal -->