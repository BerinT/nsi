<br><br>

<div class="container" style="float: left;">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php echo $this->session->flashdata('sektor_msg'); ?>
    </div>
</div>
<div class="container">

<form action="<?=site_url('user/obradi_dodavanje_sektora')?>" method="post">
  <p>Naziv sektora: <input type="text" name="naziv_sektora"></p>
  <p>Nadlezni menadzer: <input type="text" name="menadzer"></p>

  <input type="submit" value="OK">
</form>
</div>

</body>
</html>