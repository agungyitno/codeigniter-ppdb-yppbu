<div class="container-fluid">
    <section class="content">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary"><?= $title; ?> Jumlah Calon Siswa</h3>
                </div>
                <div class="col-lg-12" style="margin-top: 10px" id="message">
                    <?= $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
                <div class="card-body">
                    <!-- <div style="margin-bottom: 10px">
                        <?= anchor(site_url($data_uri . '/create'), '<i class="fa fa-plus" aria-hidden="true"></i> Tambah data', 'class="btn btn-danger"'); ?>
                    </div> -->
                    <table class="table table-bordered " id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Nama Sekolah</th>
                                <th>Calon Pendaftar</th>
                                <th>Kuota</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary"><?= $title; ?> Kota Asal Calon Siswa</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered " id="daerah_asal">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Nama Sekolah</th>
                                <th>Kota Asal</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary"><?= $title; ?> Asal Sekolah Calon Siswa</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered " id="sekolah_asal">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Nama Sekolah</th>
                                <th>Asal Sekolah</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?= base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $("#mytable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {
                "url": "<?= base_url($data_uri); ?>/json_kuota",
                "type": "POST"
            },
            columns: [{
                "data": "id",
                "orderable": false
            }, {
                "data": "nama_sekolah"
            }, {
                "data": "jumlah"
            }, {
                "data": "kuota"
            }],
            order: [
                [2, 'desc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
        var t = $("#daerah_asal").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#daerah_asal_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {
                "url": "<?= base_url($data_uri); ?>/json_asal_kota",
                "type": "POST"
            },
            columns: [{
                "data": "id",
                "orderable": false
            }, {
                "data": "nama_sekolah"
            }, {
                "data": "nama_kab"
            }, {
                "data": "jumlah"
            }],
            order: [
                [0, 'desc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
        var t = $("#sekolah_asal").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#sekolah_asal_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {
                "url": "<?= base_url($data_uri); ?>/json_asal_sekolah",
                "type": "POST"
            },
            columns: [{
                "data": "id",
                "orderable": false
            }, {
                "data": "nama_sekolah"
            }, {
                "data": "asal"
            }, {
                "data": "jumlah"
            }],
            order: [
                [0, 'desc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>