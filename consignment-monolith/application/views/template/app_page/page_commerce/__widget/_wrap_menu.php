
<div class="wrap_menu">
  <nav class="menu">
    <ul class="main_menu">
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
          <li <?php if($highlighted){echo 'class="sale-noti"';}?> >
            <a href="<?php echo $menu->link;?>"><?php echo $this->LanguageModel->getWording($menu->id);?></a>
            <?php
              if(!empty($submenus)){ ?>
                <ul class="sub_menu">
                  <?php foreach($submenus as $submenu){ ?>
                    <li><a href="<?php echo $submenu->link;?>"><?php echo $this->LanguageModel->getWording($submenu->id);?></a></li>
                  <?php } ?>
                </ul>
              <?php  } ?>
          </li>
      <?php } ?>


    </ul>
  </nav>
</div>
