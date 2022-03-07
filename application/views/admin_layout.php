<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $this->config->item('project_name'); ?></title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url('assets')?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets')?>/css/adminlte.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  
  <link rel="icon" type="image/png" href="<?php echo base_url('assets')?>/images/favicon.png">
  
  <script src="<?php echo base_url('assets')?>/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('assets')?>/js/adminlte.min.js"></script>
<script src="<?php echo base_url('assets')?>/js/demo.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>  -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link text-capitalize" data-toggle="dropdown" href="#">
          <i class="fa fa-user-cog"></i>
          <!-- <span class="badge badge-warning navbar-badge">15</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
          <a href="" class="dropdown-item text-capitalize">
            <i class="fas fa-user mr-2"></i> <?php echo $this->session->userdata('name'); ?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('Forgot-Password'); ?>" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i> Change Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('Log-Out'); ?>" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i> LogOut
          </a>
          <!-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a style="background-color:#f1f1f1;" href="<?php echo base_url(); ?>" class="brand-link">
      <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="E-bill" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-bold " style="color:#000;">Electricity Bill</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url(); ?>assets/images/user-icon.png" class="img-circle elevation-2" alt="Naresh">
        </div>
        <div class="info">
          <a href="#" class="d-block text-capitalize"><?php echo $this->session->userdata('name'); ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url('/'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>     
          <?php if($this->session->userdata('role') == 'super_admin' || $this->session->userdata('role') == 'admin'){ ?>
            <li class="nav-item <?php if($this->uri->segment('1') == 'master'){
              echo "menu-is-opening menu-open";
          }?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ml-3">
              <li class="nav-item">
                <a href="<?php echo base_url()?>master/Company" class="nav-link <?php if($this->uri->segment('2') == 'Company'){
                        echo "active";
                    }?>">
                  <i class="far fa-building nav-icon"></i>
                  <p>Company</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?php echo base_url('master/Cost-Center')?>" class="nav-link <?php if($this->uri->segment('2') == 'Cost-Center'){
                        echo 'active';
                    }?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cost Center</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('master/Location')?>" class="nav-link <?php if($this->uri->segment('2') == 'Location'){
                        echo 'active';
                    }?>">
                  <i class="far fa-map nav-icon"></i>
                  <p>Location</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('master/Meter')?>" class="nav-link <?php if($this->uri->segment('2') == 'Meter'){
                        echo 'active';
                    }?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Meter</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('master/User')?>" class="nav-link <?php if($this->uri->segment('2') == 'User'){
                        echo 'active';
                    }?>">
                  <i class="far fa-user nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <?php if($this->session->userdata('role') == 'super_admin' || $this->session->userdata('role') == 'admin'){ ?>
          <li class="nav-item">
            <a href="<?php echo base_url('Assign-meter'); ?>" class="nav-link <?php if($this->uri->segment('1') == 'Assign-meter'){
                    echo 'active';
                }?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Assign User Task
<!--                 <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <?php } ?>
          
          
           <li class="nav-item <?php if($this->uri->segment(1) == 'bill-upload'){ echo 'menu-is-opening menu-open'; }?>">
            <a href="#" class="nav-link <?php if($this->uri->segment(1) == 'bill-upload'){
                echo "active";
            }?>">
              <i class="nav-icon fas nav-icon fas fa-upload"></i>
              <p>
                Bill
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ml-3">
              <li class="nav-item">
                <a href="<?php echo base_url('bill-upload'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'bill-upload'){
                echo "active";
            }?>">
                  <i class="nav-icon fas fa-upload"></i>
                  <p>
                    Bill Upload
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('pending-bill'); ?>" class="nav-link<?php if($this->uri->segment(1) == 'pending-bill'){
                    echo "active";
                }?>">
                  <i class="nav-icon fas fa-upload"></i>
                  <p>
                    Pending Bill
                  </p>
                </a>
              </li>
            </ul>
           </li>
           
           
           <li class="nav-item <?php if($this->uri->segment(1) == 'payment'){ echo 'menu-is-opening menu-open'; }?>">
            <a href="#" class="nav-link <?php if($this->uri->segment(2) == 'bill-upload'){
                echo "active";
            }?>">
              <i class="nav-icon fas nav-icon fas fa-upload"></i>
              <p>
                Payment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ml-3">
              <li class="nav-item">
                <a href="<?php echo base_url('payment/add-payment'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'add-payment'){
                echo "active";
            }?>">
                  <i class="nav-icon fas fa-upload"></i>
                  <p>
                    Add Payment
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('payment/payment-detail'); ?>" class="nav-link<?php if($this->uri->segment(1) == 'payment/payment-detail'){
                    echo " active";
                }?>">
                  <i class="nav-icon fas fa-upload"></i>
                  <p>
                    Payments Detail
                  </p>
                </a>
              </li>
            </ul>
           </li>
          
          
          
          <li class="nav-item">
            <a href="<?php echo base_url('Meter-Reading'); ?>" class="nav-link <?php if($this->uri->segment('1') == 'Meter-Reading'){
                    echo ' active';
                }?>">
              
              <i class="nav-icon fas fa-bolt"></i>
              <p>
                Meter Reading
              </p>
            </a>
          </li>

          

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ml-3">
              <li class="nav-item">
                <a href="<?php echo base_url()?>master/Company" class="nav-link">
                  <i class="far fa-building nav-icon"></i>
                  <p>User Assign Reports</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url()?>master/Company" class="nav-link">
                  <i class="far fa-building nav-icon"></i>
                  <p>Meter Reading Reports</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url()?>master/Company" class="nav-link">
                  <i class="far fa-building nav-icon"></i>
                  <p>Bill Upload Reports</p>
                </a>
              </li>
            </ul>
          </li>



          
          <li class="nav-item">
            <a href="<?php echo base_url('Log-Out'); ?>" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
        
              <p>
                Log Out
              </p>
            </a>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
    <?php print_r($main_content); ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2021-2022 <a href="<?php echo base_url(); ?>">Electricity Bill</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
</body>
</html>
