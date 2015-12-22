


<div class="container">
  <h2>Zahtjevi na cekanju</h2>
           
  <table class="table table-bordered" style="width: 50%;">
    <thead>
      <tr>
		<th>id zahtjeva</th>
        <th>podnosilac</th>
        <th>pocetak</th>
        <th>kraj</th>
		<th>napomena</th>
		<th>akcije</th>
      </tr>
    </thead>
    <tbody>   
	<?php
              
         foreach ($h->result() as $row)  
			{  
			
		 if($row->status=='pending' ) {
			 ?><tr> 
			<td><?php echo $row->id_zahtjeva;?></td>  			 
            <td><?php echo $row->username;?></td>  
			<td><?php echo $row->pocetak;?></td>
            <td><?php echo $row->kraj;?></td>  
			<td><?php echo $row->napomena;?></td> 
			<td><button  type="button" onClick="odobri(<?php echo $row->id_zahtjeva;?>)">Odobri</button>
			<button  type="button" onClick="odbij(<?php echo $row->id_zahtjeva;?>)">Odbij</button>
			</td>
            </tr>  
			<?php  }} 
         ?> 		
      </tbody>
  </table>
  <!--<form action="<?=site_url('user/obradi_zahtjeve_na_cekanju')?>" method="post">
  <p>id zahtjeva: <input type="number" name="id_zahtjeva"></p>
  <p>Akcija: <select name="akcija">
    <option value="Odobri">Odobri</option>
    <option value="Odbij">Odbij</option>
  </select></p>
  
  
  
  <input type="submit" value="OK">
</form>

-->

</div>

<div>


</div>
<script>
function odobri(id) {
	$.post( "<?=site_url('user/obradi_zahtjeve_na_cekanju')?>", { id_zahtjeva: id, akcija: "Odobri" } );
	location.reload();
}
function odbij(id) {
	$.post( "<?=site_url('user/obradi_zahtjeve_na_cekanju')?>", { id_zahtjeva: id, akcija: "Odbij" } );
	location.reload();
}
</script>
</body>
</html>
