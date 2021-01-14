
<?php error_reporting(0);
include 'koneksi.php';
$act = $_GET['act'];

if ($act == 'tambah_data') {
    $sql = "INSERT INTO dt_mhs (id_mhs,nama,prodi,alamat)
    values('$_POST[id_mhs]','$_POST[nama]','$_POST[prodi]','$_POST[alamat]')";
    $statemen = oci_parse($c, $sql);
    oci_execute($statemen, OCI_DEFAULT);
    oci_commit($c);
    if ($sql) {
        echo '<script>alert("Data Berhasil di Tambahkan");window.location="./"</script>';
    } else {
        echo '<script>alert("Data Gagal di Tambahkan");window.location="./"</script>';
    }
}
?>
