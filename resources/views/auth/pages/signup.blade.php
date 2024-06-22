@extends('auth.layouts.template-tabler')
@section('title', 'Signup User')
@section('content')
<div class="row g-0 flex-fill">
    <div class="col-12 col-lg-6 col-xl-5 border-top-wide border-primary d-flex flex-column justify-content-center">
        <div class="container container-tight my-5 px-lg-1">
            <div class="text-center mb-4">
                <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark"><img src="{{ asset('storage/' . appSetting()->logo_apps) }}" height="36" alt="">{{ appSetting()->nama_apps }}</a>
            </div>
            <h2 class="h3 text-center mb-3">
            Create new account
            </h2>
            <form action="{{ route('signup') }}" method="post" onsubmit="checkAgree();">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}" placeholder="Enter full name">
                    @error('nama_lengkap')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Enter name">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="tel" name="nik" id="nik" class="form-control number @error('nik') is-invalid @enderror" value="{{ old('nik') }}" minlength="16" maxlength="16" placeholder="Enter NIK">
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="no_hp" id="no_hp" class="form-control number @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" minlength="8" maxlength="15" placeholder="Enter phone number">
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="your@email.com" autocomplete="off">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">RT</label>
                            <select type="text" id="rt_id" name="rt_id" class="form-select @error('rt_id') is-invalid @enderror" value="{{ old('rt_id') }}">
                                @forelse ($rt as $item)
                                <option value="{{ $item->id_rt }}">{{ $item->no_rt }}</option>
                                @empty
                                <option value="" selected disabled>No data</option>
                                @endforelse
                            </select>
                            @error('rt_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">RW</label>
                            <select type="text" id="rw_id" name="rw_id" class="form-select @error('rw_id') is-invalid @enderror" value="{{ old('rw_id') }}">
                                @forelse ($rw as $item)
                                <option value="{{ $item->id_rw }}">{{ $item->no_rw }}</option>
                                @empty
                                <option value="" selected disabled>No data</option>
                                @endforelse
                            </select>
                            @error('rw_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        Password
                    </label>
                    <div class="input-group input-group-flat">
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Your password"  autocomplete="off">
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
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        Confirm Password
                    </label>
                    <div class="input-group input-group-flat">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"  placeholder="Confirm Your password"  autocomplete="off">
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
                </div>
                <div class="mb-3">
                    <label class="form-check">
                    <input type="checkbox" class="form-check-input" id="agreeTerms" name="terms" value="agree"/>
                    <span class="form-check-label">Agree the <a href="{{ url('pages/term-and-condition') }}" target="_blank" tabindex="-1">terms and policy</a>.</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" id="submit1" class="btn btn-primary w-100" disabled style="display: none"><span class="spinner-border"></span></button>
                    <button type="submit" id="submit2" class="btn btn-primary w-100">Sign Up</button>
                </div>
            </form>
            <div class="text-center text-muted mt-3">
                Already have account? <a href="{{ route('login') }}" tabindex="-1">Sign In</a>
            </div>
        </div>
    </div>
        <div class="col-12 col-lg-6 col-xl-7 d-none d-lg-block">
        <!-- Photo -->
        <div class="bg-cover h-100 min-vh-100" style="background-image: url({{ asset('storage/pemakaman/pemakaman.jpg') }})"></div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('templates/tabler/dist/libs/tom-select/dist/js/tom-select.base.min.js?1692305289') }}" defer></script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {
            var el;
            window.TomSelect && (new TomSelect(el = document.getElementById('rt_id'), {
                copyClassesToDropdown: false,
                dropdownParent: 'body',
                // controlInput: '<input>',
                render:{
                    item: function(data,escape) {
                        if( data.customProperties ){
                            return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    option: function(data,escape){
                        if( data.customProperties ){
                            return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                },
            }));
        });
        document.addEventListener("DOMContentLoaded", function () {
            var el;
            window.TomSelect && (new TomSelect(el = document.getElementById('rw_id'), {
                copyClassesToDropdown: false,
                dropdownParent: 'body',
                // controlInput: '<input>',
                render:{
                    item: function(data,escape) {
                        if( data.customProperties ){
                            return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    option: function(data,escape){
                        if( data.customProperties ){
                            return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                },
            }));
        });
        // @formatter:on
    </script>
    <script>
        $(document).ready(function () {
            $('.number').keypress(function (e) {
            var charCode = (e.which) ? e.which : event.keyCode
            if (String.fromCharCode(charCode).match(/[^0-9]/g))
                return false;
            });
        });
    </script>
    <script>
        function checkAgree() {
            if($('#agreeTerms').is(":checked")) {
                $('#submit1').show();
                $('#submit2').hide();
            } else {
                Swal.fire({
                    title: `Attention`,
                    text: "Please read our term and check our agreement!",
                    icon: "warning",
                    // buttons: true,
                })
                event.preventDefault();
            }
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
        });
    </script>
@endpush
