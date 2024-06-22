@extends('layouts.template')
@section('title', 'User Account')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">User Account</div>
                    <h2 class="page-title">List</h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-add">
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
                                <th>User</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Date Created</th>
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
                    <h5 class="modal-title">Add User Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <div id="image_input_hidden">
                                    {{-- <input type="text" hidden id="logo" name="logo" class="form-control" placeholder="Logo"> --}}
                                </div>
                                <div class="dropzone dropzone-file-area" id="fileUpload">
                                    <div class="dz-default dz-message">
                                        <h3 class="sbold">Drop files here to upload</h3>
                                        <span>You can also click to open file browser</span>
                                    </div>
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">User Name</label>
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="User Name">
                            <div id="message_username" class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" id="fullname" name="nama_lengkap" class="form-control"
                                placeholder="Full Name">
                            <div id="message_nama_lengkap" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                            <div id="message_email" class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number <span class="form-label-description input-number"></span></label>
                            <input type="text" id="phone" name="no_hp" class="form-control number" minlength="8"
                                maxlength="15" placeholder="Phone Number">
                            <div id="message_phone" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="text" id="password" name="password" class="form-control" placeholder="Password">
                            <div id="message_password" class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK<span class="form-label-description input-number"></span></label>
                            <input type="text" id="nik" name="nik" class="form-control number" minlength="8"
                                maxlength="16" placeholder="NIK">
                            <div id="message_nik" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">RT</label>
                            <select type="text" class="form-select" placeholder="--Please Select--" id="rt_id" name="rt_id" value="">
                            </select>
                            <div class="invalid-feedback" id="message_rt_id"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">RW</label>
                        <select type="text" class="form-select" placeholder="--Please Select--" id="rw_id" name="rw_id" value="">
                        </select>
                        <div class="invalid-feedback" id="message_rw_id"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select type="text" class="form-select" placeholder="--Please Select--" id="role_id" name="role_id" value="">
                        </select>
                        <div class="invalid-feedback" id="message_role_id"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <label class="form-check form-switch w-25">
                            <input id="is_active" class="form-check-input" type="checkbox" checked>
                            <span id="is_active" class="form-check-label"></span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="button" id="addBtn" class="btn btn-primary ms-auto">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Add
                    </button>
                    <button type="button" id="submit-loading" class="btn btn-primary ms-auto" style="display: none"
                        disabled>
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
                    <div class="row mt-1">
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <div id="photo_show_detail">
                                <img src="" id="photo_detail" class="rounded" style="height:4rem" alt="photo">
                                <span class="avatar avatar-xl mb-3 rounded" id="initial"></span>
                            </div>
                            <div id="display_photo_show_edit">
                                <input type="text" hidden id="photo_show_edit" name="image" class="form-control"
                                    placeholder="Photo">
                                <div class="dropzone dropzone-file-area" id="fileUploadEdit">
                                    <div class="dz-default dz-message">
                                        <h3 class="sbold">Drop files here to upload</h3>
                                        <span>You can also click to open file browser</span>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback" id="message_photo_show_edit" style="display: none"></div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" id="name_show_edit" name="nama_lengkap" class="form-control"
                                placeholder="Name" value="" disabled />
                            <div class="invalid-feedback" id="message_name_show_edit" style="display: none"></div>
                        </div>
                        {{-- <div class="mb-3 col-md-6">
                            <label class="form-label">Role</label>
                            <select type="text" class="form-select" name="role" id="role_show_edit" disabled>
                                <option value="" class="loading_role_option d-none">Loading...</option>
                            </select>
                            <div class="invalid-feedback" id="message_role_show_edit"></div>
                        </div> --}}
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Role</label>
                            <select type="text" class="form-select" placeholder="--Please Select--" id="role_id_show_edit" name="role_id_show_edit" value="" disabled>
                            </select>
                            <div class="invalid-feedback" id="message_role_id_show_edit"></div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Phone Number <span class="form-label-description input-number"></span></label>
                            <input type="text" id="phone_show_edit" name="no_hp" class="form-control number"
                                placeholder="No. HP" value="" minlength="8" maxlength="15" disabled />
                            <div class="invalid-feedback" id="message_phone_show_edit" style="display: none"></div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" id="email_show_edit" name="email" class="form-control"
                                placeholder="Name" value="" disabled />
                            <div class="invalid-feedback" id="message_email_show_edit" style="display: none"></div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">RT</label>
                            <select type="text" class="form-select" placeholder="--Please Select--" id="rt_id_show_edit" name="rt_id_show_edit" value="" disabled>
                            </select>
                            <div class="invalid-feedback" id="message_rt_id_show_edit"></div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">RW</label>
                            <select type="text" class="form-select" placeholder="--Please Select--" id="rw_id_show_edit" name="rw_id_show_edit" value="" disabled>
                            </select>
                            <div class="invalid-feedback" id="message_rw_id_show_edit"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <label class="form-check form-switch w-25">
                                <input id="is_active_show_edit" class="form-check-input" type="checkbox" checked
                                    disabled>
                                <span id="is_active_show_edit" class="form-check-label"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row mt-1 user_info">
                        <div class="col-md-6">
                            <div class="card bg-azure-lt p-2 mt-2">
                                <label class="form-label text-muted">Author Create</label>
                                <div class="row">
                                    <div class="col-auto">
                                        <span id="created_image_show_edit" class="avatar"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <a href="" id="created_href_show_edit">
                                                <strong>
                                                    <div id="created_fullname_show_edit"></div>
                                                </strong>
                                            </a>
                                        </div>
                                        <div id="created_at_show_edit" class="text-muted"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-azure-lt p-2 mt-2">
                                <label class="form-label text-muted">Author Update</label>
                                <div class="row">
                                    <div class="col-auto">
                                        <span id="modified_image_show_edit" class="avatar"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            <a href="" id="modified_href_show_edit">
                                                <strong>
                                                    <div id="modified_fullname_show_edit"></div>
                                                </strong>
                                            </a>
                                        </div>
                                        <div id="modified_at_show_edit" class="text-muted"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                            Edit
                        </button>
                        <button id="button_update" type="submit" class="btn btn-primary d-none">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
    <div class="modal modal-blur fade" id="modal-change-password" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password Admin Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="new_password" id="new_password" class="form-control"
                                autocomplete="off">
                            <span class="input-group-text">
                                <div class="input-group-link show_password">
                                    <div class="eyes_not_show">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4"></path>
                                            <path d="M3 15l2.5 -3.8"></path>
                                            <path d="M21 14.976l-2.492 -3.776"></path>
                                            <path d="M9 17l.5 -4"></path>
                                            <path d="M15 17l-.5 -4"></path>
                                        </svg>
                                    </div>
                                    <div class="eyes_show d-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </span>
                            <div class="invalid-feedback" id="message_new_password"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="button" id="changePasswordBtn" class="btn btn-primary ms-auto">
                        Submit
                    </button>
                    <button type="button" class="btn btn-primary ms-auto submit-loading" style="display: none" disabled>
                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>Loading
                    </button>
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
        $('#role_id').select2({
            theme: "bootstrap-5",
            dropdownParent: $('#role_id').parent(),
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            tags: true,
            selectionCssClass: 'select2--small',
            dropdownCssClass: 'select2--small',
        });
        $('#role_id_show_edit').select2({
            theme: "bootstrap-5",
            dropdownParent: $('#role_id_show_edit').parent(),
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            tags: true,
            selectionCssClass: 'select2--small',
            dropdownCssClass: 'select2--small',
        });

        $('#rt_id').select2({
            theme: "bootstrap-5",
            dropdownParent: $('#rt_id').parent(),
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            tags: true,
            selectionCssClass: 'select2--small',
            dropdownCssClass: 'select2--small',
        });
        $('#rt_id_show_edit').select2({
            theme: "bootstrap-5",
            dropdownParent: $('#rt_id_show_edit').parent(),
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            tags: true,
            selectionCssClass: 'select2--small',
            dropdownCssClass: 'select2--small',
        });
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
            $.fn.dataTable.moment('DD/MM/YYYY');

            $('#data-datatable').DataTable({
                processing: true,
                serverSide: true,
                'bAutoWidth':false,
                ajax: '{!! route('userAccount.dataTable') !!}', // memanggil route yang menampilkan data json
                columns: [ // mengambil & menampilkan kolom sesuai tabel database
                    {
                        "data": "id",
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        width: '50px'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        orderable: false,
                        width: '50px'
                    },
                    {
                        data: 'date_created',
                        name: 'date_created',
                        width: '210px'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '20px'
                    },
                ],
                // order: [
                //     [5, 'desc']
                // ],
                // "columnDefs": [{
                //     targets: 5,
                //     render: function(data, type, row) {
                //         var datetime = moment(data);
                //         var displayString = moment(datetime).format('DD MMMM YYYY LT');
                //         if (type === 'display' || type === 'filter') {
                //             return displayString;
                //         } else {
                //             return datetime;
                //         }
                //     }
                // }, ],
                "search": {
                    "search": "{{ Request::get('search') }}"
                },
            });

            $('input[type=search]').on('input', function(e) {
                if ('' == this.value) {
                    const cek = "{{ Request::get('search') }}";
                    if (cek) {
                        window.location = window.location.href.split("?")[0];
                    }
                }
            });
        });
    </script>
    <script>
        function getRt() {
            var role;
            $.ajax({
                url: "{{ route('rt.getRt') }}",
                dataType: 'json',
                type: "get",
                async: false,
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(data) {
                    role = data.data;
                },
                error: function(xhr) {},
            });

            return role;
        }
        function getRw() {
            var role;
            $.ajax({
                url: "{{ route('rw.getRw') }}",
                dataType: 'json',
                type: "get",
                async: false,
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(data) {
                    role = data.data;
                },
                error: function(xhr) {},
            });

            return role;
        }
        function getRole() {
            var role;
            $.ajax({
                url: "{{ route('role.getRole') }}",
                dataType: 'json',
                type: "get",
                async: false,
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(data) {
                    role = data.data;
                },
                error: function(xhr) {},
            });

            return role;
        }
    </script>
    <script>
        $('#modal-add').on('hidden.bs.modal', function() {
            $('#photo').removeClass('is-invalid');
            $('#username').removeClass('is-invalid');
            $('#fullname').removeClass('is-invalid');
            $('#email').removeClass('is-invalid');
            $('#phone').removeClass('is-invalid');
            $('#nik').removeClass('is-invalid');
            $('#password').removeClass('is-invalid');
            $('#rt_id').removeClass('is-invalid');
            $('#rw_id').removeClass('is-invalid');
            $('#role_id').removeClass('is-invalid');
            $('#message_photo').css('display', 'none');
            $('#message_username').css('display', 'none');
            $('#message_nama_lengkap').css('display', 'none');
            $('#message_email').css('display', 'none');
            $('#message_phone').css('display', 'none');
            $('#message_nik').css('display', 'none');
            $('#message_role_id').css('display', 'none');

            $('#rt_id').empty();
            $('#rw_id').empty();
            $('#role_id').empty();
        });

        $('#modal-add').on('shown.bs.modal', function() {
            let dataRole = `<option value="" selected disabled>-- Please Select --</option>`;
            let dataRt = `<option value="" selected disabled>-- Please Select --</option>`;
            let dataRw = `<option value="" selected disabled>-- Please Select --</option>`;

            // get Role
            getRole().forEach(getDataRole);
            function getDataRole(item, index) {
                dataRole += `<option value="${item.id_role}">${item.nama_role}</option>`;
            }
            $('#role_id').append(dataRole);

            // get Rt
            getRt().forEach(getDataRt);
            function getDataRt(item, index) {
                dataRt += `<option value="${item.id_rt}">${item.no_rt}</option>`;
            }
            $('#rt_id').append(dataRt);

            // get Rw
            getRw().forEach(getDataRw);
            function getDataRw(item, index) {
                dataRw += `<option value="${item.id_rw}">${item.no_rw}</option>`;
            }
            $('#rw_id').append(dataRw);
        });

        $(function() {
            $('#addBtn').click(function(e) {
                let id = $('#button_add').data('id');
                // let url = "{!! url('/user/"+id+"') !!}";
                let image = $('#image_input_hidden input[name="image"]').val();
                let username = $('#username').val();
                let fullname = $('#fullname').val();
                let email = $('#email').val();
                let phone = $('#phone').val();
                let password = $('#password').val();
                let nik = $('#nik').val();
                let rt_id = $('#rt_id option:selected').val();
                let rw_id = $('#rw_id option:selected').val();
                let role_id = $('#role_id option:selected').val();
                let is_active = $('#is_active_show_edit').prop('checked') == true ? 1 : 0;

                $.ajax({
                    url: "{{ route('userAccount.store') }}",
                    dataType: 'json',
                    type: "POST",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'image': image,
                        'username': username,
                        'nama_lengkap': fullname,
                        'email': email,
                        'no_hp': phone,
                        'password': password,
                        'nik': nik,
                        'rt_id': rt_id,
                        'rw_id': rw_id,
                        'role_id': role_id,
                        'is_active': is_active
                    },
                    beforeSend: function() {
                        $('.overlay_submit_loading').addClass('show_loading');
                        $('.spanner_submit_loading').addClass('show_loading');
                        $('#submit-loading').css('display', 'inline-block');
                        $('#addBtn').addClass('d-none');
                    },
                    success: function(data) {
                        $('#username').val('');
                        $('#fullname').val('');
                        $('#email').val('');
                        $('#phone').val('');
                        $('#password').val('');
                        $('#nik').val('');
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
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        })
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        $('#modal-add').modal('show');
                        if (xhr.responseJSON.errors.username !== undefined) {
                            $('#username').addClass('is-invalid');
                            $('#message_username').css('display', 'inline-block');
                            $('#message_username').text(xhr.responseJSON.errors.username[0]);
                        }
                        if (xhr.responseJSON.errors.nama_lengkap !== undefined) {
                            $('#fullname').addClass('is-invalid');
                            $('#message_nama_lengkap').css('display', 'inline-block');
                            $('#message_nama_lengkap').text(xhr.responseJSON.errors.nama_lengkap[0]);
                        }
                        if (xhr.responseJSON.errors.email !== undefined) {
                            $('#email').addClass('is-invalid');
                            $('#message_email').css('display', 'inline-block');
                            $('#message_email').text(xhr.responseJSON.errors.email[0]);
                        }
                        if (xhr.responseJSON.errors.no_hp !== undefined) {
                            $('#phone').addClass('is-invalid');
                            $('#message_phone').css('display', 'inline-block');
                            $('#message_phone').text(xhr.responseJSON.errors.no_hp[0]);
                        }
                        if (xhr.responseJSON.errors.nik !== undefined) {
                            $('#nik').addClass('is-invalid');
                            $('#message_nik').css('display', 'inline-block');
                            $('#message_nik').text(xhr.responseJSON.errors.nik[0]);
                        }
                        if (xhr.responseJSON.errors.password !== undefined) {
                            $('#password').addClass('is-invalid');
                            $('#message_password').css('display', 'inline-block');
                            $('#message_password').text(xhr.responseJSON.errors.password[0]);
                        }
                        if (xhr.responseJSON.errors.rt_id !== undefined) {
                            $('#rt_id').addClass('is-invalid');
                            $('#message_rt_id').css('display', 'inline-block');
                            $('#message_rt_id').text(xhr.responseJSON.errors.rt_id[0]);
                        }
                        if (xhr.responseJSON.errors.rw_id !== undefined) {
                            $('#rw_id').addClass('is-invalid');
                            $('#message_rw_id').css('display', 'inline-block');
                            $('#message_rw_id').text(xhr.responseJSON.errors.rw_id[0]);
                        }
                        if (xhr.responseJSON.errors.role_id !== undefined) {
                            $('#role_id').addClass('is-invalid');
                            $('#message_role_id').css('display', 'inline-block');
                            $('#message_role_id').text(xhr.responseJSON.errors.role_id[0]);
                        }
                    },
                    complete: function() {
                        $('.overlay_submit_loading').removeClass('show_loading');
                        $('.spanner_submit_loading').removeClass('show_loading');

                        $('#submit-loading').css('display', 'none');
                        $('#addBtn').removeClass('d-none');
                    },
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Dropzone.autoDiscover = false;
            new Dropzone("#fileUpload", {
                autoProcessQueue: false,
                url: "{{ url('user') }}",
                addRemoveLinks: true,
                uploadMultiple: true,
                acceptedFiles: 'image/*',
                maxFilesize: 2, // MB
                init: function() {
                    this.on('addedfile', function(file) {
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                width: 'auto',
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: 'Photo tidak bisa lebih dari satu!'
                            })
                        }
                    });

                    this.on("removedfile", function(file) {
                        let fileReader = new FileReader();

                        fileReader.readAsDataURL(file);
                        fileReader.onloadend = function() {

                            let content = fileReader.result;
                            $("#image_input_hidden").find(`input[value='${content}']`)
                                .remove();

                        }
                    });

                },
                accept: function(file) {
                    let fileReader = new FileReader();

                    fileReader.readAsDataURL(file);
                    fileReader.onloadend = function() {

                        let content = fileReader.result;

                        $("#image_input_hidden").append(`
                        <input type="text" hidden name="image" class="form-control" placeholder="Logo" value="${content}">
                    `);

                        file.previewElement.classList.add("dz-success");
                        $('.dz-progress').hide();

                    }
                },
                error: function(file, message) {
                    if (file.previewElement) {
                        file.previewElement.classList.add("dz-error");
                        if (typeof message !== "string" && message.error) {
                            message = message.error;
                        }
                        for (let node of file.previewElement.querySelectorAll(
                                "[data-dz-errormessage]"
                            )) {
                            node.textContent = message;
                        }
                    }
                    $('.dz-progress').hide();
                }
            });

            new Dropzone("#fileUploadEdit", {
                autoProcessQueue: false,
                url: "{{ url('user-account') }}",
                addRemoveLinks: true,
                uploadMultiple: false,
                acceptedFiles: 'image/*',
                maxFilesize: 2, // MB
                init: function() {
                    this.on('addedfile', function(file) {
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                width: 'auto',
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: 'File tidak boleh lebih dari satu!'
                            })
                        }
                    });

                    this.on("removedfile", function() {
                        $('#photo_show_edit').val('');
                    });

                },
                accept: function(file) {
                    let fileReader = new FileReader();

                    fileReader.readAsDataURL(file);
                    fileReader.onloadend = function() {

                        let content = fileReader.result;
                        $('#photo_show_edit').val(content);
                        file.previewElement.classList.add("dz-success");
                        $('.dz-progress').hide();

                    }
                },
                error: function(file, message) {
                    if (file.previewElement) {
                        file.previewElement.classList.add("dz-error");
                        if (typeof message !== "string" && message.error) {
                            message = message.error;
                        }
                        for (let node of file.previewElement.querySelectorAll(
                                "[data-dz-errormessage]"
                            )) {
                            node.textContent = message;
                        }
                    }
                    $('.dz-progress').hide();
                }
            });
        })
    </script>

<script>
    $('#modal-detail').on('hidden.bs.modal', function() {
        $('#title').text('User Detail');

        $('#display_photo_show_edit').hide();
        $('#photo_show_detail').show();
        $('#phone_show_edit').prop('disabled', true);
        $('#name_show_edit').prop('disabled', true);
        $('#email_show_edit').prop('disabled', true);
        // $('#role_show_edit').prop('disabled', true);
        $('#role_id_show_edit').prop('disabled', true);
        // $('#area_location_id_show_edit').prop('disabled', true);
        $('#phone_show_edit').prop('disabled', true);
        $('#is_active_show_edit').prop('disabled', true);

        $('#name_show_edit').removeClass('is-invalid');
        $('#message_name_show_edit').css('display', 'none');
        $('#email_show_edit').removeClass('is-invalid');
        $('#message_email_show_edit').css('display', 'none');
        // $('#role_show_edit').removeClass('is-invalid');
        // $('#message_role_show_edit').css('display', 'none');
        $('#rt_id_show_edit').removeClass('is-invalid');
        $('#rw_id_show_edit').removeClass('is-invalid');
        $('#role_id_show_edit').removeClass('is-invalid');
        $('#message_rt_id_show_edit').css('display', 'none');
        $('#message_rw_id_show_edit').css('display', 'none');
        $('#message_role_id_show_edit').css('display', 'none');
        // $('#area_location_id_show_edit').removeClass('is-invalid');
        // $('#message_area_location_id_show_edit').css('display', 'none');
        $('#phone_show_edit').removeClass('is-invalid');
        $('#message_phone_show_edit').css('display', 'none');


        // $('#role_show_edit').empty();

        $('.user_info').removeClass('d-none');

        $('#button_delete').removeClass('d-none');
        $('#button_edit').removeClass('d-none');
        $('#button_update').addClass('d-none');

        // $('#role_show_edit').append('<option value="" class="loading_brand_option d-none">Loading...</option>');
    });

    $("#button_edit").on("click", function() {
        $('#title').text('Admin Edit');
        $('#photo_show_detail').hide();
        $('#display_photo_show_edit').show();
        $('#name_show_edit').prop('disabled', false);
        // $('#role_show_edit').prop('disabled', false);
        $('#rt_id_show_edit').prop('disabled', false);
        $('#rw_id_show_edit').prop('disabled', false);
        $('#role_id_show_edit').prop('disabled', false);
        // $('#area_location_id_show_edit').prop('disabled', false);
        $('#email_show_edit').prop('disabled', false);
        $('#phone_show_edit').prop('disabled', false);
        $('#is_active_show_edit').prop('disabled', false);

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

    $("#is_active_show_edit").on("change", function() {
        if ($('#is_active_show_edit').prop('checked')) {
            $('#is_active_name_show_edit').text('On');
        } else {
            $('#is_active_name_show_edit').text('Off');
        }
    });

    @if( request()->get('detail') )
        $(document).ready(function () {
            detailData({{request()->get('detail')}})
        });
    @endif

    function detailData(id) {
        const modalDetail = new bootstrap.Modal('#modal-detail', {
            keyboard: false
        })

        // $('#role_show_edit').empty();
        $('#role_id_show_edit').empty();


        let dataRole = `<option value="" selected>-- Please Select --</option>`;
        let dataRt = `<option value="" selected>-- Please Select --</option>`;
        let dataRw = `<option value="" selected>-- Please Select --</option>`;

        getRt().forEach(getDataRt);
        function getDataRt(item, index) {
            dataRt += `<option value="${item.id_rt}">${item.no_rt}</option>`;
        }

        getRw().forEach(getDataRw);

        function getDataRw(item, index) {
            dataRw += `<option value="${item.id_rw}">${item.no_rw}</option>`;
        }
        getRole().forEach(getDataRole);

        function getDataRole(item, index) {
            dataRole += `<option value="${item.id_role}">${item.nama_role}</option>`;
        }

        $('#rt_id_show_edit').append(dataRt);
        $('#rw_id_show_edit').append(dataRw);
        $('#role_id_show_edit').append(dataRole);

        $('#title').text('Admin Detail');
        $('#display_photo_show_edit').hide();

        let url = "{!! url('/user-account/"+id+"') !!}";

        $.ajax({
            type: "GET",
            dataType: "json",
            url: url,
            data: {
                '_token': '{{ csrf_token() }}'
            },
            success: function(datas) {
                // regex Initial Name
                let full_name = datas.data.nama_lengkap;
                let rgx = new RegExp(/(\p{L}{1})\p{L}+/, 'gu');

                let initial = [...full_name.matchAll(rgx)] || [];

                initial = (
                    (initial.shift()?.[1] || '') + (initial.pop()?.[1] || '')
                ).toUpperCase();

                if(datas.data.image) {
                    $('#initial').addClass('d-none');
                    $('#photo_detail').removeClass('d-none');
                    $('#photo_detail').prop('src', "{!! asset('storage/"+datas.data.image+"') !!}");
                } else {
                    $('#initial').removeClass('d-none');
                    $('#photo_detail').addClass('d-none');
                    $('#initial').text(initial);
                }
                $('#name_show_edit').val(datas.data.nama_lengkap);
                // $('#role_show_edit').val(datas.data.roles[0].id).trigger('change');
                $('#rt_id_show_edit').val(datas.data.rt_id).trigger('change');
                $('#rw_id_show_edit').val(datas.data.rw_id).trigger('change');
                $('#role_id_show_edit').val(datas.data.role_id).trigger('change');
                $('#phone_show_edit').val(datas.data.no_hp);
                $('#email_show_edit').val(datas.data.email);
                // console.log(datas.data);

                let imageCreated = "url({!! asset('storage/"+datas.data.image+"') !!})"
                // let urlCreated = "{!! url('/user/"+datas.data.author_create+"') !!}";

                $('#created_image_show_edit').css("background-image", imageCreated);
                // $('#created_href_show_edit').attr("href", urlCreated);
                $('#created_fullname_show_edit').text(datas.data.author_create);
                $('#created_at_show_edit').text(datas.data.date_created);

                let imageModified = "url({!! asset('storage/"+datas.data.image+"') !!})"
                // let urlModified = "{!! url('/user/"+datas.data.author_update+"') !!}";

                $('#modified_image_show_edit').css("background-image", imageModified);
                // $('#modified_href_show_edit').attr("href", urlModified);
                $('#modified_fullname_show_edit').text(datas.data.author_update);
                // $('#modified_at_show_edit').text(datas.data.date_created);

                $('#button_update').data('id', datas.data.id)
                $('#button_delete').data('id', datas.data.id)

                if (datas.data.is_active == 1) {
                    $('#is_active_show_edit').prop('checked', true);
                    $('#is_active_name_show_edit').text('On');
                } else {
                    $('#is_active_show_edit').prop('checked', false);
                    $('#is_active_name_show_edit').text('Off');
                }

                modalDetail.show();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.fire(
                    xhr.responseJSON.title,
                    xhr.responseJSON.message,
                    xhr.responseJSON.status
                )
                // console.log(xhr.responseJSON);
            }
        });
    }

    $('#button_update').click(function(e) {
        let id = $('#button_update').data('id');
        let url = "{!! url('/user-account/"+id+"') !!}";
        let photo = $('#photo_show_edit').val();
        let name = $('#name_show_edit').val();
        let email = $('#email_show_edit').val();
        // let role = $('#role_show_edit option:selected').val();
        let rt_id = $('#rt_id_show_edit option:selected').val();
        let rw_id = $('#rw_id_show_edit option:selected').val();
        let role_id = $('#role_id_show_edit option:selected').val();
        // let area_location_id_result = area_location_id.map((value) => value);
        let phone = $('#phone_show_edit').val();
        let is_active = $('#is_active_show_edit').prop('checked') == true ? 1 : 0;
        $.ajax({
            url: url,
            dataType: 'json',
            type: "post",
            data: {
                '_token': '{{ csrf_token() }}',
                'image': photo,
                'nama_lengkap': name,
                'email': email,
                // 'role': role,
                'rt_id': rt_id,
                'rw_id': rw_id,
                'role_id': role_id,
                // 'area_location_id': area_location_id,
                'no_hp': phone,
                'is_active': is_active
            },
            beforeSend: function() {
                $('.overlay_submit_loading').addClass('show_loading');
                $('.spanner_submit_loading').addClass('show_loading');
            },
            success: function(data) {
                $('#photo_show_edit').val('');
                $('#name_show_edit').val('');
                $('#email_show_edit').val('');
                $('#phone_show_edit').val('');
                $('#modal-detail').modal('hide');

                Dropzone.forElement('#fileUploadEdit').removeAllFiles(true);

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
                } else if (data.status == 'error') {
                    Toast.fire({
                        icon: 'error',
                        title: data.message
                    })
                } else if (data.status == 'info') {
                    Toast.fire({
                        icon: 'info',
                        title: data.message
                    })
                }
                // console.log(data);
            },
            error: function(xhr) {
                $('#modal-detail').modal('show');

                // console.log(xhr);
                if (xhr.responseJSON.errors) {
                    if (xhr.responseJSON.errors.image !== undefined) {
                        $('#photo_show_edit').addClass('is-invalid');
                        $('#message_photo_show_edit').css('display', 'inline-block');
                        $('#message_photo_show_edit').text(xhr.responseJSON.errors.image[0]);
                    }
                    if (xhr.responseJSON.errors.nama_lengkap !== undefined) {
                        $('#name_show_edit').addClass('is-invalid');
                        $('#message_name_show_edit').css('display', 'inline-block');
                        $('#message_name_show_edit').text(xhr.responseJSON.errors.nama_lengkap[0]);
                    }
                    // if (xhr.responseJSON.errors.role !== undefined) {
                    //     $('#role_show_edit').addClass('is-invalid');
                    //     $('#message_role_show_edit').css('display', 'inline-block');
                    //     $('#message_role_show_edit').text(xhr.responseJSON.errors.role[0]);
                    // }
                    if (xhr.responseJSON.errors.no_hp !== undefined) {
                        $('#phone_show_edit').addClass('is-invalid');
                        $('#message_phone_show_edit').css('display', 'inline-block');
                        $('#message_phone_show_edit').text(xhr.responseJSON.errors.no_hp[0]);
                    }
                    if (xhr.responseJSON.errors.email !== undefined) {
                        $('#email_show_edit').addClass('is-invalid');
                        $('#message_email_show_edit').css('display', 'inline-block');
                        $('#message_email_show_edit').text(xhr.responseJSON.errors.email[0]);
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
        function updateStatus(id) {
            var active = $(id).prop('checked') == true ? 1 : 0;
            var dataId = $(id).data('id');

            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah anda ingin mengubah status?",
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '{{ route('changeStatusUser') }}',
                        data: {
                            'is_active': active,
                            'id': dataId
                        },
                        success: function(data) {
                            Swal.fire(
                                data.title,
                                data.message,
                                data.status
                            )

                            if ($(id).prop('title') == 'Status On') {
                                $(id).prop('title', 'Status Off');
                            } else {
                                $(id).prop('title', 'Status On');
                            }
                            // console.log(data)
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire(
                                xhr.responseJSON.title,
                                xhr.responseJSON.message,
                                xhr.responseJSON.status
                            )
                            // console.log(xhr.responseJSON);
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    if ($(id).prop('checked')) {
                        $(id).prop('checked', !$(id).prop('checked'));
                        $(id).prop('title', 'Status Off');
                    } else {
                        $(id).prop('checked', !$(id).prop('checked'));
                        $(id).prop('title', 'Status On');
                    }
                }
            })
        }
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
                    let url = "{!! url('/user-account/"+id+"') !!}";

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
        function changePassword(adminId) {
            const modalChangePassword = new bootstrap.Modal('#modal-change-password', {
                keyboard: false
            })

            $('#changePasswordBtn').data('id', adminId);

            $('#modal-change-password').modal('show');
        }

        $('#changePasswordBtn').click(function(e) {
            let password = $('#new_password').val();

            let formData = new FormData();
            formData.append('password', password);
            formData.append('_token', '{{ csrf_token() }}');

            let adminId = $('#changePasswordBtn').data('id');
            let url = "{!! url('/user-account/changePassword/"+adminId+"') !!}";

            $.ajax({
                url: url,
                dataType: 'json',
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                beforeSend: function() {
                    $('.overlay_submit_loading').addClass('show_loading');
                    $('.spanner_submit_loading').addClass('show_loading');
                    $('.submit-loading').css('display', 'inline-block');
                    $('#changePasswordBtn').addClass('d-none');
                },
                success: function(data) {

                    $('#modal-change-password').modal('hide');

                    $('#admin-datatable').DataTable().ajax.reload();

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
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
                    } else if (data.status == 'error') {
                        // console.log(data.error);
                        Toast.fire({
                            icon: 'error',
                            title: data.message
                        })
                    } else if (data.status == 'info') {
                        Toast.fire({
                            icon: 'info',
                            title: data.message
                        })
                    }
                },
                error: function(xhr) {
                    $('#modal-change-password').modal('show');
                    if (xhr.responseJSON.errors.password !== undefined) {
                        $('#new_password').addClass('is-invalid');
                        $('#message_new_password').css('display', 'inline-block');
                        $('#message_new_password').text(xhr.responseJSON.errors.password[0]);
                    }
                },
                complete: function() {
                    $('.overlay_submit_loading').removeClass('show_loading');
                    $('.spanner_submit_loading').removeClass('show_loading');

                    $('.submit-loading').css('display', 'none');
                    $('#changePasswordBtn').removeClass('d-none');
                },
            });
        });
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

        $('.show_password').mousedown(function() {
            $('.eyes_not_show').addClass('d-none');
            $('.eyes_show').removeClass('d-none');
            $('#new_password').attr('type', 'text');
        });

        $('.show_password').mouseup(function() {
            $('.eyes_show').addClass('d-none');
            $('.eyes_not_show').removeClass('d-none');
            $('#new_password').attr('type', 'password');
        });
    </script>
@endpush
