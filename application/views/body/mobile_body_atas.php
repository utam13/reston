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

    <title>REST-ON</title>
    <link href="<?= base_url(); ?>assets/img/icon.png" rel="shortcut icon" type="image/x-icon" />

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- bootstrap 3.3.2 -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- font Awesome -->
    <link href="<?= base_url(); ?>assets/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Ionicons -->
    <link href="<?= base_url(); ?>assets/css/ionicons.min.css" rel="stylesheet">

    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/bootstrap-daterangepicker/daterangepicker.css">

    <!-- DATA TABLES -->
    <link href="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="<?= base_url(); ?>assets/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Theme style -->
    <link href="<?= base_url(); ?>assets/css/AdminLTE.min.css" rel="stylesheet">

    <!-- AdminLTE Skins. Choose a skin from the css/skins -->
    <link href="<?= base_url(); ?>assets/css/skins/skin-blue.min.css" rel="stylesheet">

    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/daterangepicker/daterangepicker-bs3.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/select2/dist/css/select2.min.css">

    <!-- jvectormap -->
    <link href="<?= base_url(); ?>assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">

    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?= base_url(); ?>assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css">

    <link href="<?= base_url(); ?>assets/css/bootstrap-combobox.css" rel="stylesheet" type="text/css">

    <!-- css untuk export datatable -->
    <link href="<?= base_url(); ?>assets/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">

    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/iCheck/all.css">

    <!-- Wizard Form -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/smart_wizard.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/smart_wizard_theme_dots.css">

    <link href="<?= base_url(); ?>assets/css/style_tambahan.css" rel="stylesheet">
</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <!-- loading page animated until page ready -->
    <div id="dvloading" style="display:none;"></div>

    <div class="wrapper">
        <header class="main-header">
            <a href="#" class="logo">
                <span class="logo-mini"><img src="<?= base_url(); ?>assets/img/icon2.png"></span>
                <span class="logo-lg"><img src="<?= base_url(); ?>assets/img/icon2.png">&nbsp;<b>REST-ON</b></span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="messages-menu pull-left">
                            <a href="<?= base_url(); ?>mobiledashboard">
                                <i class="fa fa-tachometer"></i>
                                &nbsp;Dashboard
                            </a>
                        </li>
                        <li class="messages-menu">
                            <a href="<?= base_url(); ?>mobilesppd">
                                <i class="fa fa-folder-open"></i>
                                &nbsp;Pelaporan Restitusi
                            </a>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= $this->session->userdata('foto_user'); ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs">Nama</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?= $this->session->userdata('foto_user'); ?>" class="img-circle" alt="User Image">

                                    <p>
                                        <?= $this->session->userdata('nama_user'); ?>
                                        <small><?= $this->session->userdata('persno_user'); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <? if ($this->session->userdata('level') != "100") { ?>
                                    <div class="pull-left">
                                        <a href="<?= base_url(); ?>mobileprofil" class="btn btn-default btn-flat">Profil Anda</a>
                                    </div>
                                    <?}?>
                                    <div class="pull-right">
                                        <a href="<?= base_url(); ?>mobilelogin/logout" class="btn btn-default btn-flat">Log Out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>