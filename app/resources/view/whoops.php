<?php
/** @var Simples\Template\View $this */

$this->extend('_layout/basic/html.php', 'body');

return function ($data = []) {
  ?>
  <div class="flex-center position-reference full-height">
    <div class="content">
      <hr>
      <img src="<?php $this->image('building.png'); ?>" alt="building">
      <hr>
    </div>
  </div>
    <?php
};
