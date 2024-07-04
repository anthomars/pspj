@extends('layouts.template')
@section('title', 'Laporan')
@section('content')

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Laporan</div>
                <h2 class="page-title">Iuran Bulanan</h2>
            </div>
        </div>
    </div>
</div>

<!-- Filter -->
<div class="container-xl mt-3">
    <div class="card">
        <div class="card-body">
            <form id="filterForm" action="{{ route('laporan.iuran_bulanan') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="filter_rw" class="form-label">Filter by RW:</label>
                        <select class="form-select" id="filter_rw" name="rw">
                            <option value="">All</option>
                            @foreach ($data['RW'] as $rw)
                                <option value="{{ $rw->no_rw }}" {{ request()->input('rw') == $rw->no_rw ? 'selected' : '' }}>RW {{ $rw->no_rw }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="filter_year" class="form-label">Filter by Year:</label>
                        <select class="form-select" id="filter_year" name="year">
                            <option value="">All</option>
                            @foreach ($data['iuran']->unique('date_created') as $iuran)
                                <option value="{{ \Carbon\Carbon::parse($iuran->date_created)->format('Y') }}" {{ request()->input('year') == \Carbon\Carbon::parse($iuran->date_created)->format('Y') ? 'selected' : '' }}>{{ \Carbon\Carbon::parse($iuran->date_created)->format('Y') }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice p-3 mb-3">

                            @foreach ($data['iuranPerRw'] as $rw => $tahunData)
                                <div class="card row mt-2 mb-2">
                                    {{-- Display RW and Year --}}
                                    @foreach ($tahunData as $tahun => $laporan)
                                        <div class="d-flex justify-content-between">
                                            <p class="h3 mt-2">RW. {{ $rw }}</p>
                                            <p class="h4 mt-2">{{ $tahun }}</p>
                                        </div>
                                        <div class="col-12 table-responsive mb-3">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>RT</th>
                                                        @foreach (['January', 'February', 'March', 'April', 'May', 'June',
                                                        'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                            <th>{{ substr($month, 0, 3) }}</th>
                                                        @endforeach
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        // Initialize array to store RT totals per month
                                                        $rt_monthly_totals = [];

                                                        // Loop through each contribution
                                                        foreach ($laporan as $item) {
                                                            $rt = $item->user->rt->no_rt;
                                                            $month = Carbon\Carbon::parse($item->date_created)->format('F');
                                                            $year = Carbon\Carbon::parse($item->date_created)->format('Y');

                                                            // Initialize RT total for the current month if not exists
                                                            if (!isset($rt_monthly_totals[$rt][$year][$month])) {
                                                                $rt_monthly_totals[$rt][$year][$month] = 0;
                                                            }

                                                            // Add contribution amount to RT total for the current month
                                                            $rt_monthly_totals[$rt][$year][$month] += $item->nominal_iuran;
                                                        }
                                                    @endphp

                                                    @foreach ($rt_monthly_totals as $rt => $yearData)
                                                        <tr>
                                                            <td>{{ $rt }}</td>
                                                            @php
                                                                $total_rt = 0;
                                                            @endphp
                                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June',
                                                            'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                                <td>
                                                                    @if (isset($yearData[date('Y')][$month]))
                                                                        {{ number_format($yearData[date('Y')][$month], 0, ',', '.') }}
                                                                        @php
                                                                            $total_rt += $yearData[date('Y')][$month];
                                                                        @endphp
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                            <td>{{ number_format($total_rt, 0, ',', '.') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    // JavaScript to automatically submit form on filter change
    $(document).ready(function() {
        $('#filter_rw, #filter_year').change(function() {
            $('#filterForm').submit();
        });
    });
</script>
@endpush
