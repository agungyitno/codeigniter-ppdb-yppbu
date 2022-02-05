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

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <a class="navbar-brand d-flex text-primary" href="<?= base_url(); ?>">
            <div class="sidebar-brand-icon">
              <i class="fa fa-user-graduate"></i>
            </div>
            <div class="sidebar-brand-text mx-3"><b>PPDB Online</b></div>
          </a>
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

            <!-- Nav Item - User Information -->
            <?php if (empty($this->session->userdata('nama_lengkap'))) : ?>
              <div class="form-inline my-2 my-lg-0">
                <a href="<?= base_url('auth'); ?>" class="btn btn-primary my-2 my-sm-0">Login</a>
              </div>
              <div class="topbar-divider d-none d-sm-block"></div>
              <div class="form-inline my-2 my-lg-0">
                <a href="<?= base_url('daftar'); ?>" class="btn btn-primary my-2 my-sm-0">Daftar</a>
              </div>
            <?php else : ?>
              <li class="nav-item">
                <a class="nav-link text-info" href="<?= base_url('welcome'); ?>">
                  <i class="fas fa-tachometer-alt fa-sm fa-fw mr-2"></i>
                  Dashboard
                </a>
              </li>
              <div class="topbar-divider d-none d-sm-block"></div>
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
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>

            <?php endif; ?>

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
            <span>Copyright &copy; AgungYitno <?php echo date('Y'); ?> </span>
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
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
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
