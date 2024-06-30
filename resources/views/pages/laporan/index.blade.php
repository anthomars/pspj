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

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice p-3 mb-3">

                            @foreach ($data['iuranPerRw'] as $rw => $laporan)
                                <div class="card row mt-2 mb-2">
                                    <p class="h3 mt-2">RW. {{ $rw }}</p>
                                    <div class="col-12 table-responsive mb-3">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>RT</th>
                                                    <th>Jan</th>
                                                    <th>Feb</th>
                                                    <th>Maret</th>
                                                    <th>Apr</th>
                                                    <th>May</th>
                                                    <th>Jun</th>
                                                    <th>Jul</th>
                                                    <th>Aug</th>
                                                    <th>Sep</th>
                                                    <th>Oct</th>
                                                    <th>Nov</th>
                                                    <th>Dec</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $months = [
                                                        'January', 'February', 'March', 'April', 'May', 'June',
                                                        'July', 'August', 'September', 'October', 'November', 'December'
                                                    ];
                                                    $totals = array_fill_keys($months, 0);
                                                @endphp
                                                @foreach ($laporan as $item)
                                                    <tr>
                                                        <td>{{ $item->user->rt->no_rt }} </td>
                                                        @php
                                                            $total_rt = 0;
                                                        @endphp
                                                        @foreach ($months as $month)
                                                            @php
                                                                $formatted_month = \Carbon\Carbon::parse($item->date_created)->format('F');
                                                            @endphp
                                                            <td>
                                                                @if ($formatted_month == $month)
                                                                    {{ number_format($item->nominal_iuran, 0, ',', '.') }}
                                                                    @php
                                                                        $total_rt += $item->nominal_iuran;
                                                                        $totals[$month] += $item->nominal_iuran;
                                                                    @endphp
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                        <td>{{ number_format($total_rt, 0, ',', '.') }}</td>
                                                    </tr>
                                                @endforeach

                                                <tr>
                                                    <td><strong>Total</strong></td>
                                                    @foreach ($months as $month)
                                                        <td><strong>{{ number_format($totals[$month], 0, ',', '.') }}</strong></td>
                                                    @endforeach
                                                    <td><strong>{{ number_format(array_sum($totals), 0, ',', '.') }}</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
