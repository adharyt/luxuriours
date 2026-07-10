<style media="screen">
/* Dropdown button */
.dropdown .dropbtn {
border: none;
outline: none;
color: #009245;
background-color: inherit;
font-family: inherit; /* Important for vertical align on mobile phones */
margin: 0; /* Important for vertical align on mobile phones */
}

/* Dropdown content (hidden by default) */
.dropdown-content {
display: none;
position: absolute;
background-color: #f9f9f9;
min-width: 200px;
right:0px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
font-size:12px;
float: none;
color: #009245;
padding: 3px 5px;
text-decoration: none;
display: block;
text-align: left;
}

/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
background-color: #f28f16;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
display: block;
}

</style>

<!-- Header -->
<header class="header2">
  <!-- Header desktop -->
  <div class="container-menu-header-v2 p-t-26">
    <div class="topbar2">
      <div class="topbar-social rs1-select2">
        <?php $this->load->view('template/app_page/page_commerce/__widget/_language_selector');?>
      </div>

      <!-- Logo2 -->
      <a href="<?php echo base_url();?>" class="logo2">
        <img src="<?php echo $this->ConfigModel->getAppInfo('LOGO');?>" alt="IMG-LOGO">
      </a>

      <div class="topbar-child2">
        <?php $this->load->view('template/app_page/page_commerce/__widget/_wrap_icon');?>
      </div>
    </div>


  </div>

  <!-- Header Mobile -->
  <div class="wrap_header_mobile">
    <!-- Logo moblie -->
    <a href="<?php echo base_url();?>" class="logo-mobile">
      <img src="<?php echo $this->ConfigModel->getAppInfo('LOGO');?>" alt="IMG-LOGO">
    </a>

    <!-- Button show menu -->
    <div class="btn-show-menu">
      <!-- Header Icon mobile -->
      <div class="header-icons-mobile">
        <?php $this->load->view('template/app_page/page_commerce/__widget/_wrap_icon');?>
      </div>

      <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </div>
    </div>
  </div>

  <!-- Menu Mobile -->
  <div class="wrap-side-menu" >
    <?php $this->load->view('template/app_page/page_commerce/_profile/_mobile_menu');?>
  </div>
</header>
