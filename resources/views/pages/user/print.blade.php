@extends('layouts.template-print')

@section('title', 'Print Pengguna')

@section('content')
    <h1 class="text-center mt-5 mb-5">DATA PENGGUNA PSPJ</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pengguna</th>
                <th scope="col">No. HP</th>
                <th scope="col">Role</th>
                <th scope="col">RT</th>
                <th scope="col">RW</th>
                <th scope="col">Date Created</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 0;
            @endphp
            @foreach ($data['user'] as $item)
                @php
                    $no++;
                    // Assuming these functions are defined and accessible
                    $dataUser = userData($item->id);
                    $fullName = explodeFullname($dataUser['nama_lengkap']);
                @endphp
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>
                        <div class="d-flex py-1 align-items-center">
                            @if ($item->image)
                                <span class="avatar me-2" style="background-image: url('{{ asset('storage/' . $dataUser['image']) }}')"></span>
                            @else
                                <span class="avatar me-2">{{ $fullName }}</span>
                            @endif
                            <div class="flex-fill">
                                <div class="font-weight-medium">{{ $dataUser['nama_lengkap'] }}</div>
                                <div class="text-muted"><a href="{{ url("user/profile") }}" class="text-reset">{{ $dataUser['email'] }}</a></div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $item->no_hp }}</td>
                    <td><span class="badge bg-blue-lt">{{ $item->role->nama_role }}</span></td>
                    <td>{{ $item->rt->no_rt }}</td>
                    <td>{{ $item->rw->no_rw }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->date_created)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
