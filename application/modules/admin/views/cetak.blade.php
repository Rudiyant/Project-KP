<!-- 
<?php
 $alasan = $_POST['alasan'];
 
	echo "
	<center>
	<h1>CONTOH SURAT PENOLAKAN</h1>
	</center>
	
	<p> $alasan </p>
  
    <script>
		window.print();
	</script>
";

?> -->

<!DOCTYPE html>
<html>
<head>
	<title>Contoh Surat</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 	<table align="center" style="padding-left: 0pt;">
    <tr>
      <td width="100pt" align="center">
        <img src="{{base_url('assets/dist/img/logo.jpg')}}" style="	width: 50px; height: 50px; float: left;">
        </td>
      <td>
      	<div align="center" style="font-size: 18pt">
      		Sekolah xxxxxxxxxxx<br>
        </div>
        <div style="font-size: 14pt; text-align: center;">
           Alamat xxxxxxxxxxxxx
        </div>
      </td>
    </tr>
  </table>
  <div style="background-color: black; padding: 2px 100px"></div>

  <div class="tbl">
  	<table>
  		<tr>
  			<td>Kepada Yth. xxxxxxxxxxxxxxx</td>
  			<td style="float: right; padding-left: 700pt">Yogyakarta, ................</td>
  		</tr>
  		<tr>
  			<td>di..........</td>
  		</tr>
  	</table>
  </div>

  <div class="konten">
  <p style="text-align: justify;">
  	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
  	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
  	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
  	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
  	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
  	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
  </p>
  <table align="center">
  <?php
                foreach($karyawans as $karyawan)
                {
                    ?>  
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td><?=$karyawan->nama;?></td>
						</tr>
						<tr>
							<td>Jabatan</td>
							<td>:</td>
							<td><?=$karyawan->nama_jabatan;?></td>
						</tr>
						<tr>
							<td>Divisi</td>
							<td>:</td>
							<td><?=$karyawan->nama_divisi;?></td>
						</tr>
                <?php
                }
    ?>
  </table>
  </div>

  <div class="ket">
  <p style="text-align: justify;">
  	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
  	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
  	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
  	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
  	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
  	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
  </p>
  </div>

  <div class="ttd">
  	<table style="float: right;">
  		<tr style="height: 10pt"></tr>
  		<tr>
  			<td>Yogyakarta, xxxxxxxxxxxxx</td>
  		</tr>
  		<tr>
  			<td>Kepala xxxxxxxxxxx</td>
  		</tr>
  		<tr style="height: 50pt"></tr>
  		<tr>
  			<td>xxxxxxxxxxxx</td>
  		</tr>
  	</table>
  </div>
  <script>
		window.print();
  </script>
</body>
</html>