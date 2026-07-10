<?php
if($this->session->userdata('is_login')==TRUE){
?>
<!-- Transaction -->
<div class="row" style="width:60px;margin-left:0px;margin-right:0px;">
  <div class="col" style="padding:0px">
    <a href="javascript:void(0);" onClick="showNotificationTrans();" data-toggle="tooltip" data-placement="bottom" title="Transaksi">
      <i class="fa fa-fw fa-exchange-alt"></i>

    </a>
  </div>
  <div class="col" style="padding:0px">
    <span class="badge badge-pill badge-danger " style="margin-left: -20px;margin-top: -12px;font-size:75%;padding-left:.4em;padding-right:.4em;display:none">
      0
    </span>
  </div>
</div>
<div id="popupTransaction" class="transaction-notif-popup popUpHeader" style="display:none !important;width:425px">
  <div class="arrow_box_trans" id="popupTransactionContent">
    Loading...
  </div>
</div>

<!-- Notifikasi -->
<div class="row" style="width:60px;margin-left:0px;margin-right:0px;">
  <div class="col" style="padding:0px">
    <a href="javascript:void(0);" onClick="showNotification();" data-toggle="tooltip" data-placement="bottom" title="Notifikasi">
      <i class="fa fa-fw fa-bell"></i>

    </a>
  </div>
  <div class="col" style="padding:0px">
    <span id="notification_user_badge" class="badge badge-pill badge-danger " style="margin-left: -20px;margin-top: -12px;font-size:75%;padding-left:.4em;padding-right:.4em;display:none">
      0
    </span>
  </div>
</div>
<div id="popupNotification" class="notification-popup popUpHeader" style="display:none !important;width:425px">
  <div class="arrow_box" id="popupNotificationContent">
    Loading...
  </div>
</div>

<div class="row" style="width:60px;margin-left:0px;margin-right:0px;">
    <div class="dropdown dropleft">
      <button class="dropbtn" style="width:100%"><img id="imgProfileHeader" width="27px" src="<?php echo $this->session->userdata('photo');?>" class="img-profile-header-navbar">
        <i class="fa fa-caret-down" style="color:gray"></i>
      </button>
      <div class="dropdown-content">
        <p style="font-size:14px;padding:5px;line-height:1.1;margin-bottom:0px;border-bottom:1px solid silver;">
          <span title="<?php echo $this->session->userdata('name');?>"><?php echo strlen($this->session->userdata('name')) > 20 ? substr($this->session->userdata('name'), 0, 20).'...' : $this->session->userdata('name');?></span><br>
          <small><?php echo $this->session->userdata('email');?></small>
        </p>
        <?php
          $menus=$this->ConfigModel->getMenus('TOP_ICON',NULL);
          foreach($menus as $menu){
            $highlighted=($menu->link==current_url() || $menu->link.'/'==current_url())?TRUE:FALSE;
        ?>
            <a href="<?php echo $menu->link;?>"><?php echo $this->LanguageModel->getWording($menu->id);?></a>
        <?php } ?>
      </div>
    </div>
  </div>
<?php
  }else{
?>
  <a href="<?php echo base_url();?>login?redirect_link=<?php echo current_url();?>">
    <button type="button" class="btn btn-sm btn-primary" style="font-size:0.780rem;background-color:#e65540;border-color:#e65540">Masuk</button>
  </a>
  <span class="linedivide1" style="margin-left:10px;margin-right:10px"></span>
  <a href="<?php echo base_url();?>register">
    <button type="button" class="btn btn-sm btn-primary" style="font-size:0.780rem;background-color:#FFFFFF;border:1px solid #e65540;color:#e65540">Daftar</button>
  </a>
<?php } ?>
