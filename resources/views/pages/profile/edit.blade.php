@extends('layouts.template')
@section('title', 'User Account')
@section('content')
    <!-- Page header -->
    {{-- <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Account Setting</h2>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-md-3 border-end">
                        <div class="card-body">
                            <h4 class="subheader">Account settings</h4>
                            <div class="list-group list-group-transparent">
                                <a href="{{ url('user/profile') }}" class="list-group-item list-group-item-action d-flex align-items-center active">My
                                    Account
                                </a>
                                <a href="{{ url('user/profile/password') }}" class="list-group-item list-group-item-action d-flex align-items-center">Password</a>
                                {{-- <div class="d-grid gap-2 ms-2 me-2">
                                    <a href="{{ url('user/request-order') }}" class="btn btn-primary"><b>My Request Orders</b></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-9 d-flex flex-column">
                        <div class="card-body">
                            <div class="row g-2 align-items-center">
                                <div class="col">
                                    <!-- Page pre-title -->
                                    <div class="page-pretitle">My Account</div>
                                    <h2 class="page-title">Profile Edit</h2>
                                </div>
                            </div>
                            <div class="row align-items-center mt-5">
                                @if ($user->photo)
                                    <div class="col-auto">
                                        <span class="avatar avatar-xl" style="background-image: url('{{ asset('storage/' . $user->image) }}')"></span>
                                    </div>
                                @else
                                    <div class="col-auto">
                                        <span class="avatar avatar-xl">{{ explodeFullname($user->nama_lengkap) }}</span>
                                    </div>
                                @endif
                                <div class="col-auto">
                                    <button class="btn btn-ghost-primary" data-bs-toggle="modal" data-bs-target="#modal-change-avatar">
                                        {{ $user->photo ? 'Change Photo' : 'Add Photo' }}
                                    </button>
                                </div>
                                @if($user->photo)
                                    <div class="col-auto">
                                        <button data-id="{{ $user->id }}" onclick="deletePhoto('{{ $user->id }}')" class="btn btn-ghost-danger">
                                            Delete Photo
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <form action="{{ route('user.profile.update') }}" method="POST" onsubmit="splashLoading()">
                            @method('put')
                            @csrf
                            <div class="card-body mb-4">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-label">NIK</div>
                                        <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ $user->nik }}" disabled>
                                        @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label">Nama</div>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ $user->nama_lengkap }}">
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <div class="form-label">Username</div>
                                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label">Phone</div>
                                        <input type="tel" name="no_hp" id="no_hp" class="form-control number @error('no_hp') is-invalid @enderror" value="{{ $user->no_hp }}">
                                        @error('no_hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer bg-transparent mt-auto d-flex justify-content-between">
                                <a href="{{ url('/user/profile') }}" class="btn" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M15 6l-6 6l6 6"></path>
                                    </svg>
                                    back
                                </a>
                                <div class="btn-list justify-content-end">
                                    <button type="submit" id="submit" class="btn btn-primary">Update</button>
                                    <button type="submit" id="submit-loading" class="btn btn-primary"
                                        style="display: none" disabled>
                                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>Loading
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-change-avatar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Photo Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id='frmTarget' name='dropzone' action="{{ route('user.profile.updateAvatar') }}" method="POST"
                    onsubmit="splashLoading()" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div id="display_photo_show_edit">
                            <input type="text" hidden id="photo_show_edit" name="photo" class="form-control" placeholder="Photo">
                            <div class="dropzone dropzone-file-area" id="fileUploadEdit">
                                <div class="dz-default dz-message">
                                    <h3 class="sbold">Drop files here to upload</h3>
                                    <span>You can also click to open file browser</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" id="submitAvatar" class="btn btn-primary ms-auto">
                            Submit
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto submit-loading" style="display: none" disabled>
                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>Loading
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('cssTop')
    <link href="{{ asset('templates/tabler/dist/libs/dropzone/dist/dropzone.css?1685976846') }}" rel="stylesheet" />
    <script src="{{ asset('templates/tabler/dist/libs/dropzone/dist/dropzone-min.js?1685976846') }}" defer></script>
@endpush
@push('js')
    {{-- <script src="{{ asset('templates/tabler/dist/libs/fslightbox/index.js?1685976846') }}" defer></script> --}}
    <script src="{{ asset('templates/tabler/dist/libs/tinymce/tinymce.min.js?1685976624') }}" defer></script>
    <script type="text/javascript">
        function splashLoading() {
            document.getElementById('submit').style.display = 'none';
            document.getElementById('submit-loading').style.display = 'block';

            $('.overlay_submit_loading').addClass('show_loading');
            $('.spanner_submit_loading').addClass('show_loading');
        }
    </script>

    <script>
        function deletePhoto(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah anda ingin manghapus foto?",
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{!! url('/user/profile/photo/"+id+"') !!}";

                    // console.log(url);
                    $.ajax({
                        type: "DELETE",
                        dataType: "json",
                        url: url,
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            // $('#data-datatable').DataTable().ajax.reload();
                            location.reload(true);
                            Swal.fire(
                                data.title,
                                data.message,
                                data.status
                            )
                            // console.log(data.success)
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire(
                                'Gagal!',
                                'Proses tidak dapat dijalankan.',
                                'error'
                            )
                            // console.log(xhr.responseText);
                        }
                    });
                }
            })
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Dropzone("#fileUploadEdit", {
                autoProcessQueue: false,
                url: "{{ url('user/profile') }}",
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
