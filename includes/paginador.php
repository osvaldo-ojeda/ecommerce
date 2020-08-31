<div class="pagination">
  <a href="?pagina=<?= $_GET['pagina'] - 1 ?>"class="<?=$_GET['pagina']<=1?'deshabilitado':'active';?>" >
    &laquo;
  </a>

  <?php
  for ($a =1; $a <= $paginas; $a++) {
  ?>
    <a href="?pagina=<?= $a; ?>" class="<?=$_GET['pagina']==$a?'active':'';?>"> 
      <?= $a; ?>
    </a>
  <?php
  }
  ?>

  <a href="?pagina=<?= $_GET['pagina'] + 1 ?>"class="<?=$_GET['pagina']>=$paginas?'deshabilitado':'active';?>" >
    &raquo;
  </a>
</div>