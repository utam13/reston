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

    <!-- time -->
    <script>
        function startTime() {
            var today = new Date();
            var date = today.getDate();
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var month = months[today.getMonth()];
            var year = today.getFullYear();
            var today_date = date + " " + month + " " + year;
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('tgl_sekarang').innerHTML = date + " " + month + " " + year + " " + h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);

            if (today_date == "20 June 2020") {
                alert('Masa trial aplikasi telah berakhir !!! Silakan lakukan pembayaran terlebih dahulu kemudian lanjutkan hubungi kami untuk versi non trial');
                window.open("<?= base_url(); ?>login/logout", "_self");
            }
        }

        function checkTime(t) {
            if (t < 10) {
                t = "0" + t
            }; // add zero in front of numbers < 10
            return t;
        }
    </script>

    <link href="<?= base_url(); ?>assets/css/style_tambahan.css" rel="stylesheet">
</head>

<body class="hold-transition skin-blue sidebar-mini" onload="startTime()">
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
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-calendar"></i>
                                <span id="tgl_sekarang"></span>
                            </a>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= $this->session->userdata('foto_user'); ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?= $this->session->userdata('nama_user'); ?></span>
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
                                    <div class="pull-left">
                                        <a href="<?= base_url(); ?>assets/manual/manual.pdf" class="btn btn-default btn-flat" target="_blank">Manual</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= base_url(); ?>login/logout" class="btn btn-default btn-flat">Log Out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>