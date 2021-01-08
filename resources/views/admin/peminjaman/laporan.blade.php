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
        <form role="form" method="GET" enctype="multipart/form-data" action="{{url('laporan')}}">
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
                                        <li class="breadcrumb-item active">BUAT LAPORAN</li>
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
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <h5>Laporan Peminjaman</h5>
                                        <label>Tahun</label>
                                        <span class="help text-danger"></span>
                                        <select name="tahun" id="tahun" class="form-control">
                                            @for($i=2020;$i<=date('Y');$i++)
                                            <option value="{{$i}}" {{(old('tahun', date('Y')) == $i) ? "selected" : ""}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                        <br>
                                        @error('tahun')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <label>Bulan</label>
                                        <span class="help text-danger"></span>
                                        <select name="bulan" id="bulan" class="form-control">
                                            @foreach($months as $index => $month)
                                            <option value="{{$index}}" {{(old('bulan', date('m')) == $index) ? "selected" : ""}}>{{$month}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        @error('bulan')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <label>Lembaga</label>
                                        <span class="help text-danger"></span>
                                        <select name="lembaga" id="lembaga" class="form-control">
                                            <option value="">Semua Lembaga</option>
                                            @foreach($institutions as $lembaga)
                                            <option value="{{$lembaga->lembaga}}" {{(old('lembaga') == $lembaga->lembaga) ? "selected" : ""}}>{{$lembaga->lembaga}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        @error('lembaga')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <label>Nama Barang</label>
                                        <span class="help text-danger"></span>
                                        <select name="barang" id="barang" class="form-control">
                                            <option value="">Semua Barang</option>
                                            @foreach ($barangs as $barang)
                                            <option value="{{$barang->id}}" {{(old('barang') == $barang->id) ? "selected" : ""}}>{{$barang->nama_barang}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        @error('bulan')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <div class="form-group pull-right">
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Tampilkan Laporan</button>
                                        </div>
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

        $('.tanggal').datepicker({
            format:"dd/mm/yyyy",
            autoclose: true
        });
    });
</script>
@endsection
