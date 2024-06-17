<header class="navbar navbar-expand-md sticky-top d-none d-lg-flex d-print-none" >
    <div class="container-xl">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-nav flex-row order-md-last">
        <div class="d-none d-md-flex">
          <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
            data-bs-placement="bottom">
            <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
          </a>
          <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
            data-bs-placement="bottom">
            <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
          </a>
          <div class="nav-item dropdown d-none d-md-flex me-3" id="notification_section">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                    <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                    <span class="badge bg-red" id="dot_notification" style="display: none;"></span>
                </a>
            </div>
        </div>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            @php
                $user = Auth::user();
                $path = asset('storage/' . $user->image);
                $initialProfile = explodeFullname($user->nama_lengkap);
            @endphp
            @if ($user->photo)
                <span class="avatar avatar-sm" style="background-image: url('{{ $path }}')"></span>
            @else
                <span class="avatar avatar-sm">{{ $initialProfile }}</span>
            @endif
            <div class="d-none d-xl-block ps-2">
              <div>{{ $user->username }}</div>
              <div class="mt-1 small text-muted">{{ $user->nama_lengkap }}</div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="{{ url('user/profile') }}" class="dropdown-item">Profile</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
          </div>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navbar-menu">
        {{-- <div>
          <form action="./" method="get" autocomplete="off" novalidate>
            <div class="input-icon">
              <span class="input-icon-addon">
                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
              </span>
              <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website">
            </div>
          </form>
        </div> --}}
      </div>
    </div>
</header>

<div class="modal" id="modalNotifTop" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title-notif-top"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body-notif-top">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
@endpush

@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>

    <script>
        // function showPicture(e){
        //     let url = $(e).data('url')
        //     $(e).magnificPopup({
        //         items: {
        //             src: url
        //         },
        //         type: 'image',
        //         gallery: {
        //             enabled: true
        //         },
        //     }).magnificPopup('open');

        // }

    </script>
@endpush
