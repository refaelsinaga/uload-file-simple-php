<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Upload Gambar</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <img src="rl.png" width="28px" alt="">
    <P>REFAELSINAGA | TUTORIAL CRUD | MD5</P>
    <hr>
    <fieldset>
        <legend>Form upload</legend>
        <form action="" method="POST" enctype="multipart/form-data">
            <?php 
            include 'conn.php';
            if (isset($_POST['btn-simpan'])) 
            {
                if (empty($_POST['nama_file'])) 
                {
                    echo "data harus nama lengkap";
                }else
                {
                    $nama_file  = $_POST['nama_file'];
                    $file_b     = $_FILES['file']['name'];
                    $file       = date('dmYHis').$file_b;
                    $size       = $_FILES['file']['size'];
                    $file_type  = $_FILES['file']['type'];
                    $file_tmp   = $_FILES['file']['tmp_name'];


                    if ( move_uploaded_file($file_tmp, 'file/'.$file)) 
                    {
                         mysql_query("INSERT INTO upload VALUES (NULL, '$nama_file','$size','$file_type','$file')") or die(mysql_error());
                         header('Location:index.php');
                    }else
                    {
                         echo "Upload Gagal";
                    }
                } 
            }

            ?>
            <table>
                <tr>
                    <th>Nama File/ Ket</th>
                    <th>:</th>
                    <th><input type="text" name="nama_file" value="" placeholder=""></th>
                </tr>
                <tr>
                    <th>Upload File</th>
                    <th>:</th>
                    <th><input type="file" name="file" value="" placeholder="" required=""></th>
                </tr>
            </table>
            <input type="submit" name="btn-simpan" value="Simpan">
        </form>
    </fieldset>
    <fieldset>
        <legend>Galery file</legend>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Ket</th>
                    <th>Type File</th>
                    <th>Size File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conn.php';
                $no=1;
                $query = mysql_query("SELECT * FROM upload")or die(mysql_error());
                while ($data = mysql_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><a href="file/<?php echo $data['file']; ?>"><?php echo $data['file']; ?></a></td>
                    <td><?php echo $data['nama_file']; ?></td>
                    <th><?php echo $data['file_type']; ?><a></th>
                    <th><?php echo $data['size']; ?><a></th>
                    <td>
                        <a href="hapus.php?id_file=<?php echo $data['id_file']; ?>" title="">Hapus</a> 
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </fieldset>
</body>
</html>