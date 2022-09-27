@extends('layouts.app')

@section('add_css')
  <link rel="stylesheet" href="../node_modules/prismjs/themes/prism.css">
  <link rel="stylesheet" href="../node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Siswa</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{url('/')}}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{url('siswa')}}">Siswa</a></div>
        <div class="breadcrumb-item">Tambah Siswa</div>
      </div>
    </div>

    <div class="section-body">
      {{-- <h2 class="section-title">List of Packages Question</h2>
      <p class="section-lead">This page is for managing packages including questions and answers.</p> --}}
      <div class="row">
        <div class="col-12 col-sm-6 col-lg-6">
          <div class="card card-primary">
            <div class="card-body">
              {{-- <form> --}}
                <div class="form-group">
                  <label>NIS</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fas fa-key"></i>
                      </div>
                    </div>
                    <input type="text" class="form-control" placeholder="NIS" name="nis" id="nis">
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
                    <input type="text" class="form-control" placeholder="Nama" name="nama_siswa" id="nama_siswa">
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
                      <option selected>Pilih Kelas</option>
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
                      <option selected>Pilih Jurusan</option>
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
                    <input type="text" class="form-control" placeholder="ID Card" name="card" id="card">
                  </div>
                </div>
                <button class="btn btn-primary" id="simpan">Simpan</button>
              {{-- </form> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('add_js')
  <script src="../node_modules/prismjs/prism.js"></script>
  <script src="../node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="../node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
  <script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script src="../assets/js/page/modules-sweetalert.js"></script>

  <script src="../assets/js/page/modules-datatables.js"></script>
  <script>    
    $('#simpan').click(function(e) {
      var nis = document.getElementById('nis').value;
      var nama_siswa = document.getElementById('nama_siswa').value;
      var kelas = document.getElementById('kelas').value;
      var jurusan = document.getElementById('jurusan').value;
      var card = document.getElementById('card').value;
      
      var settings = {
          "url": "{{url('api/siswa')}}",
          "method": "POST",
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
            swal('Berhasil', 'Data Berhasil Disimpan', 'success');
            setTimeout(function() {
              window.location = "{{url('siswa')}}";
            },1200)
        });
    });
  </script>
@endsection
