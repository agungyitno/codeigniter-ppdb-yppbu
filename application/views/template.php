<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo config_item('web_title'); ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->

  <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/select2/css/select2-bootstrap4.min.css" rel="stylesheet">


  <!-- Custom styles for this page -->
  <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script>
    var habiscuy;
    $(document).on({
      ajaxStart: function() {
        habiscuy = setTimeout(function() {
          $("#LoadingDulu").html("<div id='LoadingContent'><i class='fa fa-spinner fa-spin'></i> Mohon tunggu ....</div>");
          $("#LoadingDulu").show();
        }, 500);
      },
      ajaxStop: function() {
        clearTimeout(habiscuy);
        $("#LoadingDulu").hide();
      }
    });
  </script>
</head>

<body id="page-top">
  <div id='LoadingDulu'></div>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url('welcome'); ?>">
        <div class="sidebar-brand-text mx-3">PPDB Online<br><small>YPP Bahrul 'Ulum</small></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('welcome'); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->

      <?php
      // chek settingan tampilan menu
      $setting = $this->db->get_where('tbl_setting', array('id_setting' => 1))->row_array();
      if ($setting['value'] == 'ya') {
        // cari level user
        $id_user_level = $this->session->userdata('id_user_level');
        $sql_menu = "SELECT * 
            FROM tbl_menu 
            WHERE id_menu in(select id_menu from tbl_hak_akses where id_user_level='$id_user_level') and is_main_menu=0 and is_aktif='y'";
      } else {
        $sql_menu = "SELECT * from tbl_menu where is_aktif='y' and is_main_menu='0'";
      }

      $main_menu = $this->db->query($sql_menu)->result();

      ?>

      <?php foreach ($main_menu as $menu) {
        $sql_menu = "SELECT * 
        FROM tbl_menu 
        WHERE id_menu in(select id_menu from tbl_hak_akses where id_user_level='$id_user_level') and is_main_menu=$menu->id_menu and is_aktif='y'";
        $submenu = $this->db->query($sql_menu);
        // chek is have sub menu
        // $this->db->where('is_main_menu', $menu->id_menu);
        // $this->db->where('is_aktif', 'y');
        // $submenu = $this->db->get('tbl_menu');
        if ($submenu->num_rows() > 0) {
          // display sub menu

          echo " <li class='nav-item'><a class='nav-link collapsed' href='#'' data-toggle='collapse' data-target='#" . $menu->url . "' aria-expanded='false' aria-controls='collapsePages'>
                      <i class='fas fa-fw fa-folder'></i>
                      <span>" . strtoupper($menu->nama_menu) . "</span>
                    </a>
                  <div id='" . $menu->url . "' class='collapse' aria-labelledby='headingPages' data-parent='#accordionSidebar'>
                  <div class='bg-white py-2 collapse-inner rounded'>";
          foreach ($submenu->result() as $sub) {
            echo "<a class='collapse-item' href='" . site_url($sub->url) . "'><i class='" . $sub->icon . "'></i>" . strtoupper($sub->nama_menu) . "</a>";
          }
          echo "       </div>
                    </div>
                  </li>";
        } else {
          // display main menu
          echo " <li class='nav-item '>
                      <a class='nav-link' href='" . site_url($menu->url) . "'>

                      <i class='" . $menu->icon . "'></i>
                      <span>" . strtoupper($menu->nama_menu) . "</span></a>
                    </li>";
        }
      }
      ?>



      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Logout -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('auth/logout'); ?>">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Logout</span></a>
      </li>



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

          <!-- Topbar Search 
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('nama_lengkap'); ?></span>
                <img class="img-profile rounded-circle" src="<?php echo base_url() ?>assets/foto_profil/<?php echo $this->session->userdata('images'); ?> ">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo site_url('profile'); ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <?php echo $contents; ?>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Unwaha <?php echo date('Y'); ?> </span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik tombol "Logout" dibawah untuk mengakhiri sesi saat ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="<?php echo site_url('auth/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="ModalGue" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class='fa fa-times-circle'></i></button>
          <h4 class="modal-title" id="ModalHeader"></h4>
        </div>
        <div class="modal-body" id="ModalContent"></div>
        <div class="modal-footer" id="ModalFooter"></div>
      </div>
    </div>
  </div>

  <script>
    $('#ModalGue').on('hide.bs.modal', function() {
      setTimeout(function() {
        $('#ModalHeader, #ModalContent, #ModalFooter').html('');
      }, 500);
    });
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/vendor/select2/js/select2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/select2/js/i18n/id.js"></script>
  <script>
    function invalidInput(el) {
      $(el).addClass('is-invalid');
      $(el).attr('oninput', 'startInput(this)');
      var id = $(el).attr('id');
      var label = $('label[for="' + id + '"]');
      $('.invalid-' + id).remove();
      $(el).after('<div class="invalid-feedback invalid-' + id + '">\
                        Harap masukkan ' + label.html() + '!\
                    </div>')
    }

    function startInput(el) {
      $(el).removeClass('is-invalid');
    }
  </script>
</body>

</html>