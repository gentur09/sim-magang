<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kinerja Mahasiswa</title>
</head>

<body>
    <h2 style="text-align: center">List Kinerja Mahasiswa</h2>
    <center>
        <table border="1" width="100%">
            <tr>
                <th>No</th>
                <th>Kinerja</th>
                <th>Projek</th>
                <th>Pembimbing Project</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($kinerja as $k) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $k->kinerja; ?></td>
                    <td><?= $k->projek; ?></td>
                    <td><?= $k->nama_pembimbing; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </center>
</body>

</html>