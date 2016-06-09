
<a href="<?php echo base_url(); ?>C_importExcel/">Upload lagi</a>
<br>
<?php
if(!$error)
{
    foreach($user as $row)
    {
        echo $row->nama;
        echo '<br/>';
        echo $row->alamat;
        echo '<br><br>';
    }
}
else
{
    echo $error;
}
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
