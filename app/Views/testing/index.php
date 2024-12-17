<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h1,
        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            font-size: 0.9em;
            margin-top: 20px;
            color: #666;
        }
    </style>
</head>

<body>

    <h1>www.kensolusindo.com</h1>
    <h2>SLIP GAJI</h2>

    <table>
        <tr>
            <td>Nama Lengkap: </td>
            <td>{{Nama Lengkap}}</td>
            <td>Tanggal:</td>
            <td>{{Periode}}</td>
        </tr>
        <tr>
            <td>Divisi:</td>
            <td>{{Divisi}}</td>
            <td>Dibayarkan melalui:</td>
            <td>{{Bank}}</td>
        </tr>
        <tr>
            <td>Jabatan:</td>
            <td>{{Jabatan}}</td>
            <td>Nomor Rekening:</td>
            <td>{{AccountNo}}</td>
        </tr>
        <tr>
            <td>Pemilik Rekening:</td>
            <td>{{Nama Lengkap}}</td>
        </tr>
    </table>

    <h3>PENERIMAAN</h3>
    <table>
        <tr>
            <th>Deskripsi</th>
            <th>Jumlah (Rupiah)</th>
        </tr>
        <tr>
            <td>Gaji Pokok</td>
            <td>{{gaji_pokok}}</td>
        </tr>
        <tr>
            <td>Tunj. Jabatan</td>
            <td>{{tj_jabatan}}</td>
        </tr>
        <tr>
            <td>Tunj. Keahlian</td>
            <td>{{tj_keahlian}}</td>
        </tr>
        <tr>
            <td>Tunj. Masa Kerja</td>
            <td>{{tj_masa_kerja}}</td>
        </tr>
        <tr>
            <td>Tunj. Keluarga</td>
            <td>{{tj_keluarga}}</td>
        </tr>
        <tr>
            <td>Jumlah Hari Kerja</td>
            <td>{{Workdays}} Hari</td>
        </tr>
        <tr>
            <td>Jumlah Hari Hadir WFO</td>
            <td>{{WFO}} Hari</td>
        </tr>
        <tr>
            <td>Jumlah Hari Hadir WFA</td>
            <td>{{WFA}} Hari</td>
        </tr>
        <tr>
            <td>Jumlah Hari Ijin/Cuti/Sakit</td>
            <td>{{Ijin}} Hari</td>
        </tr>
        <tr>
            <td>Jumlah Hari Alpha</td>
            <td>{{Alpha}} Hari</td>
        </tr>
        <tr>
            <td>Tunj. Transportasi</td>
            <td>{{tj_transport}}</td>
        </tr>
        <tr>
            <td>Tunj. Makan Harian</td>
            <td>{{tj_makan}}</td>
        </tr>
        <tr>
            <td>Tunj. Komunikasi</td>
            <td>{{tj_komunikasi}}</td>
        </tr>
        <tr>
            <td>Tunj. PPH 21</td>
            <td>{{tj_pph21}}</td>
        </tr>
        <tr>
            <td>Tunj. Hari Raya</td>
            <td>{{tj_hari_raya}}</td>
        </tr>
        <tr>
            <td>Tunj. BPJS Kesehatan</td>
            <td>{{tj_bpjs_kesehatan}}</td>
        </tr>
        <tr>
            <td>Bonus</td>
            <td>{{bonus}}</td>
        </tr>
        <tr>
            <td>Lain-lain</td>
            <td>{{lain_lain}}</td>
        </tr>
        <tr>
            <th>Sub-Total Penerimaan</th>
            <td>{{Total Penerimaan}}</td>
        </tr>
    </table>

    <h3>POTONGAN</h3>
    <table>
        <tr>
            <th>Deskripsi</th>
            <th>Jumlah (Rupiah)</th>
        </tr>
        <tr>
            <td>Cicilan Pinjaman</td>
            <td></td>
        </tr>
        <tr>
            <td>Potongan bulan ini</td>
            <td>0</td>
        </tr>
        <tr>
            <td>Jumlah Pinjaman</td>
            <td>{{total_pj}}</td>
        </tr>
        <tr>
            <td>Pinjaman Terbayar</td>
            <td>{{pj_dibayar}}</td>
        </tr>
        <tr>
            <td>Sisa Pinjaman</td>
            <td>{{sisa_pj}}</td>
        </tr>
        <tr>
            <td>Pot. Kehadiran</td>
            <td>{{pot_absensi}}</td>
        </tr>
        <tr>
            <td>Pot. Keterlambatan</td>
            <td>{{pot_keterlambatan}}</td>
        </tr>
        <tr>
            <th>Sub-Total Potongan</th>
            <td>{{Total Potongan}}</td>
        </tr>
    </table>

    <h3>TOTAL:</h3>
    <p>{{total_transfer}} Rupiah</p>

    <div class="footer">
        Slip pembayaran gaji ini dibuat secara sistem dan tidak membutuhkan cap perusahaan dan tanda tangan.
    </div>

</body>

</html>