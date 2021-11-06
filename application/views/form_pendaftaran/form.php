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
                    <form action="<?= $action; ?>" method="post">
                        <table class='table table-borderless'>
                            <tr>
                                <td colspan="2">
                                    <h3>Data Siswa</h3>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Nama Lengkap</td>
                                <td>
                                    <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Nama Lengkap" value="<?= $nama_siswa; ?>" />
                                    <?= form_error('nama_siswa') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">NIK</td>
                                <td>
                                    <input maxlength="16" type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?= $nik; ?>" />
                                    <?= form_error('nik') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Jenis Kelamin</td>
                                <td>
                                    <div class="row ml-2">
                                        <div class="col-auto mr-4">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="L" <?= $jenis_kelamin == 'L' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="laki_laki">Laki-laki</label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" <?= $jenis_kelamin == 'P' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                    <?= form_error('jenis_kelamin') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Tempat Lahir</td>
                                <td>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= $tempat_lahir; ?>" />
                                    <?= form_error('tempat_lahir') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Tanggal Lahir</td>
                                <td>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= $tanggal_lahir; ?>" />
                                    <?= form_error('tanggal_lahir') ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h3>Data Orangtua</h3>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Nama Ayah</td>
                                <td>
                                    <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="Nama Ayah" value="<?= $nama_ayah; ?>" />
                                    <?= form_error('nama_ayah') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Pekerjaan</td>
                                <td>
                                    <?= cmb_dinamis('pekerjaan_ayah', 'tbl_mst_pekerjaan', 'nama_pekerjaan', 'id_pekerjaan', 'Pilih Pekerjaan Ayah', $pekerjaan_ayah); ?>
                                    <?= form_error('pekerjaan_ayah') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Gaji</td>
                                <td>
                                    <?= cmb_dinamis('gaji_ayah', 'tbl_mst_gaji', 'nominal', 'id_gaji', 'Pilih Gaji Ayah', $gaji_ayah); ?>
                                    <?= form_error('gaji_ayah') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Nama Ibu</td>
                                <td>
                                    <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Nama Ibu" value="<?= $nama_ibu; ?>" />
                                    <?= form_error('nama_ibu') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Pekerjaan</td>
                                <td>
                                    <?= cmb_dinamis('pekerjaan_ibu', 'tbl_mst_pekerjaan', 'nama_pekerjaan', 'id_pekerjaan', 'Pilih Pekerjaan Ibu', $pekerjaan_ibu); ?>
                                    <?= form_error('pekerjaan_ibu') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Gaji</td>
                                <td>
                                    <?= cmb_dinamis('gaji_ibu', 'tbl_mst_gaji', 'nominal', 'id_gaji', 'Pilih Gaji Ibu', $gaji_ibu); ?>
                                    <?= form_error('gaji_ibu') ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h3>Alamat</h3>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Provinsi</td>
                                <td>
                                    <select class="w-100" name="id_prov" id="id_prov">
                                        <option value="">Pilih Kabupaten</option>
                                        <?php $prov = $this->db->get('tbl_mst_provinsi')->result(); ?>
                                        <?php foreach ($prov as $p) : ?>
                                            <option value="<?= $p->id_provinsi; ?>"><?= $p->nama_provinsi; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('id_prov') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Kabupaten</td>
                                <td>
                                    <select class="w-100" name="id_kab" id="id_kab">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                    <?= form_error('id_kab') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Kecamatan</td>
                                <td>
                                    <select class="w-100" name="id_kec" id="id_kec">
                                        <option value=""></option>
                                    </select>
                                    <?= form_error('id_kec') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Desa/Kelurahan</td>
                                <td>
                                    <select class="w-100" name="kelurahan" id="kelurahan">
                                        <option value=""></option>
                                    </select>
                                    <?= form_error('kelurahan') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Alamat</td>
                                <td>
                                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Nomor jalan, RT, RW, dusun" value="<?= $alamat; ?>" />
                                    <?= form_error('alamat') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Nomor Telepon</td>
                                <td>
                                    <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Nomor Telepon" value="<?= $no_telp; ?>" />
                                    <?= form_error('no_telp') ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h3>Keterangan Siswa</h3>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Asal Sekolah</td>
                                <td>
                                    <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah" placeholder="Asal Sekolah" value="<?= $asal_sekolah; ?>" />
                                    <?= form_error('asal_sekolah') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Tahun Lulus</td>
                                <td>
                                    <input type="text" class="form-control" name="tahun_lulus" id="tahun_lulus" placeholder="Tahun Lulus" value="<?= $tahun_lulus; ?>" />
                                    <?= form_error('tahun_lulus') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Sekolah yang dituju</td>
                                <td>
                                    <?= cmb_dinamis('id_sekolah', 'tbl_mst_sekolah', 'nama_sekolah', 'id_sekolah', 'Sekolah yang dituju', $id_sekolah); ?>
                                    <?= form_error('id_sekolah') ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="200">Apakah Mondok?</td>
                                <td>
                                    <div class="row ml-2">
                                        <div class="col-auto mr-4">
                                            <input class="form-check-input" type="radio" name="daftar_asrama" id="ya" value="Y" <?= $daftar_asrama == 'Y' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="ya">Ya</label>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-check-input" type="radio" name="daftar_asrama" id="tidak" value="T" <?= $daftar_asrama == 'T' ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="tidak">Tidak</label>
                                        </div>
                                    </div>
                                    <!-- <?= cmb_dinamis('id_asrama', 'tbl_mst_asrama', 'nama_asrama', 'id_asrama', 'Tidak tinggal di pondok', $id_asrama); ?> -->
                                    <?= form_error('daftar_asrama') ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="hidden" name="id_formulir" value="<?= $id_formulir; ?>" />
                                    <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user'); ?>" />
                                    <button id="submit" type="submit" class="btn btn-danger"><i class="fa fa-paper-plane"></i> <?= $button ?></button>
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
<div id="rekomendasi_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sekolah yang dituju</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success text-center" id="info_kuota"></div>
                <div class="form-group">
                    <select name="sekolah_temp" id="sekolah_temp" class="form-control">

                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('input[name=nik]').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        });
        $('input[name=no_telp]').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        });
        $('input[name=tahun_lulus]').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
        });
        //untuk memanggil plugin select2
        $('select[name=id_sekolah]').on('change', function() {
            // console.log($('select[name=id_sekolah] :selected').prop('label'));
            // console.log($('#asal_sekolah').val());
            if ($('#asal_sekolah').val() == $('select[name=id_sekolah] :selected').prop('label')) {
                $(this).val('').change();
                alert('Sekolah yang dituju tidak boleh sama dengan asal sekolah!');
            } else {
                if ($(this).val() != '') {
                    $.ajax({
                        url: "<?= base_url('form_pendaftaran/cek_kuota/'); ?>/" + $(this).val(),
                        method: "get",
                        success: function(response) {
                            // console.log(response);
                            if (response != 'tersedia') {
                                var data = '<option value="">Pilih sekolah yang dituju</option>';
                                var rekomen = $.parseJSON(response);
                                $.each(rekomen, function(i, kolom) {
                                    data += '<option value="' + kolom.id_sekolah + '">' + kolom.nama_sekolah + ' | Tersedia ' + kolom.sisa_kuota + '</span></option>';
                                });
                                var pilih_sekolah = $('select[name=id_sekolah] :selected').prop('label');
                                $('#info_kuota').html('Kuota untuk ' + pilih_sekolah + ' sudah penuh. Berikut rekomendasi sekolah yang setingkat dengan ' + pilih_sekolah);
                                $('#sekolah_temp').html(data);
                                $('#rekomendasi_modal').modal('show');
                                $('select[name=id_sekolah]').val('').change();
                            }
                        }
                    });
                }

            }
        });
        $('select[name=sekolah_temp]').on('change', function() {
            $('#rekomendasi_modal').modal('hide');
            var id_sekolah_temp = $(this).val();
            // console.log(id_sekolah_temp);
            $('select[name=id_sekolah]').val(id_sekolah_temp).change();
        });
        $('input[name=asal_sekolah]').keyup(function() {
            // console.log($('select[name=id_sekolah] :selected').prop('label'));
            console.log($('#asal_sekolah').val());
            if ($(this).val() == $('select[name=id_sekolah] :selected').prop('label')) {
                $(this).val('');
                alert('Sekolah yang dituju tidak boleh sama dengan asal sekolah!');
            }
        });
        $('select[name=pekerjaan_ayah]').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Pekerjaan Ayah',
            language: "id"
        });
        $('select[name=gaji_ayah]').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Gaji Ayah',
            language: "id"
        });
        $('select[name=pekerjaan_ibu]').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Pekerjaan Ibu',
            language: "id"
        });
        $('select[name=gaji_ibu]').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Gaji Ibu',
            language: "id"
        });
        $('select[name=id_sekolah]').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Sekolah Yang Dituju',
            language: "id"
        });
        $('#id_prov').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Provinsi',
            language: "id"
        });
        $('#id_kab').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Kabupaten',
            language: "id"
        });
        $('#id_kec').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Kecamatan',
            language: "id"
        });
        $('#kelurahan').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Desa/Kelurahan',
            language: "id"
        });
        $('#sekolah_temp').select2({
            theme: 'bootstrap4',
            placeholder: 'Pilih Sekolah',
            language: "id"
        });

        $("#id_prov").change(function() {
            var id_provinces = $(this).val();
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?= base_url('wilayah/index') ?>",
                data: {
                    prov: id_provinces
                },
                success: function(msg) {
                    $("select#id_kab").html(msg);
                    $("select#id_kab").val('').change();
                }
            });
        });
        $("#id_kab").change(function() {
            var id_regenci = $(this).val();
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?= base_url('wilayah/index') ?>",
                data: {
                    kab: id_regenci
                },
                success: function(msg) {
                    $("select#id_kec").html(msg);
                    $("select#id_kec").val('').change();
                }
            });
        });
        $("#id_kec").change(function() {
            var id_kec = $(this).val();
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?= base_url('wilayah/index') ?>",
                data: {
                    kec: id_kec
                },
                success: function(msg) {
                    $("select#kelurahan").html(msg);
                    $("select#kelurahan").val('').change();
                }
            });
        });
    });
</script>