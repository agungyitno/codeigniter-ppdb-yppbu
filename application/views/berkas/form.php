<div class="container-fluid">
    <section class="content">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">
                        <?= $title; ?>
                    </h3>
                </div>
                <div class="card-body">
                    <form id="berkas" action="<?= $action; ?>" method="post" enctype="multipart/form-data">
                        <table class='table table-borderless'>
                            <tr>
                                <td width="200">Ijazah</td>
                                <td>
                                    <input accept="application/pdf" type="file" class="form-control" name="ijazah" id="ijazah" placeholder="Ijazah" required />
                                    <?= form_error('ijazah') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">SKHUN</td>
                                <td>
                                    <input accept="application/pdf" type="file" class="form-control" name="skhun" id="skhun" placeholder="SKHUN" required />
                                    <?= form_error('skhun') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Nilai Raport</td>
                                <td>
                                    <input accept="application/pdf" type="file" class="form-control" name="nilai" id="nilai" placeholder="Nilai" required />
                                    <?= form_error('nilai') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Kartu Keluarga</td>
                                <td>
                                    <input accept="application/pdf" type="file" class="form-control" name="kk" id="kk" placeholder="Kartu Keluarga" required />
                                    <?= form_error('kk') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">KTP Orangtua</td>
                                <td>
                                    <input accept="application/pdf" type="file" class="form-control" name="ktp_ortu" id="ktp_ortu" placeholder="KTP Orangtua" required />
                                    <?= form_error('ktp_ortu') ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input id="id_user" type="hidden" name="id_user" value="<?= $id_user; ?>" />
                                    <button id="submit_berkas" type="button" class="btn btn-danger"><i class="fa fa-paper-plane"></i> <?= $button ?></button>
                                    <a href="<?= site_url('welcome') ?>" class="btn btn-info"><i class="fa fa-sign-out-alt"></i> Kembali</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $('#submit_berkas').click(function() {
        if (upload_berkas('ijazah', 'IJAZAH')) {
            if (upload_berkas('skhun', 'SKHUN')) {
                if (upload_berkas('nilai', 'NILAI')) {
                    if (upload_berkas('kk', 'KARTU_KELUARGA')) {
                        if (upload_berkas('ktp_ortu', 'KTP_ORANGTUA')) {
                            location.href = '<?= base_url('berkas'); ?>';
                        }
                    }
                }
            }
        }
    });
    $('#kk').on('change', validasi());
    $('#kk').on('change', validasi());
    $('#kk').on('change', validasi());

    function upload_berkas(id, nama) {
        var uploaded = false;
        var formData = new FormData();
        formData.append('id_user', $('#id_user').val());
        formData.append('nama', '_' + nama);
        formData.append('berkas', $('#' + id)[0].files[0]);
        $.ajax({
            url: '<?= base_url('berkas/upload'); ?>',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            success: function(response) {
                console.log(response);
                if (response.status == 'success') {
                    uploaded = true;
                } else {
                    uploaded = false;
                }
            },
            error: function(error) {
                // console.log(error);
                uploaded = false;
            }
        });
        return uploaded;
    }
</script>