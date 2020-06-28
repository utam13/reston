<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class='content-header'>
		<h1>Jabatan Pegawai</h1>
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
				<div class="box">
					<div class="box-header with-border">
						<h3 align class="box-title">
							<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_jabatan" onclick="ambil_jabatan('<?= base_url(); ?>jabatan/proses/1','','')"><i class="fa fa-plus"></i> Tambah Data</a>
						</h3>

						<div style="float:right">
							<form class="form-inline" method="post" action="<?= base_url(); ?>jabatan" method="post" style="float:right;" onsubmit="showloading()">
								<div class="form-group">
									<input type="text" class="form-control input-sm" name="cari" required autocomplete="off" value="" placeholder="Nama Jabatan" />
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-success btn-sm">Cari</button>
									<a href="<?= base_url(); ?>jabatan" class="btn btn-info btn-sm" onclick="showloading()">Segarkan</a>
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
									<th>Nama Jabatan</th>
									<th>Approval Pelaporan Restitusi</th>
									<th width="50px">Action</th>
								</tr>
							</thead>
							<tbody>
								<?
								$hasil = json_decode($jabatan);
								foreach ($hasil as $b) {
								?>
								<tr>

									<td align="center" style="font-size:9pt;"><?= $no; ?></td>
									<td style="font-size:9pt;"><?= $b->nama; ?></td>
									<td style="font-size:9pt;"><?= $b->status_approval; ?></td>
									<td align="center">
										<a href="#" class="btn btn-primary btn-xs" style="color:#fff;" data-toggle="modal" data-target="#form_jabatan" onclick="ambil_jabatan('<?= base_url(); ?>jabatan/proses/2','<?= $b->nama; ?>','<?= $b->approval; ?>')"><i class="fa fa-pencil"></i></a>
										<a href="<?= base_url(); ?>jabatan/proses/3/<?= $b->nama; ?>" class="btn btn-danger btn-xs" style="color:#fff;" onclick="return confirm('Menghapus jabatan dengan nama <?= $b->nama; ?> ?')"><i class="fa fa-trash"></i></a>
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
							<li><a href="<?= base_url(); ?>jabatan/index/1/<?= $cari; ?>"><span class="fa fa-fast-backward"></a></li>
							<li><a href="<?= base_url(); ?>jabatan/index/<?= $link_prev; ?>/<?= $cari; ?>"><span class="fa fa-step-backward"></a></li>
							<?
								}

								for ($i = $start_number; $i <= $end_number; $i++) {
									if ($page == $i) {
										$link_active = "";
										$link_color = "class='disabled'";
									} else {
										$link_active = base_url() . "jabatan/index/$i/$cari";
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
							<li><a href="<?= base_url(); ?>jabatan/index/<?= $link_next; ?>/<?= $cari; ?>"><span class="fa fa-step-forward"></a></li>
							<li><a href="<?= base_url(); ?>jabatan/index/<?= $jumlah_page; ?>/<?= $cari; ?>"><span class="fa fa-fast-forward"></a></li>
							<? } ?>
						</ul>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Modal -->
	<!--Formulir-->
	<div class="modal fade" id="form_jabatan" tabindex="-1" role="dialog" aria-labelledby="form_jabatan" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="form_jabatan_label">Formulir Jabatan Pegawai</h4>
				</div>
				<form id="frm_jabatan" name="frm_jabatan" method="post" action="">
					<input type="hidden" class="form-control" name="jabatan_awal" id="jabatan_awal" value="" />
					<div class="modal-body">
						<div class="form-group">
							<label>Nama Jabatan</label>
							<input type="text" class="form-control" name="nama" id="nama_jabatan" value="" maxlength=100 autocomplete="off" required />
						</div>
						<div class="form-group">
							<label>Approval Diperlukan</label>
							<select class="form-control" id="approval" name="approval" required>
								<option value="">Pilih...</option>
								<option value="0">Tidak</option>
								<option value="1">Ya</option>
							</select>
						</div>
					</div>
					<div id="savebtn" class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.content-wrapper -->