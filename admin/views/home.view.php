<?php if(!defined('__CONTROLLER__')) return; ?>
<?php getTemplate("header", $viewParams); ?>

<body>
  <!-- Page Wrapper -->
  <div class="wrapper">
    <?php getTemplate("sidebar", $viewParams); ?>
    <!-- Content Wrapper -->
    <div class="main-panel">
      <!-- Navbar/topbar -->
      <?php getTemplate("topbar", $viewParams); ?>
      <!-- Begin Page Content -->
      <?php getTemplate("dashboard", $viewParams); ?>
      <!-- footer -->
      <?php getTemplate("footer", $viewParams) ?>
    </div>
  </div>
  <!-- setting -->
  <?php getTemplate("setting", $viewParams);?>
  <!-- End of Main Content -->

  <!-- script -->
   <?php getTemplate("end", $viewParams);?>

