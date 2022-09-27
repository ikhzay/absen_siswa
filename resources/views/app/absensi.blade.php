@extends('layouts.app')

@section('add_css')
  <link rel="stylesheet" href="../node_modules/chocolat/dist/css/chocolat.css">
  <link rel="stylesheet" href="../node_modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="../node_modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="../node_modules/selectric/public/selectric.css">
  <link rel="stylesheet" href="../node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="../node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Absensi</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      {{-- <div class="breadcrumb-item"><a href="#">Components</a></div> --}}
      <div class="breadcrumb-item">Absensi</div>
    </div>
  </div>

  <div class="section-body">
    {{-- <h2 class="section-title">Gallery</h2>
    <p class="section-lead">Grouping multiple images on one component.</p> --}}

    <div class="row">
      {{-- <div class="col-12 col-sm-12 col-lg-4"> --}}
        {{-- <div class="row"> --}}
          <div class="col-12 col-sm-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                {{-- <h4>Gallery</h4> --}}
                
              </div>
              <div class="card-body">
                {{-- <div class="gallery gallery-md" id="gambar"> --}}
                  <div class="row">
                    <div class="form-group">
                      {{-- <label>Tanggal</label> --}}
                      <input type="text" class="form-control datepicker" id="datepicker">
                    </div>
                    <div class="form-group">
                      {{-- <label>Status</label> --}}
                      <select class="form-control select1" id="status">
                        <option>Tepat Waktu</option>
                        <option>Telat</option>
                        <option>Tidak Masuk</option>
                      </select>
                    </div>
                    <div class="form-group">
                      {{-- <label>Kelas</label> --}}
                      <select class="form-control select1" id="kelas">
                        <option value="XII">Kelas XII</option>
                        <option value="XI">Kelas XI</option>
                        <option value="X">Kelas X</option>
                      </select>
                    </div>
                    <div class="form-group">
                      {{-- <label>Kelas</label> --}}
                      <select class="form-control select1" id="jurusan">
                        <option value="TKR">TKR</option>
                        <option value="TKJ">TKJ</option>
                        <option value="TITL">TITL</option>
                        <option value="MM">MM</option>
                        <option value="TTB">TTB</option>
                        <option value="BOGA">BOGA</option>
                      </select>
                    </div>
                  </div>
                <div class="row" id="dataAbsen">
                    {{-- <div class="col-4 col-sm-2 col-lg-2">
                      <div class="avatar-item">
                      </div>
                    </div> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      {{-- </div> --}}
    {{-- </div> --}}
  </div>
</section>
@endsection

@section('add_js')
  <script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="../node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="../node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="../node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="../node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="../node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="../node_modules/select2/dist/js/select2.full.min.js"></script>
  <script src="../node_modules/selectric/public/jquery.selectric.min.js"></script>
  {{-- <script src="../assets/js/page/forms-advanced-forms.js"></script> --}}


  <script>
    window.onload(checkButton());

    function checkButton(){
      $(document).ready(function(){
          console.log("Data");
          setTimeout(function() {
              var tgl = document.getElementById('datepicker').value;
              var status = document.getElementById('status').value;
              var kelas = document.getElementById('kelas').value;
              var jurusan = document.getElementById('jurusan').value;
              s=statusAbsen(status);
              getData(tgl,s,kelas,jurusan);
              checkButton();
          },3000)
      })
    }

  function getData(tgl,s,kelas,jurusan){
    var settings = {
          "url": "{{url('/api/absen/param/')}}"+"/"+tgl+"/"+s+"/"+kelas+"/"+jurusan,
          // "url": "{{url('/api/absen/param/')}}"+"/"+tgl+"/"+s,
          "method": "GET",
          "timeout": 0,
        };
        dataAbsen ="";
        st = '';
        icon= '';
        ket = '';
        $.ajax(settings).done(function (response) {
          // console.log(response);
          dataAbsen ="";
          $('#dataAbsen').html(dataAbsen);
          for (i=0;i<response.data.length;i++){
            // console.log(response.data[i].status);
            if (response.data[i].status == 1) {
              st = "success";
              icon = "check";
              ket = "Tepat Waktu ("+response.data[i].jam_absen+")";
            } else if(response.data[i].status == 2) {
              st = "warning";
              icon = "exclamation-triangle";
              ket = "Telat ("+response.data[i].jam_absen+")";
            }else{
              st = "danger";
              icon = "xmark";
              ket = "Belum Absen (-)";
            }
            // console.log(s);
            dataAbsen +=  '<div class="col-4 col-sm-2 col-lg-1">'+
                            '<div class="avatar-item">'+
                              '<img alt="image" src="assets/img/siswa/'+response.data[i].foto+'" class="img-fluid" data-toggle="tooltip" title="'+response.data[i].nama_siswa+'">'+
                              '<div class="avatar-badge bg-'+st+'" title="'+ket+'" data-toggle="tooltip"><i class="fas fa-'+icon+'"></i></div>'+
                              '</div>'+
                          '</div>';
          }
          $('#dataAbsen').html(dataAbsen);
        });
        $.ajax(settings).fail(function (response) {
          dataAbsen ="";
          $('#dataAbsen').html(dataAbsen);
        });
  }

  function statusAbsen(status){
    s=0;
    if(status=='Telat'){
      s=2;
    }
    else if(status=='Tepat Waktu'){
      s=1;
    }else{
      s=0;
    }
    return s;
  }
  </script>
@endsection
