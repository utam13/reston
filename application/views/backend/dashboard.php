<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class='content-header'>
		<h1>Dashboard</h1>
	</section>

	<section class="content">
		<div class="row">
			<!-- Message area -->

			<div class="col-lg-4 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-purple">
					<div class="inner">
						<h3>
							<?= number_format($baru, 0, ',', '.'); ?>
						</h3>
						<p>Pelaporan Baru <small>menunggu approval</small></p>
					</div>
					<div class="icon">
						<i class="fa fa-files-o"></i>
					</div>
					<a href="<?= base_url(); ?>sppd/index/1/0/a.approve" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-4 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>
							<?= number_format($proses, 0, ',', '.'); ?>
						</h3>
						<p>Pelaporan Approved <small>menunggu proses</small></p>
					</div>
					<div class="icon">
						<i class="fa fa-folder-open"></i>
					</div>
					<a href="<?= base_url(); ?>sppd/index/1/1/a.approve" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>


			<div class="col-lg-4 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-olive">
					<div class="inner">
						<h3>
							<?= number_format($selesai, 0, ',', '.'); ?>
						</h3>
						<p>Pelaporan Selesai Diproses<small>&nbsp;</small></p>
					</div>
					<div class="icon">
						<i class="fa fa-folder"></i>
					</div>
					<a href="<?= base_url(); ?>sppd/index/1/1/a.selesai" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	</section>

</div><!-- /.content-wrapper -->