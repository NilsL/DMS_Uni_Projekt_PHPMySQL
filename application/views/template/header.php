<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <title>Dokumentenverwaltung</title>

   <!--   Framework CSS-->
   <link rel="stylesheet" href="<?php echo base_url(); ?>css/screen.css" type="text/css" media="screen, projection"/>
   <link rel="stylesheet" href="<?php echo base_url(); ?>css/print.css" type="text/css" media="print"/>

   <!--[if IE]>
   <link rel="stylesheet" href="<?php echo base_url(); ?>css/ie.css" type="text/css" media="screen, projection"/>
   <![endif]-->

   <!-- Import fancy-type plugin. -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>css/plugins/fancy-type/screen.css" type="text/css"
         media="screen, projection"/>

   <!--   JavaScript-->
   <?php
   if (isset($search_adv)) {
      ?>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>js/ajax.js"></script>
   <?php
   }
   ?>
</head>

<body>
<!--debugging options-->
<?//= $this->db->last_query(); ?>
<div class="container">
   <div id="header" class="span-24 last">
      <br/>

      <h1 id="titel">
         <?php echo img('img/logo-jade-hochschule.png', 'class="left"'); ?>Dokumentenverwaltung
      </h1>

      <hr/>

   </div>
