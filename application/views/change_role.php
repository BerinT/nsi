<br><br>

<div class="container" style="float: left;">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php echo $this->session->flashdata('role_msg'); ?>
    </div>
</div>

<div class="container">
<form action="<?=site_url('user/obradi_promjenu_uloge')?>" method="post">
  <p>Korisnik: <input type="text" name="menadzer"></p>
  <p>Nova uloga: <select name="uloga">
    <option value="uposlenik">Uposlenik</option>
    <option value="administrator">Administrator</option>
    <option value="manager">Menadzer</option>
  </select></p>

  <input type="submit" value="OK">
</form>
</div>

</body>
</html>
