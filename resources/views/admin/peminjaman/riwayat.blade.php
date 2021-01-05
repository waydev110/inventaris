@extends('admin.layouts.admin-layout')
@section('title')
    {{$title}}
@endsection
@push('styles')
<style>
.jumbotron {
    margin-bottom: 0!important;
}
.table tbody tr td {
    padding:10px!important;
    vertical-align: middle
}
.table tbody tr td:first-child {
    padding:20px!important;
}
</style>
@endpush
@section('content')
    <!-- START PAGE CONTENT -->
    <div class="content sm-gutter">
		<!-- START JUMBOTRON -->
		<div class="jumbotron" data-pages="parallax">
			<div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
				<div class="">
					<div class="row">
						<div class="col-9">
							<div class="row">
								<!-- START BREADCRUMB -->
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="url('administrator')">DASHBOARD</a></li>
									<li class="breadcrumb-item active">{{$title}}</li>
								</ol>
								<!-- END BREADCRUMB -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END JUMBOTRON -->
		<!-- START CONTAINER FLUID -->
		<div class="container-fluid container-fixed-lg pt-3 pb-2">
			<div class="row p-l-15 p-r-15">
                <div class="col-md-8">
                    @if(auth()->user()->hasRole('user'))
                    <div class="form-group">
                        <a href="{{url($route.'create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Ajukan {{$title}}</a>
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search-table" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-default">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
		</div>
        <!-- END CONTAINER FLUID -->
		<!-- START CONTAINER FLUID -->
		<div class="container-fluid container-fixed-lg bg-white">
			<!-- START card -->
			<div class="card card-transparent">
				<div class="card-body">
                    <div class=" table-responsive">
    					<table class="table table-hover" id="data-table">
    						<thead>
    							<tr>
    								<th>No</th>
    								<th>Tanggal Ajuan</th>
    								<th>Lembaga</th>
    								<th>Peminjaman</th>
    								<th>Tanggal Mulai</th>
    								<th>Tanggal Selesai</th>
    								<th>Tujuan</th>
    								<th>Status</th>
    								<th>Aksi</th>
    							</tr>
    						</thead>
    						<tbody>
    						</tbody>
    					</table>
                    </div>
				</div>
			</div>
			<!-- END card -->
		</div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->


    <div class="modal fade stick-up" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                        <h5>Delete Data</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="delID" value="">
                        <p class="no-margin">Apakah anda yakin akan menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-cons  pull-left inline submit">Ya</button>
                        <button type="button" class="btn btn-default btn-cons no-margin pull-left inline" data-dismiss="modal">Tidak</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('scripts')
<script src="{{url('admin')}}/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{{url('admin')}}/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script src="{{url('admin')}}/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="{{url('admin')}}/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="{{url('admin')}}/assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="{{url('admin')}}/assets/plugins/datatables-responsive/js/lodash.min.js"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{url('admin')}}/pages/js/pages.js"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{url('admin')}}/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<script>
    var table;
    var role = "{{auth()->user()->hasRole('user')}}";
	$(document).ready( function () {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
        });

		@if(session('status'))
            notification('{{session('status')}}', 'success');
		@endif

        if($('#filter-container').html() == ''){
            $('#btnClearAll').hide();
        }

        table = $('#data-table').DataTable( {
            "sDom": "<t><'row'<p i>>",
            "oLanguage": {
                "sLengthMenu": "_MENU_ ",
                "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
            },
            "bProcessing": true,
            "bServerSide": true,
            "ajax": {
                url: "{{url('administrator/peminjaman/datatableRiwayat') }}",
                type: 'POST'
            },
            "pageLength": 10,
            "order": [[1, 'desc']],
            "columns":[
                {data: 'DT_RowIndex', name: 'id', searchable:false, orderable:false, class:"text-center"},
                {data: 'tanggal'},
                {data: 'lembaga.lembaga'},
                {data: 'barang.nama_barang'},
                {data: 'tanggal_mulai'},
                {data: 'tanggal_selesai'},
                {data: 'tujuan_penggunaan'},
                {data: 'status'},
                {data: 'Actions', responsivePriority: -1, searchable:false, orderable:false, class:"text-center"},
            ],
            "columnDefs": [
                {
                    targets: -2,
                    title: 'Status',
                    render: function(data, type, full, meta) {
                        var status = {
                            0: {'title': 'Menunggu', 'class': 'warning'},
                            1: {'title': 'Disetujui', 'class': 'success'},
                            2: {'title': 'Ditolak', 'class': 'danger'}
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return `<span class="label-${status[data].class} px-2 pb-1 btn-rounded">${status[data].title}</span>`;
                    },
                },
                {
                    targets: -1,
                    render: function(data, type, full, meta) {
                        if(full.status == 0 && role == true){
                            return `<div class="btn-group">
                                        <a href="{{url($route)}}/${full.id}" class="btn btn-xs"><i class="fa fa-desktop"></i></a>
                                        <a href="{{url($route)}}/${full.id}/edit" class="btn btn-xs"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" onclick="deleteData('${full.id}')"><i class="fa fa-trash-o"></i></button>
                                    </div>`;
                        } else {
                            return `<div class="btn-group">
                                        <a href="{{url($route)}}/${full.id}" class="btn btn-xs"><i class="fa fa-desktop"></i></a>
                                    </div>`;
                        }
                    },
                },
            ]
        });
        $('#search-table').keyup(function() {
            table.columns(1).search($(this).val()).draw();
        });
    });


    $('body').on('click', ".submit", function () {
            var requestBody = {
                "id": $('#delID').val()
            };
            $.ajax({
                url: "{{url($route.'delete')}}",
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(requestBody),
                beforeSend: function () {
                    $('#modal-delete').modal('hide');
                },
                error: function (data) {
                    console.log(data.responseText);
                    resp = JSON.parse(data.responseText);
                    notification(resp.message, 'error');
                },
                success: function (resp) {
                    notification(resp.message, 'success');
                    table.ajax.reload();
                },
                complete: function (xhr) {

                }
            });
    });

    function deleteData(id) {
        $('#modal-delete').modal('show');
        $('#delID').val(id);
        return true;
    };
</script>
@endsection
