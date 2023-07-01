<?php 

session_start();

if(!isset($_SESSION["ssLoginSISURAT"])){
  header("location: ../auth/login.php");
  exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-sk.php";

$id = $_GET['id'];
$filesm = $_GET['file_sk'];

if(delete($id, $filesm)){
    echo"
            <script> 
                alert('data berhasil dihapus...');
                document.location.href = 'data-sk.php';
            </script>
        ";
}else{
    echo"
    <script> 
        alert('user gagal dihapus...');
        document.location.href = 'data-sk.php';
    </script>
";
}

?>