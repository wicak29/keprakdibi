<?php echo form_open_multipart('C_importExcel/do_upload');?>

<input type="file" id="file_upload" name="userfile" size="20" />
<br />

<input type="submit" value="Upload" />

<?php echo form_close();?>
