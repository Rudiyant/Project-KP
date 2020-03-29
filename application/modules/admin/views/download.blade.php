<?php 
  if (empty($_SESSION['nama'])) 
  { 
    $this->session->set_flashdata('cekLogin', '<div style="color:red">Anda harus login terlebih dahulu!</div>'); 
    redirect('start'); 
  }
?>
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

?>