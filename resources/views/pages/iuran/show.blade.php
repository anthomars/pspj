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
            <div class="col-md-4">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          Pembayaran
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
  </div>
@endsection