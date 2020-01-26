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