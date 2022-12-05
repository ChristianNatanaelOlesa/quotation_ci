<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QUOTATION - <?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/dataTables.bootstrap4.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/own.css'); ?>">

        <style>
        .table{
            font-size:12px;
        }
        .paginate_button{
            font-size:12px;
        }
        .dataTables_info{
            font-size:12px;
        }
        .dataTables_filter{
            font-size:12px;
        }
        .dataTables_length{
            font-size:12px;
        }
        .modal{
            font-size:12px;
        }
        .flash-info{
            display:none;
        }
     
        </style>

 
        

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

      <!-- Custom styles for this template-->
      <link href="<?php echo base_url('css/sb-admin-2.css') ?>" rel="stylesheet">

    <!-- Page level plugin CSS-->
    <link href="<?php echo base_url('assets/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

  

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-10">
                    <img class="img-responsive" style="width:50px;" src="<?php echo base_url('img/TF_ICO_small.png'); ?>" title="PT TRAFOINDO PRIMA PERKASA" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">QUOTATION <br><sup>by Trafindo</sup></div>
                <!-- <small><?php
                // $this->input->ip_address(); ?></small> -->
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <?php $this->load->view('layouts/sidebar'); ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <?php $this->load->view('layouts/notif',$count_notif); ?>
                <!-- End of Topbar -->

                <!-- Main Area-->
                <div class="container-fluid">

                    <!-- Page Heading -->
                  
                    <!-- Content Row -->
                    <!-- <div class="row"> -->
                        <div class="card shadow mb-4">
                            <div class="card-header d-sm-flex align-items-center justify-content-between  py-3">
                                <h6 class="h3 mb-0 text-gray-800"><?= $judul; ?></h6>
                                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                            </div>
                            <div class="alert alert-success m-1 flash-info" role="alert"><span id="flashing">Alert</span></div>
                            <?php  $this->load->view($load_page);?>
                        </div>
                    <!-- </div> -->

                </div>
            </div>

            <!-- End of Main Area -->
            <!-- Begin Footer -->
            <?php $this->load->view('layouts/footer'); ?>
            
               