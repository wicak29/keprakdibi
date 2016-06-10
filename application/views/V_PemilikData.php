<div style="margin-top:30px"></div>
<form action="<?php echo base_url();?>excel/uploadKontak/" method="post" enctype="multipart/form-data">
    
    <h4>Nama Instansi</h4><input type="text" name="nama_instansi"/>
	<br>
	<h4>no. Telp</h4><input type="text" name="no_telp"/>
	<br>
	<h4>email</h4><input type="text" name="email"/>
	<br>
	<h4>alamat</h4><input type="text" name="alamat"/>
	<br>
	<h4>Person in Charge</h4><input type="text" name="pic"/>
	<br>
	<h4>Preferred Contact</h4><input type="text" name="prefer"/>
	<br>
	<input type="submit" value="masukkan kontak"/>
	<br>
    
</form>