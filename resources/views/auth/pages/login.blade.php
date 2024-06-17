@extends('auth.layouts.template-tabler')
@section('title', 'Login User')
@section('content')
<div class="row g-0 flex-fill">
    <div class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
        <div class="container container-tight my-5 px-lg-5">
            <div class="text-center mb-4">
                <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark"><img src="{{ asset('storage/' . appSetting()->logo_apps) }}" height="36" alt="">{{ appSetting()->nama_apps }}</a>
            </div>
            <h2 class="h3 text-center mb-3">
            Login to your account
            </h2>
            <form action="{{ route('login') }}" method="post" autocomplete="on" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@email.com" autocomplete="off">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        Password
                        {{-- <span class="form-label-description">
                            <a href="{{ route('password.request') }}">I forgot password</a>
                        </span> --}}
                    </label>
                    <div class="input-group input-group-flat">
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Your password"  autocomplete="off">
                        <span class="input-group-text show_password">
                            <div class="eyes_not_show">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" /><path d="M3 15l2.5 -3.8" /><path d="M21 14.976l-2.492 -3.776" /><path d="M9 17l.5 -4" /><path d="M15 17l-.5 -4" /></svg>
                            </div>
                            <div class="eyes_show d-none">
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
                {{-- <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input"/>
                        <span class="form-check-label">Remember me on this device</span>
                    </label>
                </div> --}}
                <div class="form-footer">
                    <button type="submit" id="submit" class="btn btn-primary w-100">Sign in</button>
                </div>
                {{-- <div class="social-auth-links text-center mt-3">
                    <a href="{{ url('user/auth/google') }}" class="btn btn-danger w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-google-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2a9.96 9.96 0 0 1 6.29 2.226a1 1 0 0 1 .04 1.52l-1.51 1.362a1 1 0 0 1 -1.265 .06a6 6 0 1 0 2.103 6.836l.001 -.004h-3.66a1 1 0 0 1 -.992 -.883l-.007 -.117v-2a1 1 0 0 1 1 -1h6.945a1 1 0 0 1 .994 .89c.04 .367 .061 .737 .061 1.11c0 5.523 -4.477 10 -10 10s-10 -4.477 -10 -10s4.477 -10 10 -10z" stroke-width="0" fill="currentColor" /></svg>
                        Sign in with Google
                    </a>
                </div> --}}
            </form>
            <div class="text-center text-muted mt-3">
            Don't have account yet? <a href="{{ route('register') }}" tabindex="-1">Sign up</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
        <!-- Photo -->
        <div class="bg-cover h-100 min-vh-100" style="background-image: url({{ asset('storage/pemakaman/pemakaman.jpg') }})"></div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.show_password').click(function() {
                if($('#password').attr('type') == 'password') {
                    $('.eyes_not_show').addClass('d-none');
                    $('.eyes_show').removeClass('d-none');
                    $('#password').attr('type', 'text');
                } else {
                    $('.eyes_show').addClass('d-none');
                    $('.eyes_not_show').removeClass('d-none');
                    $('#password').attr('type', 'password');
                }
            });
        });
    </script>
@endpush
