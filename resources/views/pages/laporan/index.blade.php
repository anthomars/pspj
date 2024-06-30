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

                            <div class="row mt-2">
                                {{-- @php

                                @endphp --}}
                                @foreach ($data['iuranPerRw'] as $rw => $laporan)
                                    <p class="h3 mt-4">{{ $rw }}</p>
                                    <div class="col-12 table-responsive">
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
                                                {{-- @php

                                                @endphp --}}
                                                @foreach ($laporan as $item)
                                                    @php
                                                        print_r($item->nominal_iuran->groupByMonth);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $item->user->rt->no_rt }} </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                {{-- <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><storng>TOTAL Kotor </storng></td><td><strong>Rp. {{ number_format($subTotalPriceProduct) }}</strong></td></tr>
                                                <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><storng>TOTAL Discount </storng></td><td><strong>Rp. {{ number_format($subTotalDiscountProduct) }}</strong></td></tr> --}}
                                                <tr><td></td><td></td><td></td><td></td><td></td><td></td><td><storng>TOTAL</storng></td><td><strong>Rp.s</strong></td></tr>
                                                {{-- @php

                                                @endphp --}}
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
