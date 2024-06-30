@extends('layouts.template')
@section('title', 'List Jenazah')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">Jenazah</div>
                    <h2 class="page-title">List</h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ url('/jenazah/create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
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
                                <th>Nama Jenazah</th>
                                <th>Tanggal Lahir</th>
                                <th>Tanggal Wafat</th>
                                <th>Tempat Lahir</th>
                                <th>Tempat Wafat</th>
                                <th>NIK</th>
                                <th>Alamat</th>
                                <th>Keluarga Dari</th>
                                <th>Created By</th>
                                <th>Updated By</th>
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

    <div class="modal fade" id="modalAlamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Alamat</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-alamat">

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
@endsection

@push('cssTop')
    <link href="{{ asset('templates/tabler/dist/libs/dropzone/dist/dropzone.css?1685976846') }}" rel="stylesheet" />
    <script src="{{ asset('templates/tabler/dist/libs/dropzone/dist/dropzone-min.js?1685976846') }}" defer></script>
@endpush
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link href="{{ asset('dist/css/custom-table.css') }}" rel="stylesheet" />
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
            ajax: '{!! route('jenazah.dataTable') !!}', // memanggil route yang menampilkan data json
            columns: [ // mengambil & menampilkan kolom sesuai tabel database
              { "data" : "id_jenazah", "render": function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }, width: '50px'  },
              { data: 'nama_jenazah', name: 'nama_jenazah' },
              { data: 'tgl_lahir', name: 'tgl_lahir' },
              { data: 'tgl_wafat', name: 'tgl_wafat' },
              { data: 'tempat_lahir', name: 'tempat_lahir' },
              { data: 'tempat_wafat', name: 'tempat_wafat' },
              { data: 'nik', name: 'nik' },
              { data: 'alamat', name: 'alamat' },
              { data: 'keluarga', name: 'keluarga' },
              { data: 'author_create', name: 'author_create' },
              { data: 'author_update', name: 'author_update' },
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
                    let url = "{!! url('/jenazah/"+id+"') !!}";

                    $.ajax({
                        type: "DELETE",
                        dataType: "json",
                        url: url,
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#modal-detail').modal('hide');
                            $('#data-datatable').DataTable().ajax.reload();
                            Swal.fire(
                                data.title,
                                data.message,
                                data.status
                            )
                            // console.log(data.success)
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
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
            // END SWAL
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.number').keypress(function(e) {
                var charCode = (e.which) ? e.which : event.keyCode
                if (String.fromCharCode(charCode).match(/[^0-9]/g))
                    return false;
            });
        });

        $(".number").on('focus keyup', function() {
            var $input = $(this);
            var value = $input.val();
            var maxLength = parseInt($input.attr('maxlength'));
            var remainingLength = maxLength - value.length;
            if (remainingLength < 0) {
                $input.val(value.substr(0, maxLength));
                remainingLength = 0;
            }
            // $input.next().show().text(remainingLength);
            $(".input-number").text(remainingLength);
        });

        $(".input-number").focusout(function() {
            $(this).next().text('');
        });
    </script>

    <script>
        function readMore(e){
            let id = $(e).data('id');
            let alamat = $(e).data('alamat');

            $('#modal-body-alamat').html(`<p>${alamat}</p>`);
            $('#modalAlamat').modal('show');
        }
    </script>
@endpush
