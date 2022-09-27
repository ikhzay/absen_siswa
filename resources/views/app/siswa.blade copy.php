@extends('layouts.app')

@section('add_css')
  <link rel="stylesheet" href="../node_modules/prismjs/themes/prism.css">
  <link rel="stylesheet" href="../node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Siswa</h1>
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
              <button class="btn btn-primary btn-action mr-1" data-toggle="modal" data-target="#modal-tambah-data" data-toggle="tooltip" title="Tambah Data"  ><i class="fas fa-plus"></i></button>
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
                    <th>Foto</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                <tr>
                    <td>{{ $d->nis }}</td>
                    <td>{{ $d->nama_siswa }}</td>
                    <td>{{ $d->card }}</td>
                    <td>{{ $d->foto }}</td>
                    <td>
                      <a data-toggle="modal" data-target="#detail-data" data-id='{{ $d->id }}' class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
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


  {{-- Modal Tambah Data --}}
  <div class="modal fade" id="modal-tambah-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal ini</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('siswa') }}" method="POST" enctype="multipart/form-data" id="modal-form">
            @csrf
            <div class="form-group">
              <label>NIS</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-envelope"></i>
                  </div>
                </div>
                <input type="text" class="form-control" placeholder="NIS" name="nis" id="nis">
              </div>
            </div>
            <div class="form-group">
              <label>Nama Siswa</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-user"></i>
                  </div>
                </div>
                <input type="text" class="form-control" placeholder="Nama" name="nama_siswa">
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
            <div class="form-group">
              <label>Foto</label>
              {{-- <img class="img-preview img-fluid mb-3 col-sm-3" alt=""> --}}
              <div class="input-group">
                <img class="img-fluid mb-3 col-sm-3 tambahprev" id="preview-image-before-upload" alt="">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-camera"></i>
                  </div>
                </div>
                <input type="file" class="form-control tambahfotos" placeholder="Foto" name="foto" id="foto">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </form>
      </div>
    </div>
  </div>

  {{-- Modal Detail Data --}}
  <div class="modal fade" id="detail-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal ini</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" id="formDetail">
            @method('PUT')
            @csrf
            <input type="text" class="form-control" placeholder="NIS" name="id" id="id-edit" hidden>
            <div class="form-group">
              <label>NIS</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-envelope"></i>
                  </div>
                </div>
                <input type="text" class="form-control" placeholder="NIS" name="nis" id="nis-edit">
              </div>
            </div>
            <div class="form-group">
              <label>Nama Siswa</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-user"></i>
                  </div>
                </div>
                <input type="text" class="form-control" placeholder="Nama" name="nama_siswa" id="nama_siswa-edit">
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
                <input type="text" class="form-control" placeholder="ID Card" name="card" id="card-edit">
              </div>
            </div>
            <div class="form-group">
              <label>Foto</label>
              {{-- <img class="img-preview img-fluid mb-3 col-sm-3" alt=""> --}}
              <div class="input-group">
                <img class="img-fluid mb-3 col-sm-3 editprev" id="preview-image-before-upload" alt="">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-camera"></i>
                  </div>
                </div>
                <input type="file" class="form-control editfotos" placeholder="Foto" name="foto" id="foto">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </form>
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

  <script>

    //Tambah Data
    $(document).ready(function (e) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      //Prev Tambah Foto
      $('.tambahfotos').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => { 
          $('.tambahprev').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
      });

      //Prev Edit Foto
      $('.editfotos').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => { 
          $('.editprev').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
      });

      //Tambah Data
      $('#modal-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ url('siswa')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function() {
          // this.reset();
          swal('Berhasil', 'Data Tersimpan', 'success');
            setTimeout(function() {
              location.reload();
            },1500)
        },
          error: function(data){
          console.log(data);
        }
        });
      });

      $('#formDetail').submit(function(e) {
        e.preventDefault();
        var id = $('#id-edit').val();
        console.log(id);
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{url('siswa')}}"+"/"+id,
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function() {
          // this.reset();
          swal('Berhasil', 'Data Berhasil diubah', 'success');
            setTimeout(function() {
              location.reload();
            },1500)
        },
          error: function(data){
          console.log(data);
        }
        });
      });
      
    });


    //Mengambil data untuk diubah
    $(document).ready(function(){
        $('#detail-data').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            console.log(rowid);
            var url = "{{url('siswa')}}"+"/"+rowid;
            $.ajax({
                type : 'get',
                url : url,
                dataType : 'json',
                // data :  'rowid='+ rowid,
                success : function(data){
                  console.log(data.data.foto);
                  $('#id-edit').val(data.data.id);
                  $('#nis-edit').val(data.data.nis);
                  $('#nama_siswa-edit').val(data.data.nama_siswa);
                  $('#card-edit').val(data.data.card);
                  $('.editprev').attr('src', 'assets/img/siswa/'+data.data.foto);
                }
            });
         });
      });

      
    //Hapus Data
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
