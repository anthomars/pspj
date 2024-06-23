@extends('layouts.template')
@section('title', 'Edit Jenazah')
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Jenazah</div>
                <h2 class="page-title">Edit Jenazah</h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <form action="{{ url('jenazah/' . $jenazah[0]->id_jenazah) }}" method="POST" onsubmit="splashLoading()" enctype= "multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Nama Jenazah</label>
                                <input type="text" id="nama_jenazah" name="nama_jenazah" class="form-control @error('nama_jenazah') is-invalid @enderror" placeholder="Title" value="{{ old('nama_jenazah', $jenazah[0]->nama_jenazah) }}"/>
                                @error('nama_jenazah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="input-icon mb-2">
                                    <input class="form-control" placeholder="Select a date" id="tgl_lahir" name="tgl_lahir" value="{{ $jenazah ? date('Y-m-d',strtotime($jenazah[0]->tgl_lahir)) : date('Y-m-d') }}">
                                    <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h16"></path><path d="M11 15h1"></path><path d="M12 15v3"></path></svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Wafat</label>
                                <div class="input-icon mb-2">
                                    <input class="form-control" placeholder="Select a date" id="tgl_wafat" name="tgl_wafat" value="{{ $jenazah ? date('Y-m-d',strtotime($jenazah[0]->tgl_wafat)) : date('Y-m-d') }}">
                                    <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h16"></path><path d="M11 15h1"></path><path d="M12 15v3"></path></svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Title" value="{{ old('tempat_lahir', $jenazah[0]->tempat_lahir) }}"/>
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tempat Wafat</label>
                                <input type="text" id="tempat_wafat" name="tempat_wafat" class="form-control @error('tempat_wafat') is-invalid @enderror" placeholder="Title" value="{{ old('tempat_wafat', $jenazah[0]->tempat_wafat) }}"/>
                                @error('tempat_wafat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Title" value="{{ old('nik', $jenazah[0]->nik) }}"/>
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Keluarga</label>
                                <input type="text" id="keluarga" name="keluarga" class="form-control @error('keluarga') is-invalid @enderror" placeholder="Title" value="{{ old('keluarga', $jenazah[0]->keluarga) }}"/>
                                @error('keluarga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea id="alamat" name="alamat" data-bs-toggle="autosize" class="form-control @error('alamat') is-invalid @enderror" placeholder="Address">{{ $jenazah ? $jenazah[0]->alamat : old('alamat')  }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent mt-auto d-flex justify-content-between">
                    <a href="{{ url('/admin/website-setting/pages') }}" class="btn" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M15 6l-6 6l6 6"></path>
                        </svg>
                        back
                    </a>
                    <div class="btn-list justify-content-end">
                      <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                      <button type="submit" id="submit-loading" class="btn btn-primary" style="display: none" disabled>
                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>Loading
                      </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="overlay_submit_loading"></div>
<div class="spanner_submit_loading">
  <div class="loading_circle_submit_loading">
    <div class="spinner-grow text-blue" style="width: 3rem; height: 3rem;" role="status"><span class="visually-hidden">Loading...</span></div>
  </div>
</div>
@endsection
@push('css')
    <link href="{{ asset('dist/css/custom-loading.css') }}" rel="stylesheet"/>
@endpush
@push('js')
    <script src="{{ asset('templates/tabler/dist/libs/tom-select/dist/js/tom-select.base.min.js?1692305289') }}" defer></script>
    <script src="{{ asset('templates/tabler/dist/libs/litepicker/dist/litepicker.js?1692870762') }}" defer></script>
    <script type="text/javascript">
        function splashLoading(){
            document.getElementById('submit').style.display = 'none';
            document.getElementById('submit-loading').style.display = 'block';

            $('.overlay_submit_loading').addClass('show_loading');
            $('.spanner_submit_loading').addClass('show_loading');
        }
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {
            var el;

            // Get a date object for the current time
            let afterDay = new Date();

            // Set it to one month ago
            afterDay.setDate(afterDay.getDate());

            window.Litepicker && (new Litepicker({
                element: document.getElementById('tgl_lahir'),
                singleMode: true,
                numberOfMonths: 1,
                numberOfColumns: 1,
                maxDate: afterDay,
                resetButton: true,
                buttonText: {
                    reset: `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>`,
                    previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                    nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                },
            }));
        });
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {
            var el;

            // Get a date object for the current time
            let afterDay = new Date();

            // Set it to one month ago
            afterDay.setDate(afterDay.getDate());

            window.Litepicker && (new Litepicker({
                element: document.getElementById('tgl_wafat'),
                singleMode: true,
                numberOfMonths: 1,
                numberOfColumns: 1,
                maxDate: afterDay,
                resetButton: true,
                buttonText: {
                    reset: `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>`,
                    previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                    nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                },
            }));
        });
    </script>
@endpush
