
<div class="container" style="float: left;">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php echo $this->session->flashdata('verifi_msg'); ?>
    </div>
</div>

<div class="container">
  <h1>Izvještaj o bolovanju</h1>
  
  <div id="forma" >
<form action="obradi_zahtjev_bolovanje" method="post">
<p>Pocetak: <input type="date" name="pocetak"></p>
<p>Kraj: <input type="date" name="kraj"></p>
<p>Napomena:<br> <textarea name="komentar" rows="5" cols="40"></textarea>
<p><input type="submit" value="Posalji izvjestaj"></p>

</form>
</div>
           
 

</div>
</div>


</body>
</html>