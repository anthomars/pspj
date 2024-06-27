@extends('layouts.template')

@section('title', 'Pemakaman')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">Pemakaman</div>
        <h2 class="page-title">Semua Data Pemakaman</h2>
      </div>
      <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              @if(Auth::user()->role_id != 5)

              <a href="{{ route('makam.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
                </svg>
                Tambah Baru
            </a>
            @endif
            </div>
        </div>
    </div>
  </div>
</div>
<!-- Page body -->
<div class="page-body">
  <div class="container-xl">
    <div class="card p-3">
      <div class="table-responsive">
        <table id="data-datatable" class="table card-table table-vcenter text-nowrap">
          <thead>
            <tr>
              <th>No.</th>
              <th>Blok</th>
              <th>Tgl Pemakaman</th>
              <th>Jam Pemakaman</th>
              <th>Status Pemakaman</th>
              <th>Biaya</th>
              <th>Nominal</th>
              <th>Status Bayar</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link href="{{ asset('dist/css/custom-table.css') }}" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@push('js')
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
  <script>
    $(function() {
      $.fn.dataTable.moment( 'DD/MM/YYYY' );

      $('#data-datatable').DataTable({
        processing: true,
        serverSide: true,
        'bAutoWidth':false,
        ajax: '{!! route('makam.dataTable') !!}', // memanggil route yang menampilkan data json
        columns: [ // mengambil & menampilkan kolom sesuai tabel database
          { "data" : "id", "render": function (data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
          }, width: '50px'  },
          { data: 'nama_blok', name: 'nama_blok' },
          { data: 'tgl_pemakaman', name: 'tgl_pemakaman' },
          { data: 'jam_pemakaman', name: 'jam_pemakaman' },
          { data: 'status_pemakaman', name: 'status_pemakaman' },
          { data: 'nama_biaya', name: 'nama_biaya' },
          {
             data: 'nominal_biaya', 
             name: 'nominal_biaya',
             render: function(data, type, row){
                var nominal = "Rp. " + new Intl.NumberFormat('id-ID').format(data);
                return '<span>' + nominal + '</span>';
                
             }

          },
          {
              data: 'status_bayar',
              name: 'status_bayar',
              render: function(data, type, row) {
                var statusClass = data === 'lunas' ? 'text-success' : 'text-danger';
                return '<span class="text-capitalize ' + statusClass + '">' + data + '</span>';
            }
          },  
          { data: 'action', name: 'action', orderable: false, searchable: false, width: '20px'},
        ],
        "search": {
          "search": "{{ Request::get('search') }}"
        },
      });

      $('input[type=search]').on('input', function(e) {
        if('' == this.value) {
          const cek = "{{ Request::get('search') }}";
          if (cek) {
            window.location = window.location.href.split("?")[0];
          }
        }
      });
    });
  </script>

  <script>
    function deleteData(id) {
        Swal.fire({
              title: 'Konfirmasi',
              text: "Apakah anda ingin manghapus data?",
              icon: 'warning',
              allowOutsideClick: false,
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Ya, hapus!',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal'
            }).then((result) => {
              if (result.isConfirmed) {
                let url = "{!! url('makam/"+id+"') !!}";

                $.ajax({
                  type: "DELETE",
                  dataType: "json",
                  url: url,
                  data: {
                    '_token' : '{{ csrf_token() }}'
                  },
                  success: function(data){
                    $('#modal-detail').modal('hide');
                    $('#data-datatable').DataTable().ajax.reload();
                    Swal.fire(
                      data.title,
                      data.message,
                      data.status
                    )
                  // console.log(data.success)
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                    $('#modal-detail').modal('hide');
                    Swal.fire(
                      xhr.responseJSON.title,
                      xhr.responseJSON.message,
                      xhr.responseJSON.status
                    )
                    // console.log(xhr.responseText);
                  }
                });
              }
            })
    }
  </script>
@endpush
