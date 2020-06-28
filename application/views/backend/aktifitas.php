		<!-- Right side column. Contains the navbar and content of the page -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Log Aktifitas
				</h1>
			</section>

			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 align class="box-title">
									<a href="<?= base_url(); ?>aktifitas/laporan" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-file-excel-o"></i> Laporan Log Aktifitas</a>
									<a href="<?= base_url(); ?>aktifitas/hapus" class="btn btn-danger btn-sm" onclick="return confirm('Hapus semua log aktifitas dari aplikasi ?')"><i class="fa fa-trash"></i></a>
								</h3>

								<div style="float:right;margin-top:-10px;">
									<form class="form-inline" method="post" action="<?= base_url(); ?>aktifitas" method="post" style="float:right;" onsubmit="showloading()">
										<div class="form-group">
											<div class="input-group margin">
												<div class="input-group-btn">
													<a href="<?= base_url(); ?>aktifitas" class="btn btn-info btn-sm" onclick="showloading()"><i class="fa fa-refresh"></i></a>
												</div>
												<input type="text" class="form-control input-sm" name="cari" placeholder="Isi aktifitas log" required autocomplete="off" value="" />
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
											<th>No</th>
											<th width="10%">Waktu Log</th>
											<th width="20%">User Name</th>
											<th width="10%">Ip Address</th>
											<th width="20%">Sistem</th>
											<th width="30%">Aktifitas</th>
										</tr>
									</thead>
									<tbody>
										<? foreach ($log as $l) { ?>
											<tr>
												<td nowrap><?= $no; ?></td>
												<td nowrap><?= date('d-m-Y h:i:s A', strtotime($l->waktulog)); ?></td>
												<td nowrap><?= $l->username; ?></td>
												<td nowrap><?= $l->iplog; ?></td>
												<td nowrap><?= $l->systlog; ?></td>
												<td><?= $l->infolog; ?></td>
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
											<li><a href="<?= base_url(); ?>aktifitas/index/1/<?= $cari; ?>"><span class="fa fa-fast-backward"></a></li>
											<li><a href="<?= base_url(); ?>aktifitas/index/<?= $link_prev; ?>/<?= $cari; ?>"><span class="fa fa-step-backward"></a></li>
										<?
										}

										for ($i = $start_number; $i <= $end_number; $i++) {
											if ($page == $i) {
												$link_active = "";
												$link_color = "class='disabled'";
											} else {
												$link_active = base_url() . "aktifitas/index/$i/$cari";
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
											<li><a href="<?= base_url(); ?>aktifitas/index/<?= $link_next; ?>/<?= $cari; ?>"><span class="fa fa-step-forward"></a></li>
											<li><a href="<?= base_url(); ?>aktifitas/index/<?= $jumlah_page; ?>/<?= $cari; ?>"><span class="fa fa-fast-forward"></a></li>
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