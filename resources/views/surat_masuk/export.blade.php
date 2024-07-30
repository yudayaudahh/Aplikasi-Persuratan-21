<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .header{
            display: flex;
        }
        .intro_1{
            font-weight: bold;
            font-size: 25px;
            margin-top: 5px;
        }
        .intro_2{
            font-size: 15px;
            margin-top: -10px;
        }

        .date{
            margin-left: 65%;
        }

        .pembuka{
            margin-top: 5px;
        }

        .isi{
            margin-top: 15px
        }

        .isi_2{
            margin-top: 10px;
            margin-left: 10%;
        }

        .footer{
            margin-top: 50px;
            margin-left: 65%;
        }

        li{
            list-style: none;
            margin-bottom: 5px;
        }

    </style>
</head>

<body>
    <div class="header">
        <center>
            <div class="intro">
                <p class="intro_1">UMP, Kota.Pontianak</p>
                <p class="intro_2">Jl. Jenderal Ahmad Yani No.111, Bangka Belitung Laut, Kec. Pontianak Tenggara, Kota Pontianak, Kalimantan Barat 78123</p>
            </div>
        </center>
    </div>

    <hr>

    <div class="content">
        <div class="day">
            <p class="date">Pontianak, {{ date('d F Y') }}</p>
        </div>
        <div class="pembuka">
            <ul>
                <li> Nomor Surat   : {{ $surat_masuk->nomor_surat }}</li>
                <li> Surat         : Masuk</li>
                <li> Perihal       : {{ $surat_masuk->kategori->nama }}</li>
                <li> Pengirim      : {{ $surat_masuk->instasi->nama }}</li>
            </ul>
        </div>
        <div class="isi">
            <div class="isi_1">
                <ul>
                    <li> Kpd Yth    : </li>
                    <li>UMP</li>
                    <li>Kota Potianak</li>
                </ul>
            </div>
            <div class="isi_2">
                <p>
                    Berikut Kami Sampaikan Surat Masuk Yang Kami Terima Pada Tanggal <span style="font-weight: bold">{{ $surat_masuk->tanggal_masuk->format('d F Y') }}</span>
                    Mengenai Masalah <span style="font-weight: bold">{{ $surat_masuk->kategori->nama }}</span> Dan surat Ini Dikirim Oleh Instasi <span style="font-weight: bold">{{ $surat_masuk->instasi->nama }}</span> .
                    <br>
                    <br>
                    Berikut Kami Sampaikan Laporan Surat Masuk Pada Tanggal <span style="font-weight: bold">{{ $surat_masuk->tanggal_masuk->format('d F Y') }}</span>.
                    <br>
                    Terimakasih Atas Perhatiannya.
                </p>
                </p>
            </div>
        </div>
    </div>

    <div class="footer">
        <p class=>Pontianak, {{ date('d F Y') }}</p>
        <br><br><br>
        <p class="ttd">{{ $surat_masuk->instasi->nama }}</p>
    </div>

</body>

</html>
