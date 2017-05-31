<?php
/** @var Simples\Template\View $this */

$this->extend('_layout/basic/html.php', 'body');
?>
<div class="flex-center position-reference full-height">
  <div class="content">
    <img src="<?php $this->image('logo.png'); ?>" class="logo" alt="building">
    <hr>
    <div class="title">
      simples
    </div>
    <hr>
    <div class="links">
      <a href="https://docs.simples.cloud">Documentation</a>
      <a href="https://phpzm.rocks">phpZM</a>
      <a href="https://github.com/phpzm/simples">GitHub</a>
    </div>
  </div>
</div>
