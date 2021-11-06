<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KARTU PENDAFTARAN</title>
    <style>
        @page {
            margin: 5%;
        }

        hr {
            border: none;
            height: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            /* border: 1px solid; */
            padding: 5px;
        }
    </style>
</head>

<body>
    <header>
        <div style="text-align: center;font-size: 17px;text-transform: uppercase;">
            KARTU PENDAFTARAN
            <br>
            <?= $sekolah; ?>
            <br>
            YAYASAN PONDOK PESANTREN BAHRUL ULUM
            <hr style="color:#000000;">
        </div>
    </header>
    <section>
        <table>
            <tr>
                <td style="width: 25%;font-size: 15px;">
                    No. Pendaftaran
                </td>
                <td style="width: 55%;font-size: 15px;">: <?= date('Y', time()) . '/' . $nomor; ?>
                </td>
                <td rowspan="5" style="width: 20%;font-size: 15px;text-align:center;border: 1px solid;padding-top:40px;padding-bottom:40px;">
                    <div style="padding-top:300px">
                        Foto 3x4</div>
                </td>
            </tr>
            <tr>
                <td style="width: 25%;font-size: 15px;">
                    Nama
                </td>
                <td style="width: 55%;font-size: 15px;">: <?= $nama; ?>
                </td>
            </tr>
            <tr>
                <td style="width: 25%;font-size: 15px;">
                    Jenis Kelamin
                </td>
                <td style="width: 55%;font-size: 15px;">: <?= $jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'; ?>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
    </section>
    <footer style="margin-top: 50px;">
        <table>
            <tr>
                <td style="width: 60%;font-size: 15px;border:none;"></td>
                <td style="width: 40%;font-size: 15px;text-align:center;">
                    Tertanda,
                    <br><br>
                    Panitia
                </td>
            </tr>
        </table>
    </footer>
</body>

</html>