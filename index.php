<?php error_reporting(E_ALL ^ E_NOTICE);
include 'koneksi.php';
echo "<h2>Selamat Datang Di Data Mahaiswa </h2> <hr><p></p>";
"$vMenu= ";
if (isset($_GET['menu']))
    $vMenu = $_GET['menu'];
//if($_GET['menu']==")
if ($vMenu == ""); {


    echo "<a href='?menu=tambah_data'><input type=submit value='Tambah'></a><p></p><table border=1 cellpadding=10 cellspacing=0>
    <tr><bgcolor='#ccc'><td>ID</td><td>Nama</td><td>Prodi</td><td>Alamat</td><td>Action</td></tr>";

    $query = "SELECT * FROM dt_mhs";
    $statemen = oci_parse($c, $query);
    oci_execute($statemen, OCI_DEFAULT);
    while ($data = oci_fetch_array($statemen, OCI_BOTH)) {
        echo "<tr>
                <td>" . $data['ID_MHS'] . "</td>
                <td>" . $data['NAMA'] . "</td>
                <td>" . $data['PRODI'] . "</td>
                <td>" . $data['ALAMAT'] . "</td>
                <td>
                    <a href='?menu=edit&id=$data[ID_MHS]'>edit</a>
                    <a href='?menu=delete&id=$data[ID_MHS]' onclick=\"return confirm('Yakin Mau Hapus $data[NAMA]??\")'>Hapus</a>
                </td>
            </tr>";
    }

    echo '</table>';

    oci_free_statement($statemen);
}
//if($_GET['menu']=='edit'){
if ($vMenu == 'edit') {
    $sql = "SELECT * FROM dt_mhs WHERE ID_MHS = $_GET[id]";
    $statemen = oci_parse($c, $sql);
    oci_execute($statemen, OCI_DEFAULT);
    $data = oci_fetch_array($statemen, OCI_BOTH);
    echo "
<form method=POST action='?menu=edit_data'>
 <table border=1 cellpadding=4 cellspacing=0>
 <tr><td>ID</td><td><input type=text name='id_mhs_ubah' value='$data[ID_MHS]' size=1 disabled></td></tr>
 <tr><td>Nama</td><td><input type=text name='nama_ubah' value='$data[NAMA]'></td><tr>
 <tr><td>Prodi</td><td><input type=text name='prodi_ubah' value='$data[PRODI]'></td><tr>
 <tr><td>Alamat</td><td><input type=text name='alamat_ubah' value='$data[ALAMAT]'></td><tr>
 <tr><td></td><td><input type=submit value='Update'></td><tr>
 </table>
 </form>
";
}

//if($_GET['menu']=='tambah_data'){
if ($vMenu == 'tambah_data') {
    echo "
<form method=POST action='aksi.php?act=tambah_data'>
 <table border=1 cellpadding=4 cellspacing=0>
 <tr><td>ID</td><td><input type=varchar2 name='id_mhs'></td></tr>
 <tr><td>Nama</td><td><input type=varchar2 name='nama'><z/td></tr>
 <tr><td>Prodi</td><td><input type=varchar2 name='prodi'></td></tr>
 <tr><td>Alamat</td><td><input type=varchar2 name='alamat'></td></tr>
 <tr><td></td><td><input type=submit value='SIMPAN'></td><tr>
 </table>
 </form>
";
}

if ($vMenu == 'delete') {
    $sql = "DELETE FROM dt_mhs WHERE ID_MHS = $_GET[id]";
    $statemen = oci_parse($c, $sql);
    oci_execute($statemen, OCI_DEFAULT);
    oci_free_statement($c);
    oci_commit($c);
    if ($sql) {
        echo '<script>alert("Data Berhasil di Hapus");window.location="./"</script>';
    } else {
        echo '<script>alert("Data Gagal di Hapus");window.location="./"</script>';
    }
}

if ($vMenu == 'edit_data') {
    $sql = "UPDATE dt_mhs SET nama='$_POST[nama_ubah]',prodi='$_POST[prodi_ubah]',alamat='$_POST[alamat_ubah]' where id_mhs='$_GET[id]'";
    $statemen = oci_parse($c, $sql);
    oci_execute($statemen);
    oci_commit($c);
    if ($sql) {
        echo '<script>alert("Data Berhasil di Edit");window.location="./"</script>';
    } else {
        echo '<script>alert("Data Gagal di Edit");window.location="./"</script>';
    }
}
