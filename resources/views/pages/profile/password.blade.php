@extends('layouts.template')
@section('title', 'User Account')
@section('content')

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                    <div class="card-body">
                        <h4 class="subheader">ACCOUNT SETTINGS</h4>
                        <div class="list-group list-group-transparent">
                            <a href="{{ url('user/profile') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center">My Account</a>
                            <a href="{{ url('user/profile/password') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center active">Password</a>
                            {{-- <div class="d-grid gap-2 ms-2 me-2">
                                <a href="{{ url('user/request-order') }}" class="btn btn-primary"><b>My Request Orders</b></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col d-flex flex-column">
                    <form action="{{ url('user/profile/password') }}" method="POST" onsubmit="splashLoading()">
                        @csrf
                        <div class="card-body mb-4">
                            <h2 class="mb-4">Password</h2>
                            @if ($userDB->password == 'password')
                                <div class="input-group input-group-flat">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                                    <span class="input-group-text show_password">
                                        <div class="eyes_not_show_password">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" /><path d="M3 15l2.5 -3.8" /><path d="M21 14.976l-2.492 -3.776" /><path d="M9 17l.5 -4" /><path d="M15 17l-.5 -4" /></svg>
                                        </div>
                                        <div class="eyes_show_password d-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                        </div>
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-label mt-3">Confirm password</div>
                                <div class="input-group input-group-flat">
                                    <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Confirm Password">
                                    <span class="input-group-text show_confirm_password">
                                        <div class="eyes_not_show_confirm_password">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" /><path d="M3 15l2.5 -3.8" /><path d="M21 14.976l-2.492 -3.776" /><path d="M9 17l.5 -4" /><path d="M15 17l-.5 -4" /></svg>
                                        </div>
                                        <div class="eyes_show_confirm_password d-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                        </div>
                                    </span>
                                    @error('confirm_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @else
                                <div class="form-label">Current password</div>
                                <div class="input-group input-group-flat">
                                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" placeholder="Current Password">
                                    <span class="input-group-text show_current_password">
                                        <div class="eyes_not_show_current_password">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" /><path d="M3 15l2.5 -3.8" /><path d="M21 14.976l-2.492 -3.776" /><path d="M9 17l.5 -4" /><path d="M15 17l-.5 -4" /></svg>
                                        </div>
                                        <div class="eyes_show_current_password d-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                        </div>
                                    </span>
                                    @error('current_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- <a href="{{ route('forgot.password.auth') }}" class="btn btn-sm btn-link" >Forgot your password?</a> --}}

                                <div class="form-label mt-3">New password</div>
                                <div class="input-group input-group-flat">
                                    <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="New Password">
                                    <span class="input-group-text show_new_password">
                                        <div class="eyes_not_show_new_password">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" /><path d="M3 15l2.5 -3.8" /><path d="M21 14.976l-2.492 -3.776" /><path d="M9 17l.5 -4" /><path d="M15 17l-.5 -4" /></svg>
                                        </div>
                                        <div class="eyes_show_new_password d-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                        </div>
                                    </span>
                                    @error('new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-label mt-3">Confirm password</div>
                                <div class="input-group input-group-flat">
                                    <input type="password" name="confirm_new_password" class="form-control @error('confirm_new_password') is-invalid @enderror" id="confirm_new_password" placeholder="Confirm Password">
                                    <span class="input-group-text show_confirm_new_password">
                                        <div class="eyes_not_show_confirm_new_password">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" /><path d="M3 15l2.5 -3.8" /><path d="M21 14.976l-2.492 -3.776" /><path d="M9 17l.5 -4" /><path d="M15 17l-.5 -4" /></svg>
                                        </div>
                                        <div class="eyes_show_confirm_new_password d-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                        </div>
                                    </span>
                                    @error('confirm_new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <button type="submit" id="submit" class="btn btn-primary">Update</button>
                                <button type="submit" id="submit-loading" class="btn btn-primary" style="display: none"
                                    disabled>
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
<div class="overlay_submit_loading"></div>
<div class="spanner_submit_loading">
    <div class="loading_circle_submit_loading">
        <div class="spinner-grow text-blue" style="width: 3rem; height: 3rem;" role="status"><span
                class="visually-hidden">Loading...</span></div>
    </div>
</div>

<!-- Modal Forgot Password-->
<div class="modal top fade" id="forgotPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog" style="width: 300px;">
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">

                {{ Session::get('message') }}

            </div>
        @endif
        <div class="modal-content text-center">
            <div class="modal-header h5 text-white bg-primary justify-content-center">
                Password Reset
            </div>
            <div class="modal-body px-5">
                <p class="py-2">
                    Masukkan email anda dan kami akan mengirimkam email berisi perintah untuk mengatur ulang password anda.
                </p>
                <form action="" method="post" onsubmit="document.getElementById('submit1').style.display = 'block';document.getElementById('submit2').style.display = 'none';">
                    @csrf
                    <div class="form-floating">
                        <input type="email" name="email" id="email"
                            class="form-control my-3 @error('email') is-invalid @enderror" required />
                        <label class="form-label" for="email">Email</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- <button type="submit" class="btn btn-primary w-100">Reset password</button> --}}
                    <button type="submit" id="submit1" class="btn btn-primary w-100" disabled style="display: none"><span class="spinner-border"></span></button>
                    <button type="submit" id="submit2" class="btn btn-primary w-100">Request new password</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('css')
<link href="{{ asset('dist/css/custom-loading.css') }}" rel="stylesheet" />
@endpush
@push('js')
<script type="text/javascript">
    function splashLoading() {
        document.getElementById('submit').style.display = 'none';
        document.getElementById('submit-loading').style.display = 'block';

        $('.overlay_submit_loading').addClass('show_loading');
        $('.spanner_submit_loading').addClass('show_loading');
    }
</script>
<script>
    $(document).ready(function() {
            $('.show_password').click(function() {
                if($('#password').attr('type') == 'password') {
                    $('.eyes_not_show_password').addClass('d-none');
                    $('.eyes_show_password').removeClass('d-none');
                    $('#password').attr('type', 'text');
                } else {
                    $('.eyes_show_password').addClass('d-none');
                    $('.eyes_not_show_password').removeClass('d-none');
                    $('#password').attr('type', 'password');
                }
            });

            $('.show_confirm_password').click(function() {
                if($('#confirm_password').attr('type') == 'password') {
                    $('.eyes_not_show_confirm_password').addClass('d-none');
                    $('.eyes_show_confirm_password').removeClass('d-none');
                    $('#confirm_password').attr('type', 'text');
                } else {
                    $('.eyes_show_confirm_password').addClass('d-none');
                    $('.eyes_not_show_confirm_password').removeClass('d-none');
                    $('#confirm_password').attr('type', 'password');
                }
            });

            $('.show_current_password').click(function() {
                if($('#current_password').attr('type') == 'password') {
                    $('.eyes_not_show_current_password').addClass('d-none');
                    $('.eyes_show_current_password').removeClass('d-none');
                    $('#current_password').attr('type', 'text');
                } else {
                    $('.eyes_show_current_password').addClass('d-none');
                    $('.eyes_not_show_current_password').removeClass('d-none');
                    $('#current_password').attr('type', 'password');
                }
            });

            $('.show_new_password').click(function() {
                if($('#new_password').attr('type') == 'password') {
                    $('.eyes_not_show_new_password').addClass('d-none');
                    $('.eyes_show_new_password').removeClass('d-none');
                    $('#new_password').attr('type', 'text');
                } else {
                    $('.eyes_show_new_password').addClass('d-none');
                    $('.eyes_not_show_new_password').removeClass('d-none');
                    $('#new_password').attr('type', 'password');
                }
            });

            $('.show_confirm_new_password').click(function() {
                if($('#confirm_new_password').attr('type') == 'password') {
                    $('.eyes_not_show_confirm_new_password').addClass('d-none');
                    $('.eyes_show_confirm_new_password').removeClass('d-none');
                    $('#confirm_new_password').attr('type', 'text');
                } else {
                    $('.eyes_show_confirm_new_password').addClass('d-none');
                    $('.eyes_not_show_confirm_new_password').removeClass('d-none');
                    $('#confirm_new_password').attr('type', 'password');
                }
            });
        });
</script>
@endpush
