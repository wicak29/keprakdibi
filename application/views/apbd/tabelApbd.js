function showApbd(tahun) 
{
    $("#dataTable").html("");
    for(i=0;i<61;i++)
    {
      $( "#tabelBarang" ).append( 
          "<tr>"+
          "<td>"+list_barang[i][0].idbarang+"</td>"+
          "<td>"+list_barang[i][0].nama_barang+"</td>"+
          "<td>"+list_barang[i][0].ukuran+"</td>"+
          "<td>"+list_barang[i][0].satuan_ukur+"</td>"+
          "<td>"+list_barang[i][0].kategori+"</td>"+
          "<td>"+list_barang[i][0].harga+"</td>"+
          "<td>"+list_barang[i][1]+"</td>"+
          "</tr>" );             
      }
    }
}   