<?php
include('koneksi\config.php');

    //tombol submit
    if(isset($_POST['simpan']))
    {
        //data hasil edit atau baru
        if($_GET['hal'] ==  "edit")
        {
          //data diedit
          $edit = mysqli_query($koneksi, "UPDATE mahasiswa SET
                                            nama = '$_POST[nama]',
                                            nim = '$_POST[nim]',
                                            nohp = '$_POST[nohp]',
                                            agama = '$_POST[agama]',
                                            alamat = '$_POST[alamat]'
                                          WHERE nomor = '$_GET[id]'
                            ");
          if($edit){ //jika edit berhasil tampilkan alert
            echo "<script>
                    alert('Edit Data Berhasil!');
                    document.location='index2.php';
                </script>";
          }else{
            echo "<script>
                    alert('Edit Data GAGAL!');
                    document.location='index2.php';
                </script>";
          }
        }
        else{
          //Simpan data baru
          $simpan = mysqli_query($koneksi, "INSERT INTO mahasiswa(nama,nim,nohp,agama,alamat)
                                            VALUES ('$_POST[nama]',
                                                    '$_POST[nim]',
                                                    '$_POST[nohp]',
                                                    '$_POST[agama]',
                                                    '$_POST[alamat]')
                                           ");
          if($simpan){ //jika edit berhasil tampilkan alert
            echo "<script>
                    alert('Input Data Berhasil!');
                    document.location='index2.php';
                </script>";
          }else{
            echo "<script>
                    alert('Input Data GAGAL!');
                    document.location='index2.php';
                </script>";
          }
        }
        
      }
  
      //action hapus
      if(isset($_GET['hal'])){
        if ($_GET['hal']=="hapus"){
          //persiapan hapus
          $hapus = mysqli_query($koneksi,"DELETE FROM mahasiswa WHERE nomor = '$_GET[id]' ");
          if($hapus){
            echo "<script>
                    alert('Hapus Data Berhasil!');
                    document.location='index2.php';
                </script>";
          }else{
            echo "<script>
                    alert('Hapus Data GAGAL!');
                    document.location='index2.php';
                </script>";
          }
        }
      }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tambah Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/stylehal.css">

    <!-- NAVBAR AWAL -->
    <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-primary">
              <div class="container-fluid">
                <a class="navbar-brand" href="#"> <img src="../assets/img/ublogo2.png" alt="">  Universitas Brawijaya</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                  <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="index1.php">Tambah</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="index2.php">Data</a>
                    </li>
                  </ul>
                  <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                </div>
              </div>
            </nav>
    </header>
    <!-- NAVBAR AKHIR -->
</head>
<body>
        <!-- awal card tabel -->
    <div class="container mt-5 mb-5">
      <div class="card">
        <h5 class="card-header text-white" style="background-color: rgb(41, 76, 192)">DAFTAR MAHASISWA</h5>
        <div class="card-body">
            <br> 
          <table class="table table-bordered table-striped">
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>NIM</th>
              <th>NOMOR HP</th>
              <th>AGAMA</th>
              <th>Alamat</th>
              <th>Action</th>
            </tr>
            <!-- Tabel Body -->
            <?php
            $no = 1;
              $tampil = mysqli_query($koneksi, "SELECT * from mahasiswa order by nomor desc");
              while($data = mysqli_fetch_array($tampil)) :

            ?>
            <tr>
              <td><?=$no++;?></td>
              <td><?=$data['nama'];?></td>
              <td><?=$data['nim'];?></td>
              <td><?=$data['nohp'];?></td>
              <td><?=$data['agama'];?></td>
              <td><?=$data['alamat'];?></td>
              <td>
                <a href="edit.php?hal=edit&id=<?=$data['nomor']?>" class="btn btn-warning">Edit</a>
                <a href="index2.php?hal=hapus&id=<?=$data['nomor']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="btn btn-danger"> Delete</a>
              </td>
            </tr>
            <?php endwhile; ?>
            <!-- akhir while -->
          </table>
        </div>
      </div>
    </div>
    <!-- akhir card tabel -->
    </div>
    <br>
    <br>
    <br>
    <!-- Container Akhir -->
    <!-- FOOTER -->
    <footer class="bg-primary text-center text-lg-start ">
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
              © 2020 Copyright:
              <a class="text-dark" href="https://getbootstrap.com/">getbootstrap.com</a>
            </div>
            <!-- Copyright -->
    </footer>
</body>
</html>