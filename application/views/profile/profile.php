<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div id="profil_list" class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card shadow mb-4">
                        <img src="<?= base_url('assets/foto_profil/') . $user->images; ?>" class="card-img-top bg-light" alt="...">
                        <div class="card-body">
                            <!-- <hr class="sidebar-divider"> -->
                            <div class="text-center mt-2">
                                <button class="btn btn-primary btn-icon-split" id="btn_edit">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit Profile</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary"><?= $title; ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <h6>Nama :</h6>
                                </div>
                                <div class="col-sm text-right">
                                    <h5 class="text-capitalize"><?= $user->nama_lengkap; ?></h5>
                                </div>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="row">
                                <div class="col-sm">
                                    <h6>Email :</h6>
                                </div>
                                <div class="col-sm text-right">
                                    <h5 class="text-capitalize"><?= $user->email; ?></h5>
                                </div>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="row">
                                <div class="col-sm">
                                    <h6>Level :</h6>
                                </div>
                                <div class="col-sm text-right">
                                    <h5 class="text-capitalize"><?= $level->nama_user_level; ?></h5>
                                </div>
                            </div>
                            <hr class="sidebar-divider">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="profil_edit" class="col-sm-12 d-none">

            <form class="form-group" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card shadow mb-4">
                            <img id="imgPreview" src="<?= base_url('assets/foto_profil/') . $user->images; ?>" class="card-img-top bg-light" alt="...">
                            <div class="card-body">
                                <!-- <hr class="sidebar-divider"> -->
                                <div>
                                    <input class="form-control" type="file" name="images" id="gambar">
                                    <small id="password_help" class="form-text text-muted">Biarkan kosong jika tidak ingin merubah foto profil!</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h3 class="m-0 font-weight-bold text-primary"><?= $title; ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?= $user->email; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                        <small id="password_help" class="form-text text-muted">Biarkan kosong jika tidak ingin merubah password!</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="<?= $user->nama_lengkap; ?>" required>
                                    </div>
                                </div>
                                <hr class="sidebar-divider">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="hidden" value="<?= $user->id_user; ?>">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Simpan</button>
                                        <button id="batal" type="button" class="btn btn-info"><i class="fa fa-times"></i> Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const prev_gambar = "<?= base_url('assets/foto_profil/') . $user->images; ?>";
    gambar.onchange = evt => {
        const [file] = gambar.files
        if (file) {
            imgPreview.src = URL.createObjectURL(file)
        }
    }
    $('#btn_edit').click(function() {
        $('#profil_list').addClass('d-none');
        $('#profil_edit').removeClass('d-none');
        $('#email').focus();
    });
    $('#batal').click(function() {
        $('#profil_list').removeClass('d-none');
        $('#profil_edit').addClass('d-none');
        $('#nama').val('');
        $('#password').val('');
        $('#imgPreview').attr("src", prev_gambar);
        $('#nama').val('<?= $user->nama_lengkap; ?>');
        $('#email').val('<?= $user->email; ?>');
    });
</script>