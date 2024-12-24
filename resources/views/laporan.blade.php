<!DOCTYPE html>
<html>
<head>
    <title>Laporan Tugas Akhir</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h4 style="text-align: center;">
        UNIVERSITAS ISLAM NEGERI AR-RANIRY BANDA ACEH<br/>
        FAKULTAS SAINS DAN TEKNOLOGI<br/>
        PRODI TEKNOLOGI INFORMASI <br/>
         <div style="border-bottom: 1px solid black; margin-top: 5px; margin-bottom: 0.5px;"></div>
        <div style="border-bottom: 1px solid black;"></div>
     </h4>
    <h2 style="text-align: center;">Total Tugas Akhir: {{ $totalTugasAkhir }}</h2>
    
    <table>
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Judul</th>
                <th style="text-align: center;">NIM</th>
                <th style="text-align: center;">Penulis</th>
                <th style="text-align: center;">Tahun</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($tugasAkhir as $tugas)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td style="text-align: justify;">{{ $tugas->judul }}</td>
                    <td>{{ $tugas->nim }}</td>
                    <td>{{ $tugas->penulis }}</td>
                    <td>{{ $tugas->tahun }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
