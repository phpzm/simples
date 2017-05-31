<?php
/** @var Simples\Template\View $this */

$app = config('app.name');
$title = $this->get('title');
$title = $app . ' / ' . ($title ?  $title : 'phpZM');

?>
<head>
  <meta charset="utf-8">
  <meta name="format-detection" content="telephone=no">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">

  <title><?php out($title) ?></title>

  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

  <link rel="apple-touch-icon" sizes="180x180" href="<?php $this->image('favicon/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" href="<?php $this->image('favicon/favicon-32x32.png" sizes="32x32') ?>">
  <link rel="icon" type="image/png" href="<?php $this->image('favicon/favicon-16x16.png" sizes="16x16') ?>">
  <link rel="manifest" href="<?php $this->image('favicon/manifest.json') ?>">
  <link rel="mask-icon" href="/<?php $this->image('favicon/safari-pinned-tab.svg') ?>" color="#318dce">

  <link href="<?php $this->style('style.css') ?>" rel="stylesheet" type="text/css">

  <meta name="theme-color" content="#8bbcff">
</head>
