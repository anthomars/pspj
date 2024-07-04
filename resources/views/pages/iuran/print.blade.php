@extends('layouts.template-print')

@section('title', 'Print Data Iuran')

@section('content')
    <h1 class="text-center mt-5 mb-5">DATA Mayit PSPJ</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Keluarga</th>
                <th scope="col">Nama Jenazah</th>
                <th scope="col">Jenis Iuran</th>
                <th scope="col">Nominal</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 0;
            @endphp
            @foreach ($data['iuran'] as $item)
                @php
                    $no++;
                @endphp
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>{{ $item->user->nama_lengkap }}</td>
                    <td>{{ $item->jenazah->nama_jenazah }}</td>
                    <td>{{ $item->nama_iuran }}</td>
                    <td>Rp. {{ number_format($item->nominal_iuran) }}</td>
                    <td class="text-capitalize"><strong>{{ $item->status_bayar }}</strong></td>
                    <td>{{ date('d-m-Y', strtotime($item->date_created)) }}</td>
            @endforeach
        </tbody>
    </table>
@endsection
