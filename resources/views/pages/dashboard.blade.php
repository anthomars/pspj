@extends('layouts.template')
@section('title', 'Dashboard')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
        <div class="col">
            <!-- Page pre-title -->
            <h2 class="page-title">Dashboard</h2>
        </div>
        </div>
    </div>
</div>

<section class="page-body">
    <div class="container-xl">
        @if (Auth::user()->role_id != 5)
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center mt-5">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt" style="width: 60; height:60;" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2m4 -14h6m-6 4h6m-2 4h2" /></svg>
                            </div>
                            <div>
                                <h2>Total Kematian Bulan Ini</h2>
                                <h2>{{ $data['kematian'] }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center mt-5">
                            <div>
                                <svg  xmlns="http://www.w3.org/2000/svg"  style="width: 60; height:60;"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circuit-ammeter"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M5 12h-3" /><path d="M19 12h3" /><path d="M10 14v-3c0 -1.036 .895 -2 2 -2s2 .964 2 2v3" /><path d="M14 12h-4" /></svg>
                            </div>
                            <div>
                                <h2>Blok Tersedia</h2>
                                @foreach ($data['blok'] as $item)
                                    @php
                                        $quota = number_format($item->kapasitas);
                                        $used = number_format(count($item->pemakaman));
                                        $left = $quota - $used ;

                                        $text = $left.' / '.$quota;
                                    @endphp
                                    <strong>{{ $item->nama_blok_pemakaman . ' : ' . $text}}</strong><br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center mt-5">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt" style="width: 60; height:60;" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2m4 -14h6m-6 4h6m-2 4h2" /></svg>
                            </div>
                            <div>
                                <h2>Jumlah Pengguna</h2>
                                <h2>{{ $data['user'] }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center mt-5">
                            <div>
                                <svg  xmlns="http://www.w3.org/2000/svg"  style="width: 60; height:60;" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" /></svg>
                            </div>
                            <div>
                                <h2>Iuran</h2>
                                <h2>Sudah Bayar</h2>
                                <h5>Bulan Ini</h5>
                                <h2>{{ $data['iuran_sudah_bayar'] }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center mt-5">
                            <div>
                                <svg  xmlns="http://www.w3.org/2000/svg"  style="width: 60; height:60;" viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cash-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 9h6a2 2 0 0 1 2 2v6m-2 2h-10a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2" /><path d="M12.582 12.59a2 2 0 0 0 2.83 2.826" /><path d="M17 9v-2a2 2 0 0 0 -2 -2h-6m-4 0a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" /><path d="M3 3l18 18" /></svg>
                            </div>
                            <div>
                                <h2>Iuran</h2>
                                <h2>Belum Bayar</h2>
                                <h5>Bulan Ini</h5>
                                <h2>{{ $data['iuran_belum_bayar'] }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center mt-5">
                            <div>
                                <svg  xmlns="http://www.w3.org/2000/svg"  style="width: 60; height:60;"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-cash-banknote"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 5a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-14a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3zm-7 4a3 3 0 0 0 -2.996 2.85l-.004 .15a3 3 0 1 0 3 -3m6.01 2h-.01a1 1 0 0 0 0 2h.01a1 1 0 0 0 0 -2m-12 0h-.01a1 1 0 1 0 .01 2a1 1 0 0 0 0 -2" /></svg>
                            </div>
                            <div>
                                <h2>Iuran</h2>
                                <h2>Menunggu Konfirmasi</h2>
                                <h5>Bulan Ini</h5>
                                <h2>{{ $data['iuran_tuggu_konfirmasi'] }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h1 class="text-center">Yth Bp./Ibu {{ Auth::user()->nama_lengkap }}, Selamat Datang Di Dashboard PSPJ</h1>
        @endif
    </div>
</section>


@endsection

@push('css')
@endpush

@push('js')
    <script src="{{ asset('templates/tabler/dist/libs/fslightbox/index.js?1685976846') }}" defer></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/libs/apexcharts/dist/apexcharts.min.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
          window.ApexCharts && (new ApexCharts(document.getElementById('roChart'), {
            chart: {
              type: "area",
              fontFamily: 'inherit',
              height: 240,
              parentHeightOffset: 0,
              toolbar: {
                show: false,
              },
              animations: {
                enabled: true
              },
            },
            dataLabels: {
              enabled: false,
            },
            fill: {
              opacity: .16,
              type: 'solid'
            },
            stroke: {
              width: 2,
              lineCap: "round",
              curve: "smooth",
            },
            series: [{
              name: "Successfull RequestOrders",
              data: [{{ count((isset($data['countROByMonthSuccess']['01'])) ? $data['countROByMonthSuccess']['01'] : []) }}, {{ count((isset($data['countROByMonthSuccess']['02'])) ? $data['countROByMonthSuccess']['02'] : []) }}, {{ count((isset($data['countROByMonthSuccess']['03'])) ? $data['countROByMonthSuccess']['03'] : []) }}, {{ count((isset($data['countROByMonthSuccess']['04'])) ? $data['countROByMonthSuccess']['04'] : []) }}, {{ count((isset($data['countROByMonthSuccess']['05'])) ? $data['countROByMonthSuccess']['05'] : []) }}, {{ count((isset($data['countROByMonthSuccess']['06'])) ? $data['countROByMonthSuccess']['06'] : []) }}, {{ count((isset($data['countROByMonthSuccess']['07'])) ? $data['countROByMonthSuccess']['07'] : []) }}, {{ count((isset($data['countROByMonthSuccess']['08'])) ? $data['countROByMonthSuccess']['08'] : []) }}, {{ count((isset($data['countROByMonthSuccess']['09'])) ? $data['countROByMonthSuccess']['09'] : []) }}, {{ count((isset($data['countROByMonthSuccess']['10'])) ? $data['countROByMonthSuccess']['10'] : []) }}, {{ count((isset($data['countROByMonthSuccess']['11'])) ? $data['countROByMonthSuccess']['11'] : []) }}, {{ count((isset($data['countROByMonthSuccess']['12'])) ? $data['countROByMonthSuccess']['12'] : []) }},]
            }, {
              name: "RequestOrders",
              data: [{{ count((isset($data['countROByMonth']['01'])) ? $data['countROByMonth']['01'] : []) }}, {{ count((isset($data['countROByMonth']['02'])) ? $data['countROByMonth']['02'] : []) }}, {{ count((isset($data['countROByMonth']['03'])) ? $data['countROByMonth']['03'] : []) }}, {{ count((isset($data['countROByMonth']['04'])) ? $data['countROByMonth']['04'] : []) }}, {{ count((isset($data['countROByMonth']['05'])) ? $data['countROByMonth']['05'] : []) }}, {{ count((isset($data['countROByMonth']['06'])) ? $data['countROByMonth']['06'] : []) }}, {{ count((isset($data['countROByMonth']['07'])) ? $data['countROByMonth']['07'] : []) }}, {{ count((isset($data['countROByMonth']['08'])) ? $data['countROByMonth']['08'] : []) }}, {{ count((isset($data['countROByMonth']['09'])) ? $data['countROByMonth']['09'] : []) }}, {{ count((isset($data['countROByMonth']['10'])) ? $data['countROByMonth']['10'] : []) }}, {{ count((isset($data['countROByMonth']['11'])) ? $data['countROByMonth']['11'] : []) }}, {{ count((isset($data['countROByMonth']['12'])) ? $data['countROByMonth']['12'] : []) }},]
            }],
            tooltip: {
              theme: 'dark'
            },
            grid: {
              padding: {
                top: -20,
                right: 0,
                left: -4,
                bottom: -4
              },
              strokeDashArray: 4,
            },
            xaxis: {
              labels: {
                padding: 0,
              },
              tooltip: {
                enabled: false
              },
              axisBorder: {
                show: false,
              },
              type: 'month',
            },
            yaxis: {
              labels: {
                padding: 4,
                formatter: function(val) {
                        return Math.floor(val)
                    }
              },
              min: 0,
              decimalsInFloat: 0,
            },
            labels: [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" , "Aug", "Sep", "Oct", "Nov", "Dec"
            ],
            colors: [tabler.getColor("primary"), tabler.getColor("purple")],
            legend: {
              show: true,
              position: 'bottom',
              offsetY: 12,
              markers: {
                width: 10,
                height: 10,
                radius: 100,
              },
              itemMargin: {
                horizontal: 8,
                vertical: 8
              },
            },
          })).render();
        });
      </script>

        {{-- Slider --}}
        <script>
            const swiper = new Swiper('.swiper', {
                slidesPerView: 3,
                spaceBetween: 30,
                mousewheel: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                scroll:{
                    sensitivity:1,
                }
            });
        </script>

        <script>
            function readMore(e){
                let uuid = $(e).data('id');

                let title = $(e).data('title');
                let message = $(e).data('message');
                let img = $(e).data('img');
                let url = $(e).data('url');

                let imgSection = '';
                if(img){
                    imgSection = `<img src="${img}" class="h-50 w-50 mb-3 d-block mx-auto" />`;
                }

                let urlSection = '';
                if(url){
                    urlSection = `<p style="color:blue; cursor: pointer;" onClick="visitUrl({uuid:'${uuid}',url:'${url}'})" >Link Direct</p>`;
                }

                $('#modal-title-notif').text(title);
                $('#modal-body-notif').html(`${imgSection}<p>${message}</p>${urlSection}`);
                $('#modalNotifDashboard').modal('show');

            }
        </script>
@endpush
