@extends('layouts.template-print')

@section('title', 'Print Data Mayitr')

@section('content')
    <h1 class="text-center mt-5 mb-5">DATA Mayit PSPJ</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Jenazah</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Tanggal Wafat</th>
                <th scope="col">Tempat Lahir</th>
                <th scope="col">Tempat Wafat</th>
                <th scope="col">NIK</th>
                <th scope="col">Alamat</th>
                <th scope="col">Keluarga</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 0;
            @endphp
            @foreach ($data['jenazah'] as $item)
                @php
                    $no++;
                @endphp
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>{{ $item->nama_jenazah }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tgl_lahir)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tgl_wafat)) }}</td>
                    <td>{{ $item->tempat_lahir }}</td>
                    <td>{{ $item->tempat_wafat }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->user->nama_lengkap }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
