
<!-- <button id="myBtn">Open Modal</button> -->


<div id="myModal" class="modal">

  <div class="modal-content">
    <img src="<?php echo get_template_directory_uri() . '/images/contact.png'; ?>" alt="Étiquette pour la modale contact">
    <?php echo do_shortcode('[contact-form-7 id="d08c706" title="Formulaire de contact"]'); ?>
  </div>

</div>