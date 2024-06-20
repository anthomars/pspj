@extends('layouts.template')
@section('title', 'Blok Pemakaman')
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">Master Data</div>
        <h2 class="page-title">Blok Pemakaman</h2>
      </div>
      <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-add">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
                </svg>
                Add
            </a>
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
              <th>Nama Blok</th>
              <th>Kapasitas</th>
              <th>Nama PIC</th>
              <th>HP PIC</th>
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
<div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Block</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama Blok</label>
          <input type="text" id="blok" class="form-control" placeholder="Nama Blok">
          <div id="message_name" class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
          <label class="form-label">Kapasitas</label>
          <input type="text" id="kapasitas" class="form-control number" placeholder="Kapasitas">
          <div id="message_no" class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
          <label class="form-label">Nama PIC</label>
          <input type="text" id="pic" class="form-control" placeholder="Nama PIC">
          <div id="message_address" class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
            <label class="form-label">HP PIC <span class="form-label-description input-number"></span></label>
            <input type="text" id="phone" class="form-control number" minlength="8"
                maxlength="15" placeholder="Phone Number">
            <div id="message_phone" class="invalid-feedback"></div>
        </div>

      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>
        <button type="button" id="addBtn" class="btn btn-primary ms-auto">
          <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
          Add
        </button>
        <button type="button" id="submit-loading" class="btn btn-primary ms-auto" style="display: none" disabled>
          <span class="spinner-border spinner-border-sm me-2" role="status"></span>Loading
        </button>
      </div>
    </div>
  </div>
</div>
<div class="modal modal-blur fade" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="title" class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama RW</label>
          <input type="text" id="name_show_edit" class="form-control" placeholder="Nama RW" value="" disabled/>
          <div class="invalid-feedback" id="message_name_show_edit" style="display: none"></div>
        </div>
        <div class="mb-3">
          <label class="form-label">No RW</label>
          <input type="text" id="no_show_edit" class="form-control" placeholder="No. RW" value="" disabled/>
          <div class="invalid-feedback" id="message_no_show_edit" style="display: none"></div>
        </div>
        <div class="mb-3">
          <label class="form-label">Alamat RW</label>
          <input type="text" id="address_show_edit" class="form-control" placeholder="Alamat RW" value="" disabled/>
          <div class="invalid-feedback" id="message_address_show_edit" style="display: none"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </button>
        <div class="ms-auto">

        <button id="button_delete" class="btn btn-outline-danger">
            Delete
        </button>

        <button id="button_edit" class="btn btn-primary">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                <path d="M16 5l3 3"></path>
            </svg>
            Edit
        </button>

          <button id="button_update" class="btn btn-primary d-none">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
              <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
              <path d="M16 5l3 3"></path>
           </svg>
            Update
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link href="{{ asset('dist/css/custom-table.css') }}" rel="stylesheet"/>
@endpush
@push('js')
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>
  <script>
    $(function() {
      $.fn.dataTable.moment( 'DD/MM/YYYY' );

      $('#data-datatable').DataTable({
        processing: true,
        serverSide: true,
        'bAutoWidth':false,
        ajax: '{!! route('blok.dataTable') !!}', // memanggil route yang menampilkan data json
        columns: [ // mengambil & menampilkan kolom sesuai tabel database
          { "data" : "id_blok_pemakaman", "render": function (data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
          }, width: '50px'  },
          { data: 'nama_rw', name: 'nama_rw' },
          { data: 'no_rw', name: 'no_rw' },
          { data: 'alamat_rw', name: 'alamat_rw' },
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
    $('#modal-add').on('hidden.bs.modal', function () {
        $('#name').removeClass('is-invalid');
        $('#no').removeClass('is-invalid');
        $('#address').removeClass('is-invalid');
        $('#message_name').css('display','none');
        $('#message_no').css('display','none');
        $('#message_address').css('display','none');
    });

    $(function () {
      $('#addBtn').click(function (e) {
        let name = $('#name').val();
        let no = $('#no').val();
        let address = $('#address').val();

        $.ajax({
            url: "{{ url('master-data/rw') }}",
            dataType: 'json',
            type: "POST",
            data: {
                '_token' : '{{ csrf_token() }}',
                'nama_rw' : name,
                'no_rw' : no,
                'alamat_rw' : address,
            },
            beforeSend: function() {
                $('.overlay_submit_loading').addClass('show_loading');
                $('.spanner_submit_loading').addClass('show_loading');
                $('#submit-loading').css('display','inline-block');
                $('#addBtn').addClass('d-none');
            },
            success: function (data) {
                $('#name').val('');
                $('#no').val('');
                $('#address').val('');
                $('#modal-add').modal('hide');

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

                Toast.fire({
                icon: 'success',
                title: data.message
                })
            },
            error: function (xhr) {
            //   console.log(xhr);
              $('#modal-add').modal('show');
              if (xhr.responseJSON.errors.nama_rw !== undefined) {
                  $('#name').addClass('is-invalid');
                  $('#message_name').css('display','inline-block');
                  $('#message_name').text(xhr.responseJSON.errors.nama_rw[0]);
              }
              if (xhr.responseJSON.errors.no_rw !== undefined) {
                  $('#no').addClass('is-invalid');
                  $('#message_no').css('display','inline-block');
                  $('#message_no').text(xhr.responseJSON.errors.no_rw[0]);
              }
              if (xhr.responseJSON.errors.alamat_rw !== undefined) {
                  $('#address').addClass('is-invalid');
                  $('#message_address').css('display','inline-block');
                  $('#message_address').text(xhr.responseJSON.errors.alamat_rw[0]);
              }
            },
            complete: function() {
                $('.overlay_submit_loading').removeClass('show_loading');
                $('.spanner_submit_loading').removeClass('show_loading');

                $('#submit-loading').css('display','none');
                $('#addBtn').removeClass('d-none');
            },
        });
      });
    });
  </script>
  <script>
    $('#modal-detail').on('hidden.bs.modal', function () {
      $('#title').text('RW Detail');

      $('#name_show_edit').prop('disabled',true);
      $('#no_show_edit').prop('disabled',true);
      $('#address_show_edit').prop('disabled',true);

      $('#name_show_edit').removeClass('is-invalid');
      $('#message_name_show_edit').css('display','none');
      $('#no_show_edit').removeClass('is-invalid');
      $('#message_no_show_edit').css('display','none');
      $('#address_show_edit').removeClass('is-invalid');
      $('#message_address_show_edit').css('display','none');

      $('.user_info').removeClass('d-none');

      $('#button_delete').removeClass('d-none');
      $('#button_edit').removeClass('d-none');
      $('#button_update').addClass('d-none');
    });

    $("#button_edit").on("click", function() {
      $('#title').text('RW Edit');

      $('#name_show_edit').prop('disabled',false);
      $('#no_show_edit').prop('disabled',false);
      $('#address_show_edit').prop('disabled',false);

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

    function detailData(id) {
      const modalDetail = new bootstrap.Modal('#modal-detail', {
        keyboard: false
      })

      $('#title').text('RW Detail');

      let url = "{!! url('master-data/rw/"+id+"') !!}";

      $.ajax({
        type: "GET",
        dataType: "json",
        url: url,
        data: {
          '_token' : '{{ csrf_token() }}'
        },
        success: function(datas){
        //   console.log(datas);
          $('#name_show_edit').val(datas.data[0].nama_rw);
          $('#no_show_edit').val(datas.data[0].no_rw);
          $('#address_show_edit').val(datas.data[0].alamat_rw);

          $('#button_update').data('id',datas.data[0].id_rw)
          $('#button_delete').data('id',datas.data[0].id_rw)

          modalDetail.show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          Swal.fire(
            xhr.responseJSON.title,
            xhr.responseJSON.message,
            xhr.responseJSON.status
          )
          // console.log(xhr.responseJSON);
        }
      });
    }

    $('#button_update').click(function (e) {
      let id = $('#button_update').data('id');
      let url = "{!! url('/master-data/rw/"+id+"') !!}";
      let name = $('#name_show_edit').val();
      let no = $('#no_show_edit').val();
      let address = $('#address_show_edit').val();

      $.ajax({
        url: url,
        dataType: 'json',
        type: "put",
        data: {
          '_token' : '{{ csrf_token() }}',
          'nama_rw' : name,
          'no_rw' : no,
          'alamat_rw' : address,
        },
        beforeSend: function() {
          $('.overlay_submit_loading').addClass('show_loading');
          $('.spanner_submit_loading').addClass('show_loading');
        },
        success: function (data) {
          $('#name_show_edit').val('');
          $('#no_show_edit').val('');
          $('#address_show_edit').val('');
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
            if (xhr.responseJSON.errors.nama_rw !== undefined) {
                $('#name_show_edit').addClass('is-invalid');
                $('#message_name_show_edit').css('display','inline-block');
                $('#message_name_show_edit').text(xhr.responseJSON.errors.nama_rw[0]);
            }
            if (xhr.responseJSON.errors.no_rw !== undefined) {
                $('#no_show_edit').addClass('is-invalid');
                $('#message_no_show_edit').css('display','inline-block');
                $('#message_no_show_edit').text(xhr.responseJSON.errors.no_rw[0]);
            }
            if (xhr.responseJSON.errors.alamat_rw !== undefined) {
                $('#address_show_edit').addClass('is-invalid');
                $('#message_address_show_edit').css('display','inline-block');
                $('#message_address_show_edit').text(xhr.responseJSON.errors.alamat_rw[0]);
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
                let url = "{!! url('/master-data/rw/"+id+"') !!}";

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
