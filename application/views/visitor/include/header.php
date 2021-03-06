<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $this->sitesetting->getValue('meta_desc'); ?>">
    <meta name="keyword" content="<?= $this->sitesetting->getValue('meta_key'); ?>">

    <title><?= $this->sitesetting->getValue('site_name'); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Buenard:700' rel='stylesheet' type='text/css'>
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/business-frontpage.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css');?>">
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item <?= ($this->currentRoute) ? '' : 'active'; ?>">
              <a class="nav-link" href="<?php echo base_url();?>">Home</a>
            </li>
            <li class="nav-item <?= ($this->currentRoute === 'gallery') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?php echo base_url('gallery');?>">Gallery</a>
            </li>
            <li class="nav-item">
            <a class="logo">
              <img id="logo-navbar-middle" src="<?= base_url('/' . $this->sitesetting->getValue('site_logo') );?>" width="100" alt=""></a>
            </li>
            <li class="nav-item <?= ($this->currentRoute === 'events') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?php echo base_url('events');?>">Events</a>
            </li>
            <li class="nav-item <?= ($this->currentRoute === 'contact') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?php echo base_url('contact');?>">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
