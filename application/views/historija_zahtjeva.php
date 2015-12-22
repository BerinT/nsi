


<div class="container">
  <h2>Historija zahtjeva</h2>
           
  <table class="table table-bordered" style="width: 50%;">
    <thead>
      <tr>
		<th>Pocetak odmora</th>
        <th>Kraj odmora</th>
        <th>Napomena</th>
        <th>Status zahtjeva</th>
      </tr>
    </thead>
    <tbody>   
	<?php
              
         foreach ($h->result() as $row)  
			{  
			
		  {
			 ?><tr> 
			<td><?php echo $row->pocetak;?></td>  			 
            <td><?php echo $row->kraj;?></td>  
			<td><?php echo $row->napomena;?></td>
            <td><?php echo $row->status;?></td>  
            </tr>  
			<?php  }} 
         ?> 		
      </tbody>
  </table>

</div>


</body>
</html>
