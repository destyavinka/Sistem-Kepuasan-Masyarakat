@extends('admin.layouts.dashboard')

@section('content')
    <!-- Page Heading -->
    <!--<div class="d-sm-flex align-items-center justify-content-between mb-4">
                                                                                        <h1 class="h3 mb-0 text-gray-800">Home </h1>
                                                                                    </div>-->
    <!-- Page Heading -->
    <div class="col-md9 col-sm9 col-xs-12">
        <div class="card">
            <div class="card-header">
                <strong>INDEKS KEPUASAN MASYARAKAT</strong>
            </div>
            <div class="card-body">
                <center>
                    <div id="container" style="width: 90%; text-align: center" align="center">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class></div>
                            </div>
                            <h4>Statistik Indeks Kepuasan Masyarakat Polres Karanganyar
                                {{-- <p><a class="btn btn-info btn-sm" href="/panel/dashboard/cetak">Cetak</a> --}}
                                <p>
                            </h4>
                            <div class="my-2">
                                <form action="/panel/dashboard/statistik?mod=minggu" method="GET">
                                    <div class="row justify-content-center">
                                        <div class="input-group mb-3 col-6">
                                            <input type="date" class="form-control" name="start_date">
                                            <input type="date" class="form-control" name="end_date">
                                            <button class="btn btn-primary" type="submit">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div style="position: relative;"
                                class="{{ app('request')->input('sub') ? 'd-block' : 'd-none' }}">
                                <canvas id="myChart" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                </center>
            </div class="table-responsive">
            <div class="{{ app('request')->input('sub') ? 'd-block' : 'd-none' }}">
                <table align="center" cellpadding="0" cellspacing="0" class="table" border="0">
                    <tbody>
                        <tr bgcolor="#CCC">
                            <td align="center" width="50" height="25">
                                <strong>No.</strong>
                            </td>
                            <td align="center" width="200">
                                <strong>Tanggal</strong>
                            </td>
                            <td align="center" width="200">
                                <strong>Sangat Puas</strong>
                            </td>
                            <td align="center" width="150">
                                <strong>Puas</strong>
                            </td>
                            <td align="center" width="150">
                                <strong>Tidak Puas</strong>
                            </td>
                            <td align="center" width="200">
                                <strong>Jumlah</strong>
                            </td>
                        </tr>
                        <tr bgcolor="#ffffff">
                            <td align="center" height="25">1</td>
                            <td align="center">
                                <a href="/panel/dashboard/statistik?mod=hari&h=8&b=6&t=2022">
                                    <strong>08 Juni 2022</strong>
                                </a>
                            </td>
                            <td align="center">0</td>
                            <td align="center">0</td>
                            <td align="center">0</td>
                            <td align="center">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <script>
        let labels = [];

        for (let i = 1; i <= 14; i++) {
            labels.push(String(i));
        }

        const data = {
            labels: labels,
            datasets: [{
                    label: 'Sangat Puas',
                    data: [2, 0, 0, 0, 4, 0, 0],
                    fill: false,
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.4,
                },
                {
                    label: 'Puas',
                    data: [3, 0, 0, 0, 0, 0, 0],
                    fill: false,
                    borderColor: 'rgb(255, 205, 86)',
                    tension: 0.4,
                },
                {
                    label: 'Tidak Puas',
                    data: [0, 0, 0, 0, 0, 1, 0],
                    fill: false,
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.4,
                }
            ]
        };

        const config = {
            type: 'line',
            data: data,
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endsection
