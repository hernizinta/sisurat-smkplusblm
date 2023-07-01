<?php 


function insert($data){
    global $koneksi;

    $perihalsm = strtolower(mysqli_real_escape_string($koneksi, $data ['perihalsm']));
    $nosm = (mysqli_real_escape_string($koneksi, $data ['no_sm']));
    $tglsm = (mysqli_real_escape_string($koneksi, $data ['tglsuratmasuk']));
    $asalsm = (mysqli_real_escape_string($koneksi, $data ['instansi']));
    $filesm = (mysqli_real_escape_string($koneksi, $_FILES ['file_sm']['name']));


    if($filesm != null){
        $filesm = uploadfile();
    }

    //file tidak sesuai validasi
    if($filesm == ''){
        return false;
    }

    $sqlUser = "INSERT INTO tbl_sm VALUE (null, '$perihalsm', '$nosm', '$tglsm', '$asalsm', '$filesm')";
    mysqli_query($koneksi, $sqlUser);

    return mysqli_affected_rows($koneksi);
}
function delete($id, $filesm){
    global $koneksi;
    $filesm = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM tbl_sm WHERE id_sm = $id"));
    unlink('../asset/suratmasuk/'.$filesm['file_sm']);
    $sqlDel = "DELETE FROM tbl_sm WHERE id_sm = $id";
    
    mysqli_query($koneksi, $sqlDel);
    return mysqli_affected_rows($koneksi);
}

function update($data)
{
    global $koneksi;

    $idsm = mysqli_real_escape_string($koneksi, $data['id']);
    $perihalsm = strtolower(mysqli_real_escape_string($koneksi, $data['perihalsm']));
    $nosm = mysqli_real_escape_string($koneksi, $data['no_sm']);
    $tglsm = mysqli_real_escape_string($koneksi, $data['tglsuratmasuk']);
    $asalsm = mysqli_real_escape_string($koneksi, $data['instansi']);
    $filesmLama = mysqli_real_escape_string($koneksi, $data['oldFilesm']);

    // Cek apakah file baru diunggah
    if ($_FILES['filesm']['name'] !== '') {
        // Hapus file lama
        if (!empty($filesmLama)) {
            $targetDirectory = '../asset/suratmasuk/';
            $oldFilePath = $targetDirectory . $filesmLama;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $filesm = $_FILES['filesm']['name'];

        // Ambil ekstensi file
        $fileExtension = pathinfo($filesm, PATHINFO_EXTENSION);

        // Generate nama file baru dengan ekstensi
        $newFilename = uniqid() . '.' . $fileExtension;

        // Simpan file ke direktori penyimpanan
        $targetDirectory = '../asset/suratmasuk/';
        $targetPath = $targetDirectory . $newFilename;
        move_uploaded_file($_FILES['filesm']['tmp_name'], $targetPath);

        // Update nama file di basis data
        mysqli_query($koneksi, "UPDATE tbl_sm SET
                                perihalsm = '$perihalsm',
                                no_sm = '$nosm',
                                tglsuratmasuk = '$tglsm',
                                instansi = '$asalsm',
                                file_sm = '$newFilename'
                                WHERE id_sm = $idsm");
    } else {
        // Jika tidak ada file baru diunggah, gunakan nama file lama
        $filesm = $filesmLama;

        mysqli_query($koneksi, "UPDATE tbl_sm SET
                                perihalsm = '$perihalsm',
                                no_sm = '$nosm',
                                tglsuratmasuk = '$tglsm',
                                instansi = '$asalsm'
                                WHERE id_sm = $idsm");
    }

    return mysqli_affected_rows($koneksi);
}
?>