@extends('layouts.app')

@section('add_css')
  <link rel="stylesheet" href="../node_modules/prismjs/themes/prism.css">
  <link rel="stylesheet" href="../node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
  <section class="section">
   
    <section class="section">
      <div class="section-header">
        <h1>Siswa</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{url('/')}}">Dashboard</a></div>
          {{-- <div class="breadcrumb-item"><a href="#">Siswa</a></div> --}}
          <div class="breadcrumb-item">Siswa Baru</div>
        </div>
      </div>


    <div class="section-body">
      {{-- <h2 class="section-title">List of Packages Question</h2>
      <p class="section-lead">This page is for managing packages including questions and answers.</p> --}}
      <div class="tes"></div>
      <div class="card">
        <div class="card-header">
          <h4>Data Seluruh Siswa</h4>
          <div class="card-header-action">
            <div class="buttons">
              <a href="{{url('tambahSiswa')}}"><button class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Tambah Data"  ><i class="fas fa-plus"></i></button></a>
            </div>
            {{-- <a id="modal-3" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Tambah Data"><i class="fas fa-plus mt-2"></i></a> --}}
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>ID Card</th>
                    {{-- <th>Foto</th> --}}
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                <tr>
                    <td>{{ $d->nis }}</td>
                    <td>{{ $d->nama_siswa }}</td>
                    <td>{{ $d->card }}</td>
                    {{-- <td>{{ $d->foto }}</td> --}}
                    <td>
                      <a href="{{url('siswa').'/'.$d->id}}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="detail"><i class="fas fa-pencil-alt"></i></a>
                      <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Apakah anda yakin?| Data ini akan terhapus. Lanjutkan ?" data-confirm-yes="hapus({{ $d->id }})"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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
  {{-- <script src="../assets/js/page/bootstrap-modal.js"></script> --}}

  <script>


    //MENGHAPUS DATA
    function hapus($id){
      var url = "{{url('siswa')}}"+"/"+$id;
      console.log(url);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        method: 'DELETE',
        success:function(xhr, ajaxOptions, thrownError)
        {
          swal('Berhasil', 'Data Terhapus', 'success');
          setTimeout(function() {
            location.reload();
          },1000)
        },
          error: function() {
        }
      });
    }

  </script>
@endsection
