@extends('admin.layouts.admin-layout')
@section('title', 'Detail '.$title)
@push('styles')
<link href="{{url('admin')}}/assets/plugins/owl-carousel/assets/owl.carousel.min.css" rel="stylesheet" type="text/css">
<link href="{{url('admin')}}/assets/plugins/owl-carousel/assets/owl.theme.default.css" rel="stylesheet" type="text/css">
<style>
.jumbotron {
    margin-bottom: 0!important;
}
.table tbody tr td {
    padding: 10px 0px;
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
                                    <li class="breadcrumb-item"><a href="{{url($route.'index')}}">PEMINJAMAN</a></li>
                                    <li class="breadcrumb-item active">DETAIL {{$title}}</li>
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
                        @if(auth()->user()->hasRole('user'))
                        <a href="{{url($route)}}" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Kembali</a>
                        @endif
                        @if(auth()->user()->hasRole('admin'))
                        <a href="{{url('administrator/peminjaman')}}" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Kembali</a>
                        @endif
                    </div>
                </div>
                @if($data->status == 0 && auth()->user()->hasRole('user'))
                <div class="col-md-6">
                    <div class="form-group pull-right">
                        <a href="{{url($route.$data->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fa fa-pencil-square"></i> Edit {{$title}}</a>
                    </div>
                </div>
                @endif
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
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td colspan="3"><strong>Detail Peminjaman</strong></td>
                                    </tr>
                                    <tr>
                                        <td width="200">Peminjaman</td>
                                        <td width="20">:</td>
                                        <td>{{$data->barang->nama_barang}}</td>
                                    </tr>
                                    <tr>
                                        <td width="200">Tanggal Mulai</td>
                                        <td width="20">:</td>
                                        <td>{{$data->tanggal_mulai->format('d/m/Y')}}</td>
                                    </tr>
                                    <tr>
                                        <td width="200">Tanggal Selesai</td>
                                        <td width="20">:</td>
                                        <td>{{$data->tanggal_selesai->format('d/m/Y')}}</td>
                                    </tr>
                                    <tr>
                                        <td width="200">Jam Mulai</td>
                                        <td width="20">:</td>
                                        <td>{{$data->tanggal_mulai->format('H:i')}}</td>
                                    </tr>
                                    <tr>
                                        <td width="200">Jam Selesai</td>
                                        <td width="20">:</td>
                                        <td>{{$data->tanggal_selesai->format('H:i')}}</td>
                                    </tr>
                                    <tr>
                                        <td width="200">Tujuan Penggunaan</td>
                                        <td width="20">:</td>
                                        <td>{{$data->tujuan_penggunaan}}</td>
                                    </tr>
                                    <tr>
                                        <td width="200">Keterangan</td>
                                        <td width="20">:</td>
                                        <td>{{$data->keterangan}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><strong>Penanggung Jawab</strong></td>
                                    </tr>
                                    <tr>
                                        <td width="200">Nama</td>
                                        <td width="20">:</td>
                                        <td>{{$data->nama}}</td>
                                    </tr>
                                    <tr>
                                        <td width="200">NIK</td>
                                        <td width="20">:</td>
                                        <td>{{$data->nik}}</td>
                                    </tr>
                                    <tr>
                                        <td width="200">Lembaga</td>
                                        <td width="20">:</td>
                                        <td>{{$data->lembaga->lembaga}}</td>
                                    </tr>
                                    <tr>
                                        <td width="200">Jabatan</td>
                                        <td width="20">:</td>
                                        <td>{{$data->jabatan}}</td>
                                    </tr>
                                    <tr>
                                        <td width="200">Alamat</td>
                                        <td width="20">:</td>
                                        <td>{{$data->alamat}}</td>
                                    </tr>
                                    <tr>
                                        <td width="200">Nomor Telepon</td>
                                        <td width="20">:</td>
                                        <td>{{$data->no_hp}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            @if(auth()->user()->hasRole('user') || (auth()->user()->hasRole('admin') && strtotime($data->tanggal_mulai) <= strtotime(date('Y-m-d H:i:s'))))
                            <div class="alert alert-{{($data->status == 0)? 'warning':(($data->status == 1)? 'success':'danger')}} mt-5 text-center" role="alert">
                                Status Pengajuan Peminjaman<br>
                                <h3><strong>{{($data->txt_status)}}</strong></h3>
                            </div>
                            <p>{{$data->keterangan_verifikasi}}</p>
                            @else
                            <form role="form" method="POST" enctype="multipart/form-data" action="{{url('administrator/peminjaman/'.$data->id)}}" class="mt-5">
                                @csrf
                                @method('patch')
                                <h3>FORM PERSETUJUAN PEMINJAMAN</h3>
                                <div class="form-group">
                                    <label for="" class="">Status Peminjaman :</label><br>
                                    <input type="radio" name="status" value="1"> Setujui &nbsp;
                                    <input type="radio" name="status" value="2"> Tolak<br>
                                    @error('status')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan :</label>
                                    <br>
                                    @error('keterangan')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                    @enderror
                                    <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"></textarea>
                                </div>

                                <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </form>
                            @endif
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
</script>
<!-- END PAGE LEVEL JS -->
@endsection
