@extends('admin.layouts.admin-layout')
@section('title', 'Dashboard')
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
									<li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
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
		<div class="container-fluid container-fixed-lg bg-white">
			<!-- START card -->
			<div class="card card-transparent">
				<div class="card-body">
                    Hello World!
				</div>
			</div>
			<!-- END card -->
		</div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->
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
@endsection
