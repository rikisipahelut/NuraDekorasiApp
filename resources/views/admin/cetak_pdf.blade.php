<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Transaksi</title>
    <link rel="stylesheet" href="/asset/css/bootstrap.min.css">
    <style type="text/css">
        body {
            font-size: 8pt;
        }

        th,td {
            padding: 5px;
        }
    </style>
    <link href="/asset/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="/asset/css/dataTables.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
        <div class="container-fuild">        
            <div class="row">
                <div class="col">
                <h3 class="p-2 text-center"><a href="#"><i class="fas fa-print" onclick="window.print()"></i></a> LAPORAN TRANSAKSI {{$bulan}}</h3>
                                   
                        <table border="1px solid black" cellspacing="0" rowspacing="0" class="m-auto">
                            <!-- <thead> -->
                                <tr>
                                    <th>Id_transaksi</th>
                                    <th>Tgl_transaksi</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No_telp</th>
                                    <th>Tgl_pemasangan</th>
                                    <th>Tgl_selesai</th>
                                    <th>Grand Total</th>
                                    <th>Bayar</th>
                                    <th>Utang</th>
                                    <th>Status</th>
                                </tr>
                            <!-- </thead> -->
                            <?php $total=0;?>
                            <tbody>
                                @foreach($tb_transaksi as $transaksi)
                                    <tr>
                                        <td>{{$transaksi->id_transaksi}}</td>
                                        <td>{{$transaksi->tgl_transaksi}}</td>
                                        <td>{{$transaksi->nama_pelanggan}}</td>
                                        <td>{{$transaksi->alamat}}</td>
                                        <td>{{$transaksi->no_telp}}</td>
                                        <td>{{$transaksi->tgl_pemasangan}}</td>
                                        <td>{{$transaksi->tgl_selesai}}</td>
                                        <td>{{$transaksi->grand_total}}</td>
                                        <td>{{$transaksi->bayar}}</td>
                                        <td>{{$transaksi->sisa_pembayaran}}</td>
                                        <td>{{$transaksi->status}}</td>
                                    </tr>
                                    <?php $total+=$transaksi->grand_total;?>

                                @endforeach
                                    <tr>
                                        <td colspan=7>Total</td>
                                        <td class="bg-warning" colspan=4>{{$total}}</td>
                                        <!-- <td colspan=3></td> -->
                                    </tr>
                            </tbody>                           
                        
                        </table>
                        <hr>
                        <div class="col-xl-8 m-auto">
                                <div class="card mb-4">
                                    <div class="card-header text-bold">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Bar chart jumlah pendapatan perbulan dalam tahun {{date('Y')}}
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                        </div>                        
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/asset/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="/asset/js/chart-area-demo.js"></script>
        <!-- <script src="/asset/js/chart-bar-demo.js"></script> -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="/asset/js/datatables-demo.js"></script>
        <script>
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChart");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober","November","Desember"],
                            datasets: [{
                            label: "Total",
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc','#4e73df', '#1cc88a', '#36b9cc','#4e73df', '#1cc88a', '#36b9cc','#4e73df', '#1cc88a', '#36b9cc'],
                            hoverBackgroundColor: "#F44336",
                            borderColor: "#4e73df",
                            data: [{{$jan}},{{$feb}},{{$mar}},{{$apr}},{{$mei}},{{$jun}},{{$jul}},{{$agu}},{{$sep}},{{$okt}},{{$nov}},{{$des}}],
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 12
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 100000000,
                                maxTicksLimit: 20
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });

        </script>
</body>
</html>