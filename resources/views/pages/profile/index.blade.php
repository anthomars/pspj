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
                {{-- <div class="ribbon bg-info">My Profile</div> --}}
                <div class="row g-0">
                    <div class="col-12 col-md-3 border-end">
                        <div class="card-body">
                            <h4 class="subheader">Account settings</h4>
                            <div class="list-group list-group-transparent">
                                <a href="{{ url('user/profile') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center active">My
                                    Account</a>
                                <a href="{{ url('user/profile/password') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">Password</a>
                                {{-- <div class="d-grid gap-2 ms-2 me-2">
                                    <a href="{{ url('user/request-order') }}" class="btn btn-primary"><b>My Request Orders</b></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-9">
                        <div class="card-body mb-4">
                            <div class="row g-2 align-items-center">
                                <div class="col">
                                    <!-- Page pre-title -->
                                    <div class="page-pretitle">My Account</div>
                                    <h2 class="page-title">Profile Details</h2>
                                </div>
                            </div>
                            <div class="row align-items-center mt-5">
                                @if ($user->image)
                                    <div class="col-md-2"><span class="avatar avatar-xl"
                                            style="background-image: url('{{ asset('storage/' . $user->image) }}')"></span>
                                    </div>
                                @else
                                    <div class="col-md-2"><span class="avatar avatar-xl">{{ explodeFullname($user->nama_lengkap) }}</span>
                                    </div>
                                @endif
                                <div class="col-md-2">
                                    <form action="{{ route('user.profile.updateAvatar') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="file" class="form-control-file d-none" name="photo"
                                                id="avatarFile" aria-describedby="fileHelp">
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3 d-none">Change Avatar</button>
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <button data-id="{{ $user->id }}" onclick="deletePhoto('{{ $user->id }}')"
                                        class="btn btn-ghost-danger d-none">
                                        Delete avatar
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-label">User Id</div>
                                    <input type="text" name="id"
                                        class="form-control @error('uuid') is-invalid @enderror" value="{{ $user->id }}"
                                        disabled>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label">Nama</div>
                                    <input type="text" name="nama_lengkap"
                                        class="form-control @error('nama_lengkap') is-invalid @enderror"
                                        value="{{ $user->nama_lengkap }}" disabled>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-label">Username</div>
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ $user->username }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label">Phone</div>
                                    <input type="text" name="no_hp"
                                        class="form-control @error('no_hp') is-invalid @enderror"
                                        value="{{ $user->no_hp }}" disabled>
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <form action="{{ url('user/profile/email') }}" method="POST" onsubmit="splashLoading()">
                                @csrf
                                <div class="row mt-5 mb-2">
                                    <div class="form-label">Email</div>
                                    <p class="card-subtitle mt-2">This contact will be shown to others publicly, so choose
                                        it
                                        carefully.</p>
                                    <div class="col-md-6">
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ $user->email }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md">
                                        @if ($user->is_active == 1)
                                            <button class="btn btn-outline-success me-2" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-check" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                                Verified
                                            </button>
                                            <button type="submit" id="submit-changeEmail"
                                                class="btn btn-primary">Change</button>
                                            <button type="submit" id="submit-changeEmail-loading"
                                                class="btn btn-primary" style="display: none" disabled>
                                                <span class="spinner-border spinner-border-sm me-2"
                                                    role="status"></span>Loading
                                            </button>
                                        {{-- @else
                                            <button class="btn btn-outline-danger" disabled>Not Verified</button>
                                            <a href="{{ route('verification.notice') }}" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-mail" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z">
                                                    </path>
                                                    <path d="M3 7l9 6l9 -6"></path>
                                                </svg>
                                                Resend a verification
                                            </a> --}}
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <a href="{{ url('/user/profile/edit') }}" class="btn btn-primary">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                        </path>
                                        <path d="M16 5l3 3"></path>
                                    </svg>
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- <script src="{{ asset('templates/tabler/dist/libs/fslightbox/index.js?1685976846') }}" defer></script> --}}
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
                    let url = "{!! url('/user/profile/"+id+"') !!}";

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
        $('#modal-change-password').on('hidden.bs.modal', function() {
            $('#current_password').val('');
            $('#new_password').val('');
            $('#confirm_new_password').val('');
        });

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

            let id = $('#changePasswordBtn').data('id');
            let url = "{!! url('/user/profile/changePassword/"+id+"') !!}";

            $.ajax({
                url: url,
                dataType: 'json',
                type: "put",
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

                    // location.reload(true);
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
