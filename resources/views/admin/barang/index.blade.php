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
									<li class="breadcrumb-item active">BARANG</li>
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
                    <div class="form-group">
                        <a href="{{url($route.'create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Tambah {{$title}}</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search-table" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-default" data-toggle="filters" data-toggle-element="#filters" id="btnFilters"><i class="fa fa-filter"></i> Filter</button>
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
    								<th width="80">No</th>
    								<th width="100">Kode Barang</th>
    								<th>Nama Barang</th>
    								<th>Kategori</th>
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
        <div class="quickview-wrapper" id="filters">
            <div class="padding-40 ">
                <a class="builder-close quickview-toggle pg-close" data-toggle="quickview" data-toggle-element="#filters" href="#"></a>
                <form class="" role="form">
                    <h5 class="all-caps font-montserrat fs-12 m-b-10">Filter {{$title}} <a href="javascript:void(0)" class="text-danger" id="btnClearAll"><span class="pg-arrow_lright_line_alt"></span> Clear All</a></h5>
                    <div id="filter-container"></div>
                    <h5 class="all-caps font-montserrat fs-12 m-b-10 m-t-20">Kategori</h5>
                    <div class="radio radio-danger">
                        @foreach ($categories as $item)
                            <input type="radio" value="{{$item->id}}" name="kategori" id="{{$item->id}}">
                            <label for="{{$item->id}}">{{$item->nama_kategori}}</label>
                            <br>
                        @endforeach
                    </div>
                    <button class="pull-right btn btn-danger btn-cons m-t-20" id="btnClose">Close</button>
                </form>
            </div>
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
                url: "{{url($route.'datatable') }}",
                type: 'POST',
                data: function (d){
                    var kategori = $('input[name=kategori]:checked').val();
                    var formData = {
                        'kategori' : kategori,
                    }
                    var data = $.extend( {}, d, formData);
                    return data;
                }
            },
            "pageLength": 10,
            "order": [[1, 'desc']],
            "columns":[
                {data: 'DT_RowIndex', name: 'id', searchable:false, orderable:false, class:"text-center"},
                {data: 'kode_barang', class:"text-center"},
                {data: 'nama_barang'},
                {data: 'kategori.nama_kategori', class:"text-center"},
                {data: 'Actions', responsivePriority: -1, searchable:false, orderable:false, class:"text-center"},
            ],
            "columnDefs": [
                {
                    targets: -1,
                    render: function(data, type, full, meta) {
                        return `<div class="btn-group">
                                    <a href="{{url($route)}}/${full.id}" class="btn btn-xs"><i class="fa fa-desktop"></i></a>
                                    <a href="{{url($route)}}/${full.id}/edit" class="btn btn-xs"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-xs btn-danger" onclick="deleteData('${full.id}')"><i class="fa fa-trash-o"></i></button>
                                </div>`;
                    },
                },
            ],
            "drawCallback" : function(settings){
                if( $('#filter-container').html() == ''){
                    $('#btnFilters').removeClass('btn-danger').addClass('btn-default');
                } else {
                    $('#btnFilters').removeClass('btn-default').addClass('btn-danger');
                }
            }
        });
        // t.on( 'order.dt search.dt', function () {
        // 	t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        // 		cell.innerHTML = i+1;
        // 	} );
        // } ).draw();
        // search box for table
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

    $('body').on('click', ".radio input[type=radio]", function (e) {
        var filterGroup = $(this).attr('name');
        var label = $(this).next().text();
        var name = $(this).attr('id');
        var Filter = $('#filter-container').find('.'+filterGroup);
        if(Filter.length > 0){
            Filter.remove();
        }
        if($(this).is(":checked")){
            var arrColor = ['info','warning','danger','success','primary'];
            var color = arrColor[Math.floor(Math.random()*arrColor.length)];
            var html = `<button class="btn btn-xs btn-rounded btn-${color} m-1 font-montserrat ${filterGroup}" data-filter="${filterGroup}" data-name="${name}" id="clear-filter">${label} <i class="card-icon card-icon-close"></i></button>`;
            $('#filter-container').append(html);
            $('#btnClearAll').show();
        }
        table.draw();
    });

    $('body').on('click', "#clear-filter", function (e) {
        var filter = $(this).data('name');
        $('#'+filter).prop("checked", false);
        $(this).remove();
        if($('#filter-container').html() == ''){
            $('#btnClearAll').hide();
        }
        table.draw();
        e.preventDefault();
    });

    $('body').on('click', "#btnClearAll", function (e) {
        $('input[type=radio]').prop("checked", false);
        $('#filter-container').html('');
        table.draw();
        $('#btnClearAll').hide();
        $('#filters').toggleClass('open');
        e.preventDefault();
    });

    $('body').on('click', "#btnClose", function (e) {
        $('#filters').toggleClass('open');
        e.preventDefault();
    });

    $('[data-toggle="filters"]').click(function() {
        $('#filters').toggleClass('open');
    });
</script>
@endsection
