<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<<<<<<< HEAD
    <meta name="description" content="<?= $this->sitesetting->getValue('meta_desc'); ?>">
    <meta name="keyword" content="<?= $this->sitesetting->getValue('meta_key'); ?>">

    <title><?= $this->sitesetting->getValue('site_name'); ?></title>
=======
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Samer Abdelnour</title>
>>>>>>> 06c096d0d8a49e81aef55730edb3f0cf5c6753a2

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Buenard:700' rel='stylesheet' type='text/css'>
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/business-frontpage.css');?>" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
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
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url('home');?>">Home
                <span class="sr-only">(current)</span>
              </a>  
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('gallery');?>">Gallery</a>
            </li>
            <li class="nav-item">   
<<<<<<< HEAD
            <a class="logo" href="#">
              <img id="logo-navbar-middle" src="<?= base_url('/' . $this->sitesetting->getValue('site_logo') );?>" width="100" alt=""></a>
=======
            <a class="logo" href="#"><img id="logo-navbar-middle" src="<?php echo base_url('assets/img/logo-thing.png');?>" width="100" alt="Logo Thing main logo"></a>
>>>>>>> 06c096d0d8a49e81aef55730edb3f0cf5c6753a2
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('about');?>">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('contact');?>">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>