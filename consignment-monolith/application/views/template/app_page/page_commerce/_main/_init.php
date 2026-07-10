<!DOCTYPE html>
<html lang="en">
  <head>
  <?php $this->load->view('template/app_page/_info'); ?>
  <?php $this->load->view('template/app_page/style'); ?>
  <!-- JS-INNER -->
  <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/keyboard.min.js');?>"></script>
  <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/endpoint.js');?>"></script>
  <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/regex.js');?>"></script>
  <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/alert/ajax_response.js');?>"></script>
  <script src="<?php echo $this->ConfigModel->getAppInfo_renewable_file__link('PATH__ASSETS_SHARED','/javascript/_inner/_mandatory/alert/loading.js');?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <?php echo $view->style; ?>
  </head>
  <body class="animsition">
    <?php $this->load->view('template/app_page/page_commerce/_main/header'); ?>
      <?php echo $view->content; ?>
      <?php $this->load->view('template/app_page/footer_0'); ?>
    <?php $this->load->view('template/app_page/footer_1'); ?>
    <?php echo $view->script; ?>
  </body>
</html>
