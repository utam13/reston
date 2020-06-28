<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class='content-header'>
		<h1>Dashboard</h1>
	</section>

	<section class="content">
		<div class="row">
			<? if ($this->session->userdata('level') == 3 || $this->session->userdata('level') == 4) { ?>
				<div class="col-md-4">
					<div class="info-box" onclick="location.href='<?= base_url(); ?>mobilesppd/index/1/0/butuh_approve'">
						<span class="info-box-icon bg-maroon">
							<i class="fa fa-check"></i>
						</span>

						<div class="info-box-content">
							<span class="info-box-text">
								<h4>Menunggu Approval Anda</h4>
							</span>
							<span class="info-box-number"><?= number_format($notif_approve, 0, ',', '.'); ?></span>
						</div>
					</div>
				</div>
			<? } ?>

			<div class="col-md-4">
				<div class="info-box" onclick="location.href='<?= base_url(); ?>mobilesppd/index/1/0/a.approve'">
					<span class="info-box-icon bg-purple">
						<i class="fa fa-files-o"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">
							<h4>Baru Anda Ajukan</h4>
						</span>
						<span class="info-box-number"><?= number_format($baru, 0, ',', '.'); ?></span>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="info-box" onclick="location.href='<?= base_url(); ?>mobilesppd/index/1/1/a.approve'">
					<span class="info-box-icon bg-yellow">
						<i class="fa fa-folder-open"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">
							<h4>Approved</h4>
						</span>
						<span class="info-box-number"><?= number_format($proses, 0, ',', '.'); ?></span>
					</div>
				</div>
			</div>


			<div class="col-md-4">
				<div class="info-box" onclick="location.href='<?= base_url(); ?>mobilesppd/index/1/1/a.selesai'">
					<span class="info-box-icon bg-olive">
						<i class="fa fa-folder"></i>
					</span>

					<div class="info-box-content">
						<span class="info-box-text">
							<h4>Selesai Diproses</h4>
						</span>
						<span class="info-box-number"><?= number_format($selesai, 0, ',', '.'); ?></span>
					</div>
				</div>
			</div>
		</div>
	</section>

</div><!-- /.content-wrapper -->