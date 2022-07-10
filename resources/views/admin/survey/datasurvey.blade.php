@extends('admin.layouts.dashboard')

@section('content')
    <!-- Page Heading -->
    <!--<div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Home </h1>
                            </div>-->
    <!-- Page Heading -->

    <style>
        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 6px;
        }

        th {
            background-color: rgb(54, 106, 210);
            color: white;
        }

        body {
            font-size: small;
        }
    </style>
    </head>


    <div class="col-md9 col-sm9 col-xs-12">
        <div class="card">
            <div class="card-header">
                <strong>DATA SURVEY</strong>
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
                            <h4>Data Survey
                                <p><a class="btn btn-info btn-sm" href="/panel/dashboard/cetak">Cetak</a>
                                <p>
                            </h4>

                            <div class="d-flex justify-content-center">
                                <form action="/panel/dashboard/statistik" method="get" class="form-inline" align="center">
                                    <input type="hidden" name="mod" value="minggu">
                                    <input type="hidden" name="sub" value="filter">
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="date" name="t1" class="form-control form-control-sm"
                                            id="t1" placeholder="Dari Tanggal" value="">
                                    </div>
                                    <div class="form-group mb-2">
                                        s/d.
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="date" name="t2" class="form-control form-control-sm"
                                            id="t2" placeholder="Sampai Tanggal" value="">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm mb-2">Filter</button>
                                </form>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md9 col-sm9 col-xs-12 mb-2">
                                        <div class="card">
                                            <div class="card-header">
                                                <td colspan="1">1. Bagaimana pendapat saudara tentang kesesuaian
                                                    persyaratan pelayanan dengan jenis pelayanannya</td>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <canvas id="inicanvas"
                                            style="min-width: 200px; height: 190px; max-width: 275px; margin:auto"></canvas>
                                        <script>
                                            var ctx = document.getElementById("inicanvas").getContext("2d");
                                            // tampilan chart
                                            var piechart = new Chart(ctx, {
                                                type: 'pie',
                                                data: {
                                                    // label nama setiap Value
                                                    labels: [
                                                        'Tidak Sesuai',
                                                        'Kurang Sesuai',
                                                        'Sesuai',
                                                        'Sangat Sesuai',

                                                    ],

                                                    datasets: [{
                                                        // Jumlah Value yang ditampilkan
                                                        data: [60, 60, 60, 80],

                                                        backgroundColor: [
                                                            'rgb(169, 169, 169)',
                                                            'rgb(255, 99, 132)',
                                                            '#FF8C00',
                                                            '#FFD700',

                                                        ]
                                                    }],
                                                }
                                            });
                                        </script>
                                    </div>

                                    <div class="col-md-4 mt-3">

                                        <body>
                                            <table>
                                                <tr>
                                                    <th rowspan>Jml. Responden</th>
                                                    <th rowspan>Opsi</th>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left"> a. Tidak sesuai</td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left">b. Kurang sesuai</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left">c. Sesuai</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left">d. Sangat sesuai</td>
                                                </tr>

                                            </table>
                                        </body>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md9 col-sm9 col-xs-12 mb-2 mt-2">
                                        <div class="card">
                                            <div class="card-header">
                                                <td colspan="2">2. Bagaimana pemahaman saudara tentang kemudahan prosedur
                                                    pelayanan diunit ini</td>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <canvas id="inicanvas2"
                                            style="min-width: 200px; height: 190px; max-width: 275px; margin:auto"></canvas>
                                        <script>
                                            var ctx = document.getElementById("inicanvas2").getContext("2d");
                                            // tampilan chart
                                            var piechart = new Chart(ctx, {
                                                type: 'pie',
                                                data: {
                                                    // label nama setiap Value
                                                    labels: [
                                                        'Tidak Mudah',
                                                        'Kurang Mudah',
                                                        'Mudah',
                                                        'Sangat Mudah',

                                                    ],

                                                    datasets: [{
                                                        // Jumlah Value yang ditampilkan
                                                        data: [60, 60, 60, 80],

                                                        backgroundColor: [
                                                            'rgb(169, 169, 169)',
                                                            'rgb(255, 99, 132)',
                                                            '#FF8C00',
                                                            '#FFD700',

                                                        ]
                                                    }],
                                                }
                                            });
                                        </script>
                                    </div>

                                    <div class="col-md-4 mt-3">

                                        <body>
                                            <table>
                                                <tr>
                                                    <th rowspan>Jml. Responden</th>
                                                    <th rowspan>Opsi</th>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left"> a. Tidak mudah</td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left">b. Kurang mudah</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left">c. Mudah</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left">d. Sangat mudah</td>
                                                </tr>


                                            </table>
                                        </body>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="col-md9 col-sm9 col-xs-12 mb-2 mt-2">
                                        <div class="card">
                                            <div class="card-header">
                                                <td colspan="3">3. Bagaimana pendapat saudara tentang kecepatan waktu
                                                    dalam memberikan pelayanan</td>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <canvas id="inicanvas3"
                                            style="min-width: 200px; height: 190px; max-width: 275px; margin:auto"></canvas>
                                        <script>
                                            var ctx = document.getElementById("inicanvas3").getContext("2d");
                                            // tampilan chart
                                            var piechart = new Chart(ctx, {
                                                type: 'pie',
                                                data: {
                                                    // label nama setiap Value
                                                    labels: [
                                                        'Tidak Cepat',
                                                        'Kurang Cepat',
                                                        'Cepat',
                                                        'Sangat Cepat',

                                                    ],

                                                    datasets: [{
                                                        // Jumlah Value yang ditampilkan
                                                        data: [60, 60, 60, 80],

                                                        backgroundColor: [
                                                            'rgb(169, 169, 169)',
                                                            'rgb(255, 99, 132)',
                                                            '#FF8C00',
                                                            '#FFD700',

                                                        ]
                                                    }],
                                                }
                                            });
                                        </script>
                                    </div>

                                    <div class="col-md-4 mt-3">

                                        <body>
                                            <table>
                                                <tr>
                                                    <th rowspan>Jml. Responden</th>
                                                    <th rowspan>Opsi</th>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left"> a. Tidak cepat</td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left">b. Kurang cepat</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left">c. Cepat</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>0</center>
                                                    </td>
                                                    <td align="left">d. Sangat cepat</td>
                                                </tr>


                                            </table>
                                        </body>
                                    </div>
                                </div>
                            </div>


                            <br><br>
                            </body>

                            </html>
                        @endsection
