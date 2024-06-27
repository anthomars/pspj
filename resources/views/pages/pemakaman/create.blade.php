@extends('layouts.template')

@section('title', 'Pemakaman')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">Pemakaman</div>
          <h2 class="page-title">Tambah Data Pemakaman</h2>
        </div>
        <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                @if(Auth::user()->role_id != 5)
  
                <a href="{{ route('makam.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                    <i class="fa-solid fa-list"></i>
                  List Data
              </a>
              @endif
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
                    <form id="makamForm" >
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="blok_pemakaman_id">Blok Pemakaman</label>
                                <select name="blok_pemakaman_id" id="blok_pemakaman_id" class="form-select">
                                    <option value="" hidden>--Pilih--</option>
                                    @foreach ($blok as $blk)
                                        <option value="{{ $blk->id_blok_pemakaman }}">{{ $blk->nama_blok_pemakaman }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" id="blokError"></span>
                            </div>

                            <div class="mb-3">
                                <label for="status_pemakaman">Status Pemakaman</label>
                                <select name="status_pemakaman" id="status_pemakaman" class="form-select">
                                    <option value="" hidden>--Pilih--</option>
                                    <option value="belum dimakamkan">Belum Dimakamkan</option>
                                    <option value="sudah dimakamkan">Sudah Dimakamkan</option>
                                </select>
                                <span class="invalid-feedback" id="statusError"></span>
                            </div>
                            
                            <div class="mb-3">
                                <label for="tgl_pemakaman">Tanggal Pemakaman</label>
                                <input type="date" class="form-control" name="tgl_pemakaman" id="tgl_pemakaman">
                                <span class="invalid-feedback" id="tglError"></span>
                            </div>

                            <div class="mb-3">
                                <label for="jam_pemakaman">Jam Pemakaman</label>
                                <input type="time" class="form-control" name="jam_pemakaman" id="jam_pemakaman" value="10:00" >
                                <span class="invalid-feedback" id="jamError"></span>
                            </div>

                            <div class="mb-3">
                                <label for="nama_biaya">Jenis Biaya</label>
                                <input type="text" class="form-control" name="nama_biaya" id="nama_biaya"  placeholder="Masukan Jenis Biaya">
                                <span class="invalid-feedback" id="namaError"></span>
                            </div>

                            <div class="mb-3">
                                <label for="nominal_biaya">Nominal Biaya</label>
                                <input type="text" class="form-control" name="nominal_biaya" id="nominal_biaya"  placeholder="Masukan Nominal Biaya">
                                <span class="invalid-feedback" id="nominalError"></span>
                                <small>Isikan dalam format rupiah</small>
                            </div>

                            <div class="mb-3">
                                <label for="status_bayar">Status Bayar</label>
                                <select name="status_bayar" id="status_bayar" class="form-select">
                                    <option value="" hidden>--Pilih--</option>
                                    <option value="belum lunas">Belum Lunas</option>
                                    <option value="lunas">Lunas</option>
                                </select>
                                <span class="invalid-feedback" id="statusBayarError"></span>
                            </div>
                            
                        </div>
                        <div id="result" class="mt-3"></div>
                        <div class="card-footer">
                            <a href="{{ route('makam.index') }}" class="btn btn-dark">Batal</a>
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
        $('#makamForm').on('submit', function(e) {
            e.preventDefault();

            // Clear previous errors and remove is-invalid class
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            var formData = new FormData(this);
            
            $.ajax({
                url: "{{ route('makam.store') }}",
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
                        if(errors.blok_pemakaman_id){
                            $('#blok_pemakaman_id').addClass('is-invalid');
                            $('#blokError').text(errors.blok_pemakaman_id[0]);
                        }
                        if(errors.status_pemakaman){
                            $('#status_pemakaman').addClass('is-invalid');
                            $('#statusError').text(errors.status_pemakaman[0]);
                        }

                        if(errors.tgl_pemakaman) {
                            $('#tgl_pemakaman').addClass('is-invalid');
                            $('#tglError').text(errors.tgl_pemakaman[0]);
                        }
                        if(errors.jam_pemakaman) {
                            $('#jam_pemakaman').addClass('is-invalid');
                            $('#jamError').text(errors.jam_pemakaman[0]);
                        }

                        if(errors.nama_biaya) {
                            $('#nama_biaya').addClass('is-invalid');
                            $('#namaError').text(errors.nama_biaya[0]);
                        }

                        if(errors.nominal_biaya) {
                            $('#nominal_biaya').addClass('is-invalid');
                            $('#nominalError').text(errors.nominal_biaya[0]);
                        }

                        if(errors.status_bayar) {
                            $('#status_bayar').addClass('is-invalid');
                            $('#statusBayarError').text(errors.status_bayar[0]);
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