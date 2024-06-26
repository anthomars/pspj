@extends('layouts.template')

@section('title', 'Iuran')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">Iuran</div>
        <h2 class="page-title">Semua Data Iuran</h2>
      </div>
      <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              @if(Auth::user()->role_id != 5)
            <a href="{{ route('iuran.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
                </svg>
                Tambah Iuran
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
              <th>Jenazah</th>
              <th>Nama Iuran</th>
              <th>Nominal</th>
              <th>Status</th>
              <th>Tgl Dibuat</th>
              <th></th>
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
    $('#rw_id').select2({
        theme: "bootstrap-5",
        dropdownParent: $('#rw_id').parent(),
        placeholder: $(this).data('placeholder'),
        closeOnSelect: false,
        tags: true,
        selectionCssClass: 'select2--small',
        dropdownCssClass: 'select2--small',
    });
    $('#rw_id_show_edit').select2({
        theme: "bootstrap-5",
        dropdownParent: $('#rw_id_show_edit').parent(),
        placeholder: $(this).data('placeholder'),
        closeOnSelect: false,
        tags: true,
        selectionCssClass: 'select2--small',
        dropdownCssClass: 'select2--small',
    });
  </script>
  <script>
    $(function() {
      $.fn.dataTable.moment( 'DD/MM/YYYY' );

      $('#data-datatable').DataTable({
        processing: true,
        serverSide: true,
        'bAutoWidth':false,
        ajax: '{!! route('iuran.dataTable') !!}', // memanggil route yang menampilkan data json
        columns: [ // mengambil & menampilkan kolom sesuai tabel database
          { "data" : "id_iuran", "render": function (data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
          }, width: '50px'  },
          { data: 'nama_jenazah', name: 'nama_jenazah' },
          { data: 'nama_iuran', name: 'nama_iuran' },
          {
             data: 'nominal_iuran', 
             name: 'nominal_iuran',
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
          { data: 'date_created', name: 'date_created' },
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
    $('#modal-detail').on('hidden.bs.modal', function () {
      $('#title').text('RT Detail');

      $('#name_show_edit').prop('disabled',true);
      $('#no_show_edit').prop('disabled',true);
      $('#address_show_edit').prop('disabled',true);
      $('#rw_id_show_edit').prop('disabled',true);

      $('#name_show_edit').removeClass('is-invalid');
      $('#message_name_show_edit').css('display','none');
      $('#no_show_edit').removeClass('is-invalid');
      $('#message_no_show_edit').css('display','none');
      $('#address_show_edit').removeClass('is-invalid');
      $('#message_address_show_edit').css('display','none');
      $('#rw_id_show_edit').removeClass('is-invalid');
      $('#message_rw_id_show_edit').css('display','none');

      $('.user_info').removeClass('d-none');

      $('#button_delete').removeClass('d-none');
      $('#button_edit').removeClass('d-none');
      $('#button_update').addClass('d-none');
    });

    $("#button_edit").on("click", function() {
      $('#title').text('RT Edit');

      $('#name_show_edit').prop('disabled',false);
      $('#no_show_edit').prop('disabled',false);
      $('#address_show_edit').prop('disabled',false);
      $('#rw_id_show_edit').prop('disabled',false);

      $('#button_delete').addClass('d-none');
      $('#button_edit').addClass('d-none');
      $('#button_update').removeClass('d-none');

      $('.user_info').addClass('d-none');
    });

    $("#button_delete").on("click", function(e) {
      let id = $('#button_delete').data('id');
      // console.log(id);
      deleteData(id);
    });


    $('#button_update').click(function (e) {
        let id = $('#button_update').data('id');
        let url = "{!! url('/master-data/rt/"+id+"') !!}";
        let name = $('#name_show_edit').val();
        let no = $('#no_show_edit').val();
        let address = $('#address_show_edit').val();
        //   let rw_id = $('#rw_id_show_edit').val();
        let rw_id = $('#rw_id_show_edit option:selected').val();

        $.ajax({
            url: url,
            dataType: 'json',
            type: "put",
            data: {
            '_token' : '{{ csrf_token() }}',
            'nama_rt' : name,
            'no_rt' : no,
            'alamat_rt' : address,
            'rw_id' : rw_id
            },
            beforeSend: function() {
            $('.overlay_submit_loading').addClass('show_loading');
            $('.spanner_submit_loading').addClass('show_loading');
            },
            success: function (data) {
            $('#name_show_edit').val('');
            $('#no_show_edit').val('');
            $('#address_show_edit').val('');
            $('#rw_id_show_edit').val('');
            $('#modal-detail').modal('hide');

            $('#data-datatable').DataTable().ajax.reload();

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                width: 'auto',
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            if (data.status == 'success') {
                Toast.fire({
                    icon: 'success',
                    title: data.message
                })
            }else if(data.status == 'error'){
                Toast.fire({
                    icon: 'error',
                    title: data.message
                })
            }else if(data.status == 'info'){
                Toast.fire({
                    icon: 'info',
                    title: data.message
                })
            }
            },
            error: function (xhr) {
            $('#modal-detail').modal('show');

            // console.log(xhr);
            if(xhr.responseJSON.errors){
                if (xhr.responseJSON.errors.nama_rt !== undefined) {
                    $('#name_show_edit').addClass('is-invalid');
                    $('#message_name_show_edit').css('display','inline-block');
                    $('#message_name_show_edit').text(xhr.responseJSON.errors.nama_rt[0]);
                }
                if (xhr.responseJSON.errors.no_rt !== undefined) {
                    $('#no_show_edit').addClass('is-invalid');
                    $('#message_no_show_edit').css('display','inline-block');
                    $('#message_no_show_edit').text(xhr.responseJSON.errors.no_rt[0]);
                }
                if (xhr.responseJSON.errors.alamat_rt !== undefined) {
                    $('#address_show_edit').addClass('is-invalid');
                    $('#message_address_show_edit').css('display','inline-block');
                    $('#message_address_show_edit').text(xhr.responseJSON.errors.alamat_rt[0]);
                }
                if (xhr.responseJSON.errors.rw_id !== undefined) {
                    $('#address_show_edit').addClass('is-invalid');
                    $('#message_rw_id_show_edit').css('display','inline-block');
                    $('#message_rw_id_show_edit').text(xhr.responseJSON.errors.rw_id[0]);
                }
            }
            },
            complete: function() {
            $('.overlay_submit_loading').removeClass('show_loading');
            $('.spanner_submit_loading').removeClass('show_loading');
            },
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
                let url = "{!! url('iuran/"+id+"') !!}";

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
