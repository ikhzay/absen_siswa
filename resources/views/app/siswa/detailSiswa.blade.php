@extends('layouts.app')

@section('add_css')
  <link rel="stylesheet" href="../node_modules/prismjs/themes/prism.css">
  <link rel="stylesheet" href="../node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
  <style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }
    .preview {
        overflow: hidden;
        width: 200px;
        height: 200px;
        border: 1px solid red;
        position:relative;
    }
    .preview img {
        position:absolute;
        z-index:1;
    }
    #textcanvas{
        position:relative;
        z-index:20;
    }
    #side {
        padding: 10px;
    }
    .modal-lg{
        max-width: 1000px !important;
    }
</style>
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Siswa</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{url('/')}}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{url('siswa')}}">Siswa</a></div>
        <div class="breadcrumb-item">Detail Siswa</div>
      </div>
    </div>

    <div class="section-body">
      <div class="card card-primary">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <ul class="nav nav-tabs" id="myTab5" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab5" data-toggle="tab" href="#home5" role="tab" aria-controls="home" aria-selected="true">
                    <i class="fas fa-home"></i> Detail</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab5" data-toggle="tab" href="#profile5" role="tab" aria-controls="profile" aria-selected="false">
                    <i class="fas fa-id-card"></i> Update</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="absen-tab5" data-toggle="tab" href="#absen" role="tab" aria-controls="profile" aria-selected="false">
                    <i class="fas fa-id-card"></i> Kehadiran</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent5">
                <div class="tab-pane fade show active" id="home5" role="tabpanel" aria-labelledby="home-tab5">
                  <div class="row">
                    <div class="col-12 col-sm-6 col-lg-6">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                          <div class="row">
                            <div class="col-4">
                              Nis
                            </div>
                            <div class="col-8">
                              : {{$data->nis}}
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="row">
                            <div class="col-4">
                              Nama
                            </div>
                            <div class="col-8">
                              : {{$data->nama_siswa}}
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="row">
                            <div class="col-4">
                              ID Card
                            </div>
                            <div class="col-8">
                              : {{$data->card}}
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="row">
                            <div class="col-4">
                              Kelas
                            </div>
                            <div class="col-8">
                              : {{$data->kelas}} {{$data->jurusan}}
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-6">
                      <div class="author-box-left">
                        {{-- <img alt="../assets/img/avatar/avatar-1.png" src="{{url('assets/img/siswa'.'/'.$data->foto)}}" class="image-fluid" style="width: 300px"> --}}
                        @if ($data->foto == null)
                          <img alt="iamge" src="../assets/img/avatar/avatar-1.png" class="image-fluid" style="width: 300px">                            
                        @else
                          <img alt="image" src="{{url('assets/img/siswa'.'/'.$data->foto)}}" class="image-fluid" style="width: 300px">                            
                        @endif
                        <div class="clearfix"></div>
                        {{-- <a href="#" class="btn btn-primary mt-3 follow-btn" data-follow-action="alert('follow clicked');" data-unfollow-action="alert('unfollow clicked');">Follow</a> --}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="profile5" role="tabpanel" aria-labelledby="profile-tab5">
                  <div class="row">
                    <div class="col-12 col-sm-6 col-lg-6">
                      {{-- <form method="POST" enctype="multipart/form-data" id="updateSiswa"> --}}
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                          <label>NIS</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-key"></i>
                              </div>
                            </div>
                            <input type="text" class="form-control" placeholder="NIS" name="idSiswa" id="idSiswa" value="{{$data->id}}" hidden>
                            <input type="text" class="form-control" placeholder="NIS" name="nis" id="nis" value="{{$data->nis}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Nama</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-user"></i>
                              </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nama" name="nama_siswa" id="nama_siswa" value="{{$data->nama_siswa}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Kelas</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                {{-- <i class="fas fa-user"></i> --}}
                                <i class="fas fa-chalkboard"></i>
                              </div>
                            </div>
                            {{-- <input type="text" class="form-control" placeholder="Nama" name="kelas" id="kelas" value="{{$data->kelas}}"> --}}
                            <select class="form-control select1" id="kelas" name="kelas">
                              <option selected="selected" value="{{$data->kelas}}">{{$data->kelas}}</option>
                              <option value="X">X</option>
                              <option value="XI">XI</option>
                              <option value="XII">XII</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Jurusan</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-book"></i>
                              </div>
                            </div>
                            <select class="form-control select1" id="jurusan" name="jurusan">
                              <option selected="selected" value="{{$data->jurusan}}">{{$data->jurusan}}</option>
                              <option value="TKR">TKR</option>
                              <option value="TKJ">TKJ</option>
                              <option value="TITL">TITL</option>
                              <option value="MM">MM</option>
                              <option value="TTB">TTB</option>
                              <option value="BOGA">BOGA</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>ID Card</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nama" name="card" id="card" value="{{$data->card}}">
                          </div>
                        </div>
                        <button class="btn btn-primary mb-4" id="update">Simpan</button>
                      {{-- </form> --}}
                    </div>
                    <div class="col-12 col-sm-6 col-lg-6">
                      <div class="author-box-left">
                        @if ($data->foto == null)
                          <img alt="iamge" src="../assets/img/avatar/avatar-1.png" class="image-fluid" style="width: 300px">                            
                        @else
                          <img alt="image" src="{{url('assets/img/siswa'.'/'.$data->foto)}}" class="image-fluid" style="width: 300px">                            
                        @endif
                        <div class="clearfix"></div>
                        <a class="btn btn-primary mt-3 text-white"><input type="file" name="image" class="image"></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="absen" role="tabpanel" aria-labelledby="absen-tab5">
                  <div class="row">
                    <div class="col-12 col-sm-6 col-lg-6">
                     kiri
                    </div>
                    <div class="col-12 col-sm-6 col-lg-6">
                      kanan
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Laravel Crop Image Before Upload using Cropper JS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-7">
                            <img id="image">
                        </div>
                        <div class="col-md-5">
                            <div class="row" id="side">
                                <div class="col-md-12">
                                    <div class="preview" id="crop-preview"></div>
                                </div>
                                <div class="col-md-6">
                                    <label>Width</label>
                                    <input type="text" class="form-control" id="image-width">
                                </div>
                                <div class="col-md-6">
                                    <label>Height</label>
                                    <input type="text" class="form-control" id="image-height">
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary" id="rotate-left"><i class="fa fa-undo"></i></button>
                                    <button class="btn btn-primary" id="rotate-right"><i class="fa fa-redo"></i></button>
                                    <button class="btn btn-primary" id="greyscale"><i class="fa fa-paint-brush"></i></button>
                                    <button class="btn btn-primary" id="reset-greyscale"><i class="fa fa-eraser"></i></button>
                                </div>
                            </div>
                            <div class="row" id="side">
                                <div class="col-md-12" style="display: none">
                                    <canvas id="textcanvas" width=200 height=200></canvas>
                                </div>
                                <div class="col-md-12">
                                    <label>Text</label>
                                    <input type="text" class="form-control" id="image-text">
                                </div>
                            </div>
                            <div class="row" id="side">
                                <div class="col-md-12">
                                    <label>Text Padding</label>
                                </div>
                                <div class="col-md-3">
                                    <label>Top</label>
                                    <input type="text" class="form-control" id="image-text-top-padding" value="20">
                                </div>
                                <div class="col-md-3">
                                    <label>Left</label>
                                    <input type="text" class="form-control" id="image-text-left-padding" value="20">
                                </div>
                                <div class="col-md-3">
                                    <label>Color</label>
                                    <input type="text" class="form-control" id="image-text-color" value="black">
                                </div>
                                <div class="col-md-3">
                                    <label>Size</label>
                                    <input type="text" class="form-control" id="image-text-size" value="15">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('add_js')
  <script src="../node_modules/prismjs/prism.js"></script>
  <script src="../node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="../node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
  <script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script src="../assets/js/page/modules-sweetalert.js"></script>
  <script src="../assets/js/page/modules-datatables.js"></script>
  {{-- <script src="../assets/js/page/bootstrap-modal.js"></script> --}}

  {{-- Cropper Image --}}
  <script>
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var idSiswa = document.getElementById('idSiswa').value;
    console.log(idSiswa);
    var cropper;
    var save_black_white = false;

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("body").on("change", ".image", function(e){
        var files = e.target.files;
        var done = function (url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                console.log(reader.result);
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview',
            rotatable: true,
            crop(event) {
                // document.getElementById("image-width").value = Math.round(event.detail.width);
                // document.getElementById("image-height").value = Math.round(event.detail.height);

                document.getElementById("image-width").value = 600;
                document.getElementById("image-height").value = 600;
            },
        });

        var textcanvas = document.getElementById("textcanvas");
        var context = textcanvas.getContext("2d");
        document.getElementById('image-text').addEventListener("keyup", function (evt) {
            drawCanvas(textcanvas, context);
         }, false);
        document.getElementById('image-text-top-padding').addEventListener('input', function (evt) {
            drawCanvas(textcanvas, context);
        });
        document.getElementById('image-text-left-padding').addEventListener('input', function (evt) {
            drawCanvas(textcanvas, context);
        });
        document.getElementById('image-text-color').addEventListener('input', function (evt) {
            drawCanvas(textcanvas, context);
        });
        document.getElementById('image-text-size').addEventListener('input', function (evt) {
            drawCanvas(textcanvas, context);
        });

        $('#rotate-right').click(function() {
            cropper.rotate(45);
        });
        $('#rotate-left').click(function() {
            cropper.rotate(-45);
        });
        $('#greyscale').click(function() {
            $('.preview').css({
                'mix-blend-mode': 'luminosity',
            });
            save_black_white = true;
        });
        $('#reset-greyscale').click(function() {
            $('.preview').css({
                'mix-blend-mode': '',
            });
            save_black_white = false;
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function(){
        canvas = cropper.getCroppedCanvas({
            width: $('#image-width').val(),
            height: $('#image-width').val(),
        });

        const ctx = canvas.getContext("2d");

        // check if true and save blackwhite image
        if(save_black_white) {
            let imgData = ctx.getImageData(0, 0, ctx.canvas.width, ctx.canvas.height);
            let pixels = imgData.data;
            for (var i = 0; i < pixels.length; i += 4) {

            let lightness = parseInt((pixels[i] + pixels[i + 1] + pixels[i + 2])/3);

            pixels[i] = lightness;
            pixels[i + 1] = lightness;
            pixels[i + 2] = lightness;
            }
            ctx.putImageData(imgData, 0, 0);
        }

        // text varibales
        const imagetext = $('#image-text').val();
        const toppadding = $('#image-text-top-padding').val();
        const leftpadding = $('#image-text-left-padding').val();
        const imagetextcolor = $('#image-text-color').val();
        const imagetextsize = $('#image-text-size').val();
        const maxWidth = $('#image-width').val() - leftpadding;
        const lineHeight = 25;

        // add text to image
        if(imagetext.length > 0) {
            ctx.font = ctx.font.replace(/\d+px/, imagetextsize + "px");
            ctx.fillStyle = imagetextcolor;
            // ctx.fillText(imagetext, leftpadding, toppadding);
            wrapText(ctx,imagetext, leftpadding, toppadding, maxWidth, lineHeight);
        }

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{url('image-cropper')}}",
                    data: {
                        // '_token': $('meta[name="_token"]').attr('content'),
                        'id' : idSiswa,
                        'image': base64data
                    },
                    success: function(data){
                        $modal.modal('hide');
                        swal('Berhasil', 'Data Berhasil Diubah', 'success');
                        setTimeout(function() {
                          location.reload();
                        },1200);
                    }
                });
            }
        });
    });

    function wrapText(context, text, x, y, maxWidth, lineHeight) {
        var words = text.split(' ');
        var line = '';

        for(var n = 0; n < words.length; n++) {
            var testLine = line + words[n] + ' ';
            var metrics = context.measureText(testLine);
            var testWidth = metrics.width;
            if (testWidth > maxWidth && n > 0) {
                context.fillText(line, x, y);
                line = words[n] + ' ';
                y += lineHeight;
            }
            else {
                line = testLine;
            }
        }
        context.fillText(line, x, y);
    }

    function drawCanvas(textcanvas, context) {
        // get preview div
        var pushto = document.getElementById("crop-preview");
        // remove existing canvas
        try{
            context.clearRect(0, 0, textcanvas.width, textcanvas.height);
        }catch(err) {
            // proceed to draw canvas
        }

        var imagetext = $('#image-text').val();
        var toppadding = $('#image-text-top-padding').val();
        var leftpadding = $('#image-text-left-padding').val();
        var imagetextcolor = $('#image-text-color').val();
        var imagetextsize = $('#image-text-size').val();
        var maxWidth = 200 - leftpadding;
        var lineHeight = 25;

        context.font = context.font.replace(/\d+px/, imagetextsize + "px");
        context.fillStyle = imagetextcolor;
        // context.fillText(imagetext, leftpadding, toppadding);
        wrapText(context,imagetext, leftpadding, toppadding, maxWidth, lineHeight);

        // push canvas to preview div
        pushto.appendChild(textcanvas);
    }

  </script>
  <script>
     $('#update').click(function(e) {
      var nis = document.getElementById('nis').value;
      var nama_siswa = document.getElementById('nama_siswa').value;
      var kelas = document.getElementById('kelas').value;
      var jurusan = document.getElementById('jurusan').value;
      var card = document.getElementById('card').value;
      
      var settings = {
          "url": "{{url('api/siswa')}}"+"/"+idSiswa,
          "method": "PUT",
          "timeout": 0,
          "headers": {
            "Content-Type": "application/json"
          },
          "data": JSON.stringify({
            "nis": nis,
            "nama_siswa": nama_siswa,
            "kelas": kelas,
            "jurusan": jurusan,
            "card": card,
          }),
        };
        
        $.ajax(settings).done(function (response) {
            swal('Berhasil', 'Data Berhasil Diubah', 'success');
            setTimeout(function() {
              location.reload();
            },1200)
        });
    });
  </script>
@endsection
