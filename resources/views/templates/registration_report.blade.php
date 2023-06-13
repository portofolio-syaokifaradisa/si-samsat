<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link href="{{ asset('vendor/enno/css/bootstrap.min.css') }}" rel="stylesheet">
    </head>
    <body class="text-center">
        <table style="width: 80%;" class="mx-5 mt-3">
            <tr>
                <th style="width: 10%;">
                    <img src="{{ asset('img/logo/logo.png') }}" alt="" width="70" height="100">
                </th>
                <th style="width: auto; " class="text-center">
                    <h6>PEMERINTAHAN PROVINSI KALIMANTAN SELATAN</h6>
                    <h6>BADAN KEUANGAN DAERAH</h6>
                    <h6>UNIT PELAYANAN PENDAPATAN DAERAH</h6>
                    <h6>(UPPD) KANDANGAN</h6>
                </th>
            </tr>
        </table>
        <hr>
        <h6 class="text-center my-4">Bukti Pengajuan {{ $orderName }}</h6>
        <table class="table">
            <tr>
                <td style="width: 5%;">1.</td>
                <td style="width: 25%;">Nomor Pengajuan</td>
                <td style="width: 2%;">:</td>
                <td style="width: auto;">{{ $order->order_number }}</td>
            </tr>
            <tr>
                <td style="width: 5%;">2.</td>
                <td style="width: 25%;">Nama Lengkap</td>
                <td style="width: 2%;">:</td>
                <td style="width: auto;">{{ $order->user->name }}</td>
            </tr>
            <tr>
                <td style="width: 5%;">3.</td>
                <td style="width: 25%;">Email</td>
                <td style="width: 2%;">:</td>
                <td style="width: auto;">{{ $order->user->email }}</td>
            </tr>
            <tr>
                <td style="width: 5%;">4.</td>
                <td style="width: 25%;">Tanggal Pengajuan</td>
                <td style="width: 2%;">:</td>
                <td style="width: auto;">{{ date('d-m-Y H:m', strtotime($order->created_at)) }} WITA</td>
            </tr>
            <tr>
                <td style="width: 5%;">5.</td>
                <td style="width: 25%;">Batas Waktu</td>
                <td style="width: 2%;">:</td>
                <td style="width: auto;">{{ date('d-m-Y', strtotime($order->time_limit)) }}</td>
            </tr>
            <tr>
                <td style="width: 5%;">6.</td>
                <td style="width: 25%;">Tarif</td>
                <td style="width: 2%;">:</td>
                <td style="width: auto;">
                    {{ $order->price }}
                </td>
            </tr>
        </table>
        <hr>
        <div class="text-center mt-5">
            <small>Mohon tunjukkan bukti pengajuan ini kepada petugas sebagai syarat untuk melakukan cek fisik kendaraan dan pengambilan {{ $orderName }} sebelum tanggal yang ditentukan.<br>
            <b class="mt-1">Terimakasih</b></small>
        </div>
        <br>
        <br>
        <table style="width: 100%" class="ttd">
            <tr>
                <td style="width: 60%">

                </td>
                <td style="width: auto" class="text-center">
                    <p style="font-size: 10pt; font-weight: 700">Plt. Kepala UPPD SAMSAT Kandangan</p>
                    <br>
                    <br>
                    <p style="font-size: 10pt">
                        <span style="font-weight: 700">
                            R. M. ERNATO SURYA JAYA, SP, M.AP    
                        </span> <br>
                        NIP. 18691009 199803 1 009
                    </p>
                </td>
            </tr>
        </table>
    </body>
</html>