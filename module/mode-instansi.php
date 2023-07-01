<?php 

if (userLogin()['level'] == 3) {
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insert($data){
    global $koneksi;

    $nama   = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon = mysqli_real_escape_string($koneksi, $data['telpon']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $ketr   = mysqli_real_escape_string($koneksi, $data['ketr']);

    $sqlInstansi = "INSERT INTO tbl_instansi VALUE (null, '$nama', '$telpon', '$ketr', '$alamat')";
    mysqli_query($koneksi, $sqlInstansi);

    return mysqli_affected_rows($koneksi);
}

function delete($id){
    global $koneksi;

    $sqlDelete = "DELETE FROM tbl_instansi WHERE id_instansi = $id";

    mysqli_query($koneksi, $sqlDelete);

    return mysqli_affected_rows($koneksi);
}

function update($data){
    global $koneksi;

    $id   = mysqli_real_escape_string($koneksi, $data['id']);
    $nama   = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon = mysqli_real_escape_string($koneksi, $data['telpon']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $ketr   = mysqli_real_escape_string($koneksi, $data['ketr']);

    $sqlInstansi = "UPDATE tbl_instansi SET
                    nama = '$nama',
                    telpon = '$telpon',
                    alamat = '$alamat',
                    deskripsi = '$ketr'             
                    WHERE id_instansi = $id";
    mysqli_query($koneksi, $sqlInstansi);

    return mysqli_affected_rows($koneksi);
}

?>