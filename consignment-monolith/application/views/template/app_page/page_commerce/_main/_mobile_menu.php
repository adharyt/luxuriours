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

    <?php
      $menus=$this->ConfigModel->getMenus('MAIN',NULL);
      foreach($menus as $menu){

        if(strpos($menu->link_highlight, '/{%}') !== false) {
            $check_highlight__array=array();
            $submenus=$this->ConfigModel->getMenus('MAIN',$menu->id);
            foreach($submenus as $submenu){
              array_push($check_highlight__array,$submenu->link);
              array_push($check_highlight__array,$submenu->link.'/');
            }
            $highlighted=in_array(current_url(),$check_highlight__array)?TRUE:FALSE;
        }else{
          $submenus=array();
          $highlighted=($menu->link==current_url() || $menu->link.'/'==current_url())?TRUE:FALSE;
        }

    ?>
        <li class="item-menu-mobile">
          <a href="<?php echo $menu->link;?>"><?php echo $this->LanguageModel->getWording($menu->id);?></a>
          <?php
            if(!empty($submenus)){ ?>
              <ul class="sub-menu">
                <?php foreach($submenus as $submenu){ ?>
                  <li><a href="<?php echo $submenu->link;?>"><?php echo $this->LanguageModel->getWording($submenu->id);?></a></li>
                <?php } ?>
              </ul>
              <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
            <?php  } ?>
        </li>
    <?php } ?>

  </ul>
</nav>
