@extends('admin.layouts.admin-layout')
@section('title')
    Tambah {{$title}}
@endsection
@push('styles')
    <link href="{{url('admin')}}/assets/plugins/summernote/css/summernote.css" rel="stylesheet" type="text/css" media="screen">
<style>
.jumbotron {
    margin-bottom: 0!important;
}
</style>
@endpush
@section('content')
    <!-- START PAGE CONTENT -->
    <div class="content sm-gutter">
        <form role="form" method="POST" enctype="multipart/form-data" action="{{url($route)}}">
            @csrf
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
                                        <li class="breadcrumb-item"><a href="{{url($route)}}">{{$title}}</a></li>
                                        <li class="breadcrumb-item active">TAMBAH</li>
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
                            <a href="{{url($route)}}" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan</button>
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
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <label>Nama Lembaga</label>
                                        <span class="help text-danger"></span>
                                        <input type="text" name="lembaga" class="form-control" value="{{old('lembaga')}}">
                                        @error('lembaga')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <br>
                                        <label>Status</label>
                                        <span class="help"></span>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <select name="status" class="form-control">
                                                    <option value="0" {{(old('status') == "0") ? "selected" : ""}}>Tidak Aktif</option>
                                                    <option value="1" {{(old('status') == "1") ? "selected" : ""}}>Aktif</option>
                                                </select>
                                            </div>
                                        </div>
                                        @error('status')
                                        <p class="hint-text small text-danger"><i class="fa fa-terminal"></i> {{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END card -->
            </div>
            <!-- END CONTAINER FLUID -->
        </form>
    </div>
    <!-- END PAGE CONTENT -->

    <!-- Modal -->
    <div class="modal fade slide-up disable-scroll" id="modalNotif" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                        <h5></h5>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
@endsection
@section('scripts')
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{url('admin')}}/assets/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
<script src="{{url('admin')}}/assets/plugins/summernote/js/summernote.min.js" type="text/javascript"></script>
<script src="{{url('admin')}}/pages/js/pages.js"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{url('admin')}}/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
<script>
	$(document).ready( function () {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
        });
    });
</script>
@endsection
