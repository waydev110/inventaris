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
                                        <li class="breadcrumb-item"><a href="{{url($route)}}">BARANG</a></li>
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
                                        <label>Kode Barang</label>
                                        <span class="help text-danger"></span>
                                        <input type="text" name="kode_barang" class="form-control" value="{{old('kode_barang')}}">
                                        @error('kode_barang')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <br>
                                        <label>Nama Barang</label>
                                        <span class="help text-danger"></span>
                                        <input type="text" name="nama_barang" class="form-control" value="{{old('nama_barang')}}">
                                        @error('nama_barang')
                                        <p class="hint-text small text-danger"><span class="fa fa-terminal"></span> {{$message}}</p>
                                        @enderror
                                        <br>
                                        <label>Spesifikasi</label>
                                        @error('spesifikasi')
                                        <p class="hint-text small text-danger"><i class="fa fa-terminal"></i> {{$message}}</p>
                                        @enderror
                                        <div class="summernote-wrapper">
                                            <textarea name="spesifikasi" id="summernote">{{old('spesifikasi')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Kategori</label>
                                        <span class="help"></span>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <select name="kategori" class="form-control">
                                                    <option></option>
                                                    @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{(old('kategori') == $category->id) ? "selected" : ""}}>{{$category->nama_kategori}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @error('kategori')
                                        <p class="hint-text small text-danger"><i class="fa fa-terminal"></i> {{$message}}</p>
                                        @enderror
                                        <br>
                                        <label>Gambar</label>
                                        @error('gambar')
                                        <p class="hint-text small text-danger"><i class="fa fa-terminal"></i> {{$message}}</p>
                                        @enderror
                                        <div id="prevImage">
                                        </div>
                                        <br>
                                        <input type="file" name="gambar" id="gambar">
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
    var table;
    var token = "{{csrf_token()}}";
    Dropzone.autoDiscover = false;
	$(document).ready( function () {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
        });

        $('#summernote').summernote({
            height: 1000,
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0],editor,welEditable);
            },
            placeholder: 'Ketik disini...',
            toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            codemirror: {
                theme: 'monokai'
            },
            onfocus: function(e) {
                $('body').addClass('overlay-disabled');
            },
            onblur: function(e) {
                $('body').removeClass('overlay-disabled');
            },
            onpaste: function(e) {
                var thisNote = $(this);
                var updatePastedText = function(someNote){
                    var original = someNote.code();
                    var cleaned = CleanPastedHTML(original); //this is where to call whatever clean function you want. I have mine in a different file, called CleanPastedHTML.
                    someNote.code('').html(cleaned); //this sets the displayed content editor to the cleaned pasted code.
                };
                setTimeout(function () {
                    //this kinda sucks, but if you don't do a setTimeout,
                    //the function is called before the text is really pasted.
                    updatePastedText(thisNote);
                }, 10);


            },
            popover: {
                image: [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                ]
            }
        });
        $("#gambar").change(function(){
            readURL(this);
        });
    });

    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = `<img src="${e.target.result}" width="100%" class="mb-2">`;
                $('#prevImage').html(img);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function sendFile(file, editor, welEditable) {
        data = new FormData();
        data.append("file", file);
        url = "{{url('administrator/upload-file')}}";
        $.ajax({
            data: data,
            type: "POST",
            url: url,
            cache: false,
            contentType: false,
            processData: false,
            success: function (resp) {
                if(resp.success == false){
                    $('#modalNotif').modal('show');
                    $('.modal-header h5').text('Pesan kesalahan');
                    $('.modal-body p').text(resp.message.file);
                } else {
                    $('#modalNotif').modal('show');
                    $('.modal-header h5').text('Pesan');
                    $('.modal-body p').text('Gambar berhasil di upload');
                    editor.insertImage(welEditable, resp.url);
                }
            }
        });
    }

    function CleanPastedHTML(input) {
        // 1. remove line breaks / Mso classes
        var stringStripper = /(\n|\r| class=(")?Mso[a-zA-Z]+(")?)/g;
        var output = input.replace(stringStripper, ' ');
        // 2. strip Word generated HTML comments
        var commentSripper = new RegExp('<!--(.*?)-->', 'g');
        var output = output.replace(commentSripper, '');
        var tagStripper = new RegExp('<(/)*(meta|link|span|\\?xml:|st1:|o:|font)(.*?)>', 'gi');
        // 3. remove tags leave content if any
        output = output.replace(tagStripper, '');
        // 4. Remove everything in between and including tags '<style(.)style(.)>'
        var badTags = ['style', 'script', 'applet', 'embed', 'noframes', 'noscript'];

        for (var i = 0; i < badTags.length; i++) {
            tagStripper = new RegExp('<' + badTags[i] + '.*?' + badTags[i] + '(.*?)>', 'gi');
            output = output.replace(tagStripper, '');
        }
        // 5. remove attributes ' style="..."'
        var badAttributes = ['style', 'start'];
        for (var i = 0; i < badAttributes.length; i++) {
            var attributeStripper = new RegExp(' ' + badAttributes[i] + '="(.*?)"', 'gi');
            output = output.replace(attributeStripper, '');
        }
        return output;
    }
</script>
@endsection
