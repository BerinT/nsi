


<div class="container">
  <h2>Korisnici</h2>
           
  <table class="table table-bordered" style="width: 50%;">
    <thead>
      <tr>
        <th>Username</th>
        <th>Pocetak odmora</th>
        <th>Kraj odmora</th>
      </tr>
    </thead>
    <tbody>   
	<?php
              
         foreach ($h->result() as $row)  
			{  
			
		  {
			 ?><tr>  
            <td><?php echo $row->username;?></td>  
			<td><?php echo $row->pocetak;?></td>
            <td><?php echo $row->kraj;?></td>  
            </tr>  
			<?php  }} 
         ?> 		
      </tbody>
  </table>
</div>

</body>
</html>
