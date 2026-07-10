<nav class="side-menu">
  <ul class="main-menu">

    <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
      <div class="topbar-child2-mobile">
        <span class="topbar-email">
          Pilih bahasa:
        </span>

        <div class="topbar-social rs1-select2" style="position:relative;padding:0px">
          <?php $this->load->view('template/app_page/page_commerce/__widget/_language_selector');?>
        </div>
      </div>
    </li>

    <li class="item-menu-mobile">
      <a href="<?php echo base_url();?>"><small><u><span class="fas fa-arrow-left"></span> Kembali ke Beranda</small></u></a>
    </li>
    <?php
      $menus=$this->ConfigModel->getMenus('PROFILE_0',NULL);
      foreach($menus as $menu){
        $highlighted=($menu->link==current_url() || $menu->link.'/'==current_url())?TRUE:FALSE;
    ?>
        <li class="item-menu-mobile">
          <a href="<?php echo $menu->link;?>"><?php echo $this->LanguageModel->getWording($menu->id);?></a>
        </li>
    <?php } ?>
    <hr>
    <?php
      $menus=$this->ConfigModel->getMenus('PROFILE_1',NULL);
      foreach($menus as $menu){
        $highlighted=($menu->link==current_url() || $menu->link.'/'==current_url())?TRUE:FALSE;
    ?>
        <li class="item-menu-mobile">
          <a href="<?php echo $menu->link;?>"><?php echo $this->LanguageModel->getWording($menu->id);?></a>
        </li>
    <?php } ?>



  </ul>
</nav>
