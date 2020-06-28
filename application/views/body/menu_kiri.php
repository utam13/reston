<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu">
            <li><a href="<?= base_url(); ?>dashboard" onclick="showloading()"><i class="fa fa-home"></i><span>DASHBOARD</span></a></li>
            <li class="header">DATA MASTER</li>

            <? if ($this->session->userdata('level') == "0") { ?>
                <li><a href="<?= base_url(); ?>profil/index/<?= $this->session->userdata('kode_user'); ?>" onclick="showloading()"><i class="fa fa-user"></i><span>Profil</span></a></li>
            <? } ?>

            <? if ($this->session->userdata('level') == "1" || $this->session->userdata('level') == "100") { ?>
                <li><a href="<?= base_url(); ?>pegawai" onclick="showloading()"><i class="fa fa-users"></i><span>Pegawai</span></a></li>
            <? } ?>

            <li><a href="<?= base_url(); ?>sppd" onclick="showloading()"><i class="fa fa-folder-open"></i><span>Pelaporan Restitusi</span></a></li>

            <? if ($this->session->userdata('level') == "1" || $this->session->userdata('level') == "100") { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-gears"></i><span>Pengaturan</span>
                        <span class="pull-right-container pull-right">
                            <i class="fa fa-angle-down "></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_url(); ?>jabatan" onclick="showloading()"><i class="fa fa-circle-o"></i> Jabatan</a></li>
                        <li><a href="<?= base_url(); ?>unit" onclick="showloading()"><i class="fa fa-circle-o"></i> Unit</a></li>
                        <li><a href="<?= base_url(); ?>bidang" onclick="showloading()"><i class="fa fa-circle-o"></i> Bidang</a></li>
                        <li><a href="<?= base_url(); ?>area" onclick="showloading()"><i class="fa fa-circle-o"></i> Business Area</a></li>
                        <li><a href="<?= base_url(); ?>emailsender" onclick="showloading()"><i class="fa fa-circle-o"></i> Email Sender</a></li>
                    </ul>
                </li>
            <? } ?>

            <? if ($this->session->userdata('level') != "0" || $this->session->userdata('level') == "100") { ?>
                <li><a href="#" data-toggle="modal" data-target="#laporan-data"><i class="fa fa-file-text"></i><span>Laporan</span></a></li>
            <? } ?>

            <? if ($this->session->userdata('level') == "1" || $this->session->userdata('level') == "4" || $this->session->userdata('level') == "100") { ?>
                <li><a href="<?= base_url(); ?>aktifitas" onclick="showloading()"><i class="fa fa-eye"></i><span>Log Aktifitas</span></a></li>
            <? } ?>
        </ul>
        <!--/.nav-list-->
    </section>
    <!-- /.sidebar -->
</aside>