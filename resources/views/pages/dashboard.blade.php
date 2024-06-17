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
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body text-center mt-5">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt" style="width: 60; height:60;" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2m4 -14h6m-6 4h6m-2 4h2" /></svg>
                        </div>
                        <div>
                            <h2>Total Request Orders</h2>
                            <h2>#</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
