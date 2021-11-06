<div class="container-fluid">
    <section class="content">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">Kelola <?= $title; ?></h3>
                </div>
                <div class="col-lg-12" style="margin-top: 10px" id="message">
                    <?= $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
                <div class="card-body">
                    <div style="margin-bottom: 10px">
                        <?= anchor(site_url($data_uri . '/create'), '<i class="fa fa-plus" aria-hidden="true"></i> Tambah data', 'class="btn btn-danger"'); ?>
                    </div>
                    <table class="table table-bordered " id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Nominal</th>
                                <th width="200px">Action</th>
                            </tr>
                        </thead>
                    </table>
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
                                    "url": "<?= $data_uri ?>/json",
                                    "type": "POST"
                                },
                                columns: [{
                                        "data": "id_gaji",
                                        "orderable": false
                                    }, {
                                        "data": "nominal"
                                    },
                                    {
                                        "data": "action",
                                        "orderable": false,
                                        "className": "text-center"
                                    }
                                ],
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
                </div>
            </div>
        </div>
    </section>
</div>