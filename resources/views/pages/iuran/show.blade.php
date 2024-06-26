@extends('layouts.template')

@section('title', 'Detail Iuran')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">Iuran</div>
          <h2 class="page-title">Detail Data Iuran</h2>
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
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form>
                                <div class="mb-3">
                                    <label for="jenazah_id">Nama Jenazah</label>
                                    <input type="text" name="jenazah_id" id="jenazah_id" value="{{ $iuran->jenazah->nama_jenazah }}" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_iuran">Nama Iuran</label>
                                    <input type="text" name="nama_iuran" id="nama_iuran" value="{{ $iuran->nama_iuran }}" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nominal_iuran">Nominal</label>
                                    <input type="text" name="nominal_iuran" id="nominal_iuran" value="{{ $iuran->nominal_iuran }}" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="date_created">Tanggal Dibuat</label>
                                    <input type="text" name="date_created" id="date_created" value="{{ $iuran->date_created }}" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="status_bayar">Status</label>
                                    <input type="text" name="status_bayar" id="status_bayar" value="{{ $iuran->status_bayar }}" class="form-control" readonly>
                                </div>
                                <a href="{{ route('iuran.index') }}" class="btn btn-dark">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if($iuran->status_bayar == 'belum lunas')
                <div class="col-md-4">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Pembayaran
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form id="pembayaranForm" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" value="{{ $iuran->id_iuran }}" name="iuran_id">

                                    <div class="mb-3">
                                    <label for="tgl_bayar">Tanggal Pembayaran</label>
                                    <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control">
                                    <span class="invalid-feedback" id="tglBayarError"></span>
                                    </div>

                                    <div class="mb-3">
                                    <label for="metode_bayar">Metode Pembayaran</label>
                                    <select name="metode_bayar" id="metode_bayar" class="form-select">
                                        <option value="" hidden>--Pilih--</option>
                                        <option value="1">Tunai</option>
                                        <option value="2">Transfer Bank</option>
                                    </select>
                                    <span class="invalid-feedback" id="metodeBayarError"></span>
                                    </div>

                                    <div class="mb-3">
                                    <label for="bukti_bayar">Lampiran Bukti Bayar</label>
                                    <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control" accept=".png,.jpeg,.jpg">
                                    <small>Ekstensi yang diperbolehkan: .PNG,.JPG,.JPEG. Max:500KB</small>
                                    <span class="invalid-feedback" id="buktiBayarError"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
  </div>
@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pembayaranForm').on('submit', function(e) {
            e.preventDefault();

            // Clear previous errors and remove is-invalid class
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('pembayaran.store') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
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
                        if(errors.tgl_bayar){
                            $('#tgl_bayar').addClass('is-invalid');
                            $('#tglBayarError').text(errors.tgl_bayar[0]);
                        }

                        if(errors.metode_bayar) {
                            $('#metode_bayar').addClass('is-invalid');
                            $('#metodeBayarError').text(errors.metode_bayar[0]);
                        }
                        if(errors.bukti_bayar) {
                            $('#bukti_bayar').addClass('is-invalid');
                            $('#buktiBayarError').text(errors.bukti_bayar[0]);
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