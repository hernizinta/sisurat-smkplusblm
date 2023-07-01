<?php 


function insert($data){
    global $koneksi;

    $perihalsk = strtolower(mysqli_real_escape_string($koneksi, $data ['perihalsk']));
    $nosk = (mysqli_real_escape_string($koneksi, $data ['no_sk']));
    $tglsk = (mysqli_real_escape_string($koneksi, $data ['tglsuratkeluar']));
    $asalsk = (mysqli_real_escape_string($koneksi, $data ['instansi']));
    $filesk = (mysqli_real_escape_string($koneksi, $_FILES ['file_sk']['name']));


    if($filesk != null){
        $filesk = uploadfilesk();
    }

    //file tidak sesuai validasi
    if($filesk == ''){
        return false;
    }

    $sqlUser = "INSERT INTO tbl_sk VALUE (null, '$perihalsk', '$nosk', '$tglsk', '$asalsk', '$filesk')";
    mysqli_query($koneksi, $sqlUser);

    return mysqli_affected_rows($koneksi);
}
function delete($id, $filesk){
    global $koneksi;
    $filesk = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM tbl_sk WHERE id_sk = $id"));
    unlink('../asset/suratkeluar/'.$filesk['file_sk']);
    $sqlDel = "DELETE FROM tbl_sk WHERE id_sk = $id";
    
    mysqli_query($koneksi, $sqlDel);
    return mysqli_affected_rows($koneksi);
}

function update($data)
{
    global $koneksi;

    $idsk = mysqli_real_escape_string($koneksi, $data['id']);
    $perihalsk = strtolower(mysqli_real_escape_string($koneksi, $data['perihalsk']));
    $nosk = mysqli_real_escape_string($koneksi, $data['no_sk']);
    $tglsk = mysqli_real_escape_string($koneksi, $data['tglsuratkeluar']);
    $asalsk = mysqli_real_escape_string($koneksi, $data['instansi']);
    $fileskLama = mysqli_real_escape_string($koneksi, $data['oldFilesk']);

    // Cek apakah file baru diunggah
    if ($_FILES['filesk']['name'] !== '') {
        // Hapus file lama
        if (!empty($fileskLama)) {
            $targetDirectory = '../asset/suratkeluar/';
            $oldFilePath = $targetDirectory . $fileskLama;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $filesk = $_FILES['filesk']['name'];

        // Ambil ekstensi file
        $fileExtension = pathinfo($filesk, PATHINFO_EXTENSION);

        // Generate nama file baru dengan ekstensi
        $newFilename = uniqid() . '.' . $fileExtension;

        // Simpan file ke direktori penyimpanan
        $targetDirectory = '../asset/suratkeluar/';
        $targetPath = $targetDirectory . $newFilename;
        move_uploaded_file($_FILES['filesk']['tmp_name'], $targetPath);

        // Update nama file di basis data
        mysqli_query($koneksi, "UPDATE tbl_sk SET
                                perihalsk = '$perihalsk',
                                no_sk = '$nosk',
                                tglsuratkeluar = '$tglsk',
                                instansi = '$asalsk',
                                file_sk = '$newFilename'
                                WHERE id_sk = $idsk");
    } else {
        // Jika tidak ada file baru diunggah, gunakan nama file lama
        $filesk = $fileskLama;

        mysqli_query($koneksi, "UPDATE tbl_sk SET
                                perihalsk = '$perihalsk',
                                no_sk = '$nosk',
                                tglsuratkeluar = '$tglsk',
                                instansi = '$asalsk'
                                WHERE id_sk = $idsk");
    }

    return mysqli_affected_rows($koneksi);
}


?>