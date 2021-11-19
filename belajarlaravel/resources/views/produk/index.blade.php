@extends('admin.index')

@section('content')
<div class="content-wrapper" style="min-height: 2077.69px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DATA PRODUK</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#TambahModal">
                  <i class="fa fa-plus"></i>
                </a>
              </div>

                <div class="panel">
              <div class="panel-body">
                <table class="table table-hover" id="data_produk">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>                    
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>
                    @foreach($data_produk as $produk)               
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{$produk->nama_produk}}</td>
                    <td>{{$produk->diskripsi}}</td>
                    <td>{{$produk->jumlah}}</td>
                    <td> Rp. {{ number_format($produk->harga) }}</td>
                    <td>
                      <a href="#" class="btn btn-warning btn-sm" data-produk_id="{{$produk->id}}" data-toggle="modal" data-target="#editModal">
                      <i class="fa fa-pen"></i>
                      </a>
                      <a href="/produk/{{$produk->id}}/delete" class="btn btn-danger btn-sm">
                      <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="TambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data Produk</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/produk/create" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Produk</label>
              <input name="nama_produk" type="text" class="form-control" id="nama_produk" required="">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Deskripsi</label>
              <textarea name="diskripsi" type="text" class="form-control" id="diskripsi" required=""></textarea> 
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">jumlah</label>
              <input name="jumlah" type="int" class="form-control" id="jumlah" required="">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Harga</label>
              <input name="harga" type="int" class="form-control" id="harga" required="">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
           </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
           <div class="modal-body">
              <form action="/produk/update" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id" value="">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Produk</label>
              <input name="nama_produk" type="text" class="form-control" id="nama_produk" placeholder="Nama Produk" required="">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Deskripsi</label>
              <textarea name="diskripsi" type="text" class="form-control" id="diskripsi" placeholder="Deskripsi" required=""></textarea> 
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">jumlah</label>
              <input name="jumlah" type="int" class="form-control" id="jumlah" placeholder="Jumlah" required="">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Harga</label>
              <input name="harga" type="int" class="form-control" id="harga" placeholder="Harga" required="">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
       </div>
      </div>
    </div>
  </div>

@stop

@section('footer')

<script>
    $('#editModal').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var id = button.data('produk_id')
        
        $.ajax({
            type: "GET",
            url: "/produk/edit/" + id,
            dataType: "json",
            success: function (response) {
               console.log(response)
            $('#id').val(response.id);
            $('#nama_produk').val(response.nama_produk);
            $('#diskripsi').val(response.diskripsi);
            $('#jumlah').val(response.jumlah);
            $('#harga').val(response.harga);
            }
        });
    })

    $('#TambahModal').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget)
            var id = button.data('produk_id')
            
            $.ajax({
                type: "GET",
                url: "/produk/create/" + id,
                dataType: "json",
                success: function (response) {
                   console.log(response)
            $('#id').val(response.id);
            $('#nama_produk').val(response.nama_produk);
            $('#diskripsi').val(response.diskripsi);
            $('#jumlah').val(response.jumlah);
            $('#harga').val(response.harga);
                }
            });
        })
</script>

@endsection