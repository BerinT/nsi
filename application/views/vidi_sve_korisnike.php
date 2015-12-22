

<div class="container">
  <h2>Korisnici</h2>
           
  <table class="table table-bordered" cellspacing="0" style="width: 50%;" >
    <thead>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Uloga</th>
		<th>Akcija</th>
      </tr>
    </thead>
    <tbody>   
	<?php
              
         foreach ($h->result() as $row)  
			{  
			
		 if($row->uloga=='uposlenik') {
			 ?><tr>  
            <td><?php echo $row->username;?></td>  
			<td><?php echo $row->email;?></td>
            <td><?php echo $row->uloga;?></td>  
			<td><button  type="button" onClick="izbrisi(<?php echo $row->id;?>)">Izbrisi korisnika</button>
            </tr>  
			<?php  }} 
         ?> 		
      </tbody>
  </table>
</div>
<script>
function izbrisi(id) {
	$.post( "<?=site_url('user/obrisi_korisnika')?>", { id: id} );
	location.reload();
}

</script>
</body>
</html>
