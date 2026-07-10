<style media="screen">
  .header_account_title{
    font-family: 'Roboto', sans-serif;
  }
  .side_bar_menu_font{
    font-family: 'Roboto', sans-serif;
  }
</style>
<hr>
<div class="row" style="min-height:500px">
    <div class="col-md-2 d-lg-block d-none bg-light" style="background-color:white !important;">
      <a href="<?php echo base_url();?>">
        <p class="ml-3"><small><u><span class="fas fa-arrow-left"></span> Kembali ke Beranda</small></u></p>
      </a>


        <ul class="mt-2">
            <?php
              $menus=$this->ConfigModel->getMenus('PROFILE_0',NULL);
              foreach($menus as $menu){
                $highlighted=($menu->link==current_url() || $menu->link.'/'==current_url())?TRUE:FALSE;
            ?>
                <li class="p-2 m-0 border-light side_bar_menu_font">
                  <a href="<?php echo $menu->link;?>" class="m-3 ml-3 text-dark"
                    <?php if($highlighted){echo "style='color:#009245!important;'";}?>
                    >
                    <span class="<?php echo $menu->custom_field0;?>"></span> <?php echo $this->LanguageModel->getWording($menu->id);?></a>
                </li>
            <?php } ?>

            <hr>

            <?php
              $menus=$this->ConfigModel->getMenus('PROFILE_1',NULL);
              foreach($menus as $menu){
                $highlighted=($menu->link==current_url() || $menu->link.'/'==current_url())?TRUE:FALSE;
            ?>
                <li class="p-2 m-0 border-light side_bar_menu_font">
                  <a href="<?php echo $menu->link;?>" class="m-3 ml-3 text-dark"
                    <?php if($highlighted){echo "style='color:#009245!important;'";}?>
                    >
                    <span class="<?php echo $menu->custom_field0;?>"></span> <?php echo $this->LanguageModel->getWording($menu->id);?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
