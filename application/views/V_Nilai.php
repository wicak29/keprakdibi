<div style="margin-top:30px"></div>
<form action="<?php echo base_url();?>excel/uploadNilai/" method="post" enctype="multipart/form-data">
    <h4>Tahun :</h4><input type="text" name="tahun"/>
	<br>
    <input type="file" name="file"/>
    <input type="submit" value="Upload file"/>
</form>