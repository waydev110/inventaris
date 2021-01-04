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
                                        <li class="breadcrumb-item active">BUAT AJUAN</li>
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
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Ajukan Peminjaman</button>
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
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <h5>Data Peminjaman</h5>
                                        <label>Peminjaman</label>
                                        <span class="help text-danger"></span>
                                        <select name="barang" id="barang" class="form-control">
                                            @foreach ($barangs as $barang)
                                            <option value="{{$barang->id}}" {{(old('barang') == $barang->id) ? "selected" : ""}}>{{$barang->nama_barang}}</option>
                                            @endforeach
                                        </select>
                                        <a href="javascript:;" id="jadwal">Lihat Jadwal Peminjaman</a>
                                        <br>
                                        @error('lembaga')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <label>Tanggal</label>
                                        <span class="help text-danger"></span>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="input-group">
                                                    <input type="text" name="tanggal_mulai" class="form-control tanggal" value="{{old('tanggal_mulai')}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                                @error('tanggal_mulai')
                                                <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="col-sm-2 text-center">
                                                <label class="mt-2">s/d</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="input-group">
                                                    <input type="text" name="tanggal_selesai" class="form-control tanggal" autocomplete="off" value="{{old('tanggal_selesai')}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                                @error('tanggal_selesai')
                                                <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <label>Jam</label>
                                        <span class="help text-danger"></span>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <input type="time" name="jam_mulai" class="form-control" value="{{old('jam_mulai')}}">
                                                @error('jam_mulai')
                                                <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="col-sm-2 text-center">
                                                <label class="mt-2">s/d</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="time" name="jam_selesai" class="form-control" autocomplete="off" value="{{old('jam_selesai')}}">
                                                @error('jam_selesai')
                                                <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <label>Tujuan Penggunaan</label>
                                        <span class="help text-danger"></span>
                                        <input type="text" name="tujuan_penggunaan" class="form-control" value="{{old('tujuan_penggunaan')}}">
                                        @error('tujuan_penggunaan')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <br>
                                        <label>Keterangan</label>
                                        <span class="help text-danger"></span>
                                        <textarea name="keterangan" class="form-control">{{old('keterangan')}}</textarea>
                                        @error('keterangan')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <h5>Penanggung Jawab</h5>
                                        <label>Nama</label>
                                        <span class="help text-danger"></span>
                                        <input type="text" name="nama" class="form-control" value="{{old('nama')}}">
                                        @error('nama')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <br>
                                        <label>NIK</label>
                                        <span class="help text-danger"></span>
                                        <input type="text" name="nik" class="form-control" value="{{old('nik')}}">
                                        @error('nik')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <br>
                                        <label>Lembaga</label>
                                        <span class="help text-danger"></span>
                                        <input type="text" name="lembaga" class="form-control" value="{{$lembaga}}" disabled>
                                        @error('lembaga')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <br>
                                        <label>Jabatan</label>
                                        <span class="help text-danger"></span>
                                        <input type="text" name="jabatan" class="form-control" value="{{old('jabatan')}}">
                                        @error('jabatan')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <br>

                                        <label>Alamat</label>
                                        <span class="help text-danger"></span>
                                        <input type="text" name="alamat_rumah" class="form-control" value="{{old('alamat_rumah')}}">
                                        @error('alamat_rumah')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <br>

                                        <label>No Telepon</label>
                                        <span class="help text-danger"></span>
                                        <input type="text" name="no_hp" class="form-control" value="{{old('no_hp')}}">
                                        @error('no_hp')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
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

    <div class="modal fade slide-up" id="modal-jadwal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                        <h5>Data Peminjaman</h5>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="data-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Lembaga</th>
                                        <th class="text-center">Tanggal Mulai</th>
                                        <th class="text-center">Tanggal Selesai</th>
                                    </tr>
                                </thead>
                                <tbody id="listjadwal">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-cons no-margin pull-left inline" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

        $('.tanggal').datepicker({
            format:"dd/mm/yyyy",
            autoclose: true
        });


        $('#jadwal').on('click', function () {
                var requestBody = {
                    "id": $('#barang').val()
                };
            $.ajax({
                url: "{{url($route.'jadwal')}}",
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(requestBody),
                error: function (data) {
                    console.log(data.responseText);
                    resp = JSON.parse(data.responseText);
                    notification(resp.message, 'error');
                },
                success: function (resp) {
                    var data = resp.data;
                    var barang = resp.barang;
                    var record = '';
                    if(data.length > 0){
                        $.each(data, function(index, value){
                            record +=`<tr>
                                <td>${index+1}</td>
                                <td class="text-center">${value.lembaga.lembaga}</td>
                                <td class="text-right">${value.tanggal_mulai}</td>
                                <td class="text-right">${value.tanggal_selesai}</td>
                            </tr>`;
                        })

                    } else {
                            record +=`<tr>
                                <td colspan="4">Belum ada jadwal peminjaman</td>
                            </tr>`;
                    }
                    $('#listjadwal').html('');
                    $('#listjadwal').html(record);
                    $('.modal-header h5').text('Jadwal Peminjaman '+barang);
                    $('#modal-jadwal').modal('show');
                },
                complete: function (xhr) {

                }
            });
        });
    });
</script>
@endsection
