@extends('layouts.template')

@section('title', 'Tambah Iuran')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">Iuran</div>
          <h2 class="page-title">Tambah Data Iuran</h2>
        </div>
        <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
              <a href="{{ route('iuran.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <i class="fa-solid fa-list"></i>
                  List Iuran
              </a>
              </div>
          </div>
      </div>
    </div>
  </div>

  <div class="page-body">
    <div class="container-xl">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card p-3">
                    <form id="iuranForm" >
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="jenazah_id">Jenazah</label>
                                <select name="jenazah_id" id="jenazah_id" class="form-select">
                                    <option value="" hidden>--Pilih--</option>
                                    @foreach ($dataJenazah as $jenazah)
                                        <option value="{{ $jenazah->id_jenazah }}">{{ $jenazah->nama_jenazah }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" id="jenazahError"></span>
                            </div>
                            <div class="mb-3">
                                <label for="nama_iuran">Nama Iuran</label>
                                <input type="text" class="form-control" name="nama_iuran" id="nama_iuran" placeholder="Masukan Nama Iuran">
                                <span class="invalid-feedback" id="namaIuranError"></span>
                            </div>
                            <div class="mb-3">
                                <label for="nominal_iuran">Nominal</label>
                                <input type="text" class="form-control" name="nominal_iuran" id="nominal_iuran" placeholder="Masukan Nominal Iuran">
                                <span class="invalid-feedback" id="nominalIuranError"></span>
                            </div>
                        </div>
                        <div id="result" class="mt-3"></div>
                        <div class="card-footer">
                            <a href="{{ route('iuran.index') }}" class="btn btn-dark">Batal</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#iuranForm').on('submit', function(e) {
            e.preventDefault();

            // Clear previous errors and remove is-invalid class
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            var formData = new FormData(this);
            
            $.ajax({
                url: "{{ route('iuran.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                            },
                            willClose: () => {
                                window.location.href = response.redirect_url;
                            }
                        });
                    }

                },
                error: function(response) {
                    if(response.status === 400) {
                        var errors = response.responseJSON.errors;
                        if(errors.jenazah_id){
                            $('#jenazah_id').addClass('is-invalid');
                            $('#jenazahError').text(errors.jenazah_id[0]);
                        }

                        if(errors.nama_iuran) {
                            $('#nama_iuran').addClass('is-invalid');
                            $('#namaIuranError').text(errors.nama_iuran[0]);
                        }
                        if(errors.nominal_iuran) {
                            $('#nominal_iuran').addClass('is-invalid');
                            $('#nominalIuranError').text(errors.nominal_iuran[0]);
                        }

                    } else {
                        $('#result').html('<div class="alert alert-danger">Terjadi kesalahan saat menyimpan data.</div>');
                    }
                }
            });
        });
    });
</script>
@endpush