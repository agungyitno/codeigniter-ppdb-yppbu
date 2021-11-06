
<div class="container-fluid">
    <section class="content">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h3 class="m-0 font-weight-bold text-primary">Tbl_setting</h3>
            </div>
            <div style="margin-top: 10px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>

            <div class="card-body">
            <div style="margin-bottom: 10px">
                <?php echo anchor(site_url('tbl_setting/create'), '<i class="fa fa-flag" aria-hidden="true"></i> Create', 'class="btn btn-success"'); ?>
		<?php echo anchor(site_url('tbl_setting/excel'), '<i class="fa fa-file-excel" aria-hidden="true"></i>Excel', 'class="btn btn-danger"'); ?>
		<?php echo anchor(site_url('tbl_setting/word'), '<i class="fa fa-file-word" aria-hidden="true"></i> Word', 'class="btn btn-warning"'); ?> </div>
	    
        
        <table class="table table-bordered " id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama Setting</th>
		    <th>Value</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table>
         </div>
         
      </div>
      </div>
      </section>
      </div>

        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>

        <!-- Page level plugins -->
        <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
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
                    ajax: {"url": "tbl_setting/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_setting",
                            "orderable": false
                        },{"data": "nama_setting"},{"data": "value"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
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
       
   