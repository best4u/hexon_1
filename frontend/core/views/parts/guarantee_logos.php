
<?php if ($car->guarantees->guarantee_auto_trust && $car->guarantees->guarantee_auto_trust == 'Ja'): ?>
  <img src="<?php echo plugins_url("../img/auto-tr.png", __FILE__) ?>" alt="">
<?php endif; ?>

<?php if ($car->guarantees->guarantee_nap  && $car->guarantees->guarantee_nap == 'Ja'): ?>
 <img src="<?php echo plugins_url("../img/NAP_Logo.jpg",
 __FILE__) ?>" alt="">
<?php endif; ?>

<?php if ($car->guarantees->guarantee_bovag  && $car->guarantees->guarantee_bovag == 'Ja'): ?>
 <img src="<?php echo plugins_url("../img/Logo-BOVAG-Garantie.jpg",
 __FILE__) ?>" alt="">
<?php endif; ?>