@extends('admin.layouts.admin-layout')
@section('title', 'Tampil '.$title)
@push('styles')
<link href="{{url('admin')}}/assets/plugins/owl-carousel/assets/owl.carousel.min.css" rel="stylesheet" type="text/css">
<link href="{{url('admin')}}/assets/plugins/owl-carousel/assets/owl.theme.default.css" rel="stylesheet" type="text/css">
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
                                    <li class="breadcrumb-item"><a href="{{url('administrator')}}">DASHBOARD</a></li>
                                    <li class="breadcrumb-item"><a href="{{url($route.'index')}}">BARANG</a></li>
                                    <li class="breadcrumb-item active">TAMPIL {{$title}}</li>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <a href="{{url($route)}}" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Kembali</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pull-right">
                        <a href="{{url($route.$data->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fa fa-pencil-square"></i> Edit {{$title}}</a>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Detail Barang</h3>
                        </div>
                        <div class="col-sm-3">
                            <img src="{{url('images/barang/'.$data->gambar)}}" width="100%">
                        </div>
                        <div class="col-sm-9">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td width="200">Kode Barang</td>
                                        <td>:</td>
                                        <td>{{$data->kode_barang}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Barang</td>
                                        <td>:</td>
                                        <td>{{$data->nama_barang}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>:</td>
                                        <td>{{$data->kategori->nama_kategori}}</td>
                                    </tr>
                                    <tr>
                                        <td>Spesifikasi</td>
                                        <td>:</td>
                                        <td>{!! $data->spesifikasi !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
				</div>
			</div>
			<!-- END card -->
		</div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->
@endsection
@section('scripts')
<script src="{{url('admin')}}/assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
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
<script>
    $(document).ready(function() {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            center: true,
            loop: false,
            nav: false,
            margin: 0,
            items: 1
        });
        owl.on('mousewheel', '.owl-stage', function(e) {
            if (e.deltaY > 0) {
                owl.trigger('next.owl');
            } else {
                owl.trigger('prev.owl');
            }
            e.preventDefault();
        });
    });
</script>
<!-- END PAGE LEVEL JS -->
@endsection
