

		<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12" style="margin-top:-16px;background-color:#f3f3f3">
			<div class="row d-flex" style="margin-left:0px;margin-top:20px;margin-bottom:10px;padding-left:15px;padding-right:15px;">
				<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
					<span class="fas fa-user-alt"></span>
				</div>
				<div class="ml-3 mt-2 p-0 h-100 align-middle header_account_title">
					<h3>Bank Account</h3>
				</div>
			</div>
			<div class="card p-2 profile-summary-card-container" style="border-radius:8px">
				<div class="body">
					<div class="row info-user-container">
						<div class="col-lg-2">
								<img src="<?php echo $this->session->userdata('photo');?>" alt="Photo Profile" class="img-thumbnail profile_img-profile">
						</div>
						<div class="col-lg-6 col-md-6">
								<div class="align-middle" style="margin-top:20px">
									<div class="name-text"><?php echo $this->session->userdata('name');?></div>
									<p class="email-text" style="margin-bottom:0px"><?php echo $this->session->userdata('email');?></p>
									<p class="email-text" style="margin-bottom:5px"><?php echo $this->session->userdata('phone');?></p>
									<a href="<?php echo base_url()."my-account/profile/edit";?>">
										<button class="btn btn-success btn-sm" style="cursor:pointer;background-color:#009245">Edit Profil</button>
									</a>
								</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="favorite-container" style="margin-top:20px; margin-left:-15px">
								<div class="favorite-title-text">Favorit</div>
								<a href="<phpecho base_url();?>my-account/wishlist">
									<div class="favorite-item-container">
										<div class="favorite-text">Barang Favorit</div>
										<div class="favorite-text"><phpecho $count['wishlist'];?></div>
									</div>
								</a>
								<a data-toggle="modal" data-target="#addCategoryModal" style="cursor:pointer">
									<div class="favorite-item-container">
										<div class="favorite-text">Toko Favorit</div>
										<div class="favorite-text"><phpecho $count['favstore'];?></div>
									</div>
								</a>
							</div>
						</div>
					</div>
					<h4>Transaksi</h4>
					<div class="row card summary-container" style="justify-content:center">
						<div class="profile-summary-item col" style="margin-top:10px; margin-bottom:10px;justify-content:center">
							<a href="<phpecho base_url();?>my-account/transaction?showUnpaid=true&showPaid=false&showExpired=false" class="profile-summary-item-content">
								<i class="fas fa-receipt icon-profile-summary"></i>
								<div class="icon-desc-text">Tagihan<br>Pembayaran</div>
							</a>
							<span class="badge badge-pill badge-danger notif-icon"><phpecho $transUnpaid;?></span>
						</div>


						<div class="profile-summary-item col" style="margin-top:10px; margin-bottom:10px;justify-content:center">
							<a href="<phpecho base_url();?>my-account/transaction-split?showPending=true&showProcess=true&showSent=true&showDelivered=true&showSuccess=false&showDecline=false&showComplain=false" class="profile-summary-item-content">
								<i class="fas fa-sync-alt icon-profile-summary"></i>
								<div class="icon-desc-text">Transaksi <br> Ongoing</div>
							</a>
							<span class="badge badge-pill badge-danger notif-icon"><phpecho $transProcess;?></span>
						</div>


						<div class="col profile-summary-item" style="margin-top:10px; margin-bottom:10px;justify-content:center">
							<a href="<phpecho base_url();?>my-account/transaction-split?showPending=false&showProcess=false&showSent=false&showDelivered=false&showSuccess=false&showDecline=false&showComplain=true" class="profile-summary-item-content">
								<i class="fas fa-comments icon-profile-summary"></i>
								<div class="icon-desc-text">Diskusi <br> Komplain</div>
							</a>
							<span class="badge badge-pill badge-danger notif-icon"><phpecho $transComplain;?></span>
						</div>


						<div class="profile-summary-item col" style="margin-top:10px; margin-bottom:10px;justify-content:center">
							<a href="<phpecho base_url();?>my-account/transaction-split?showPending=false&showProcess=false&showSent=false&showDelivered=false&showSuccess=true&showDecline=false&showComplain=false" class="profile-summary-item-content">
								<i class="fas fa-check-circle icon-profile-summary"></i>
								<div class="icon-desc-text">Transaksi <br> Sukses</div>
							</a>
							<span class="badge badge-pill badge-danger notif-icon"><phpecho $transSuccess;?></span>
						</div>

						<div class="profile-summary-item col" style="margin-top:10px; margin-bottom:10px;justify-content:center">
							<a href="<phpecho base_url();?>my-account/transaction-split?showPending=false&showProcess=false&showSent=false&showDelivered=false&showSuccess=false&showDecline=true&showComplain=false" class="profile-summary-item-content">
								<i class="fas fa-times-circle icon-profile-summary"></i>
								<div class="icon-desc-text">Transaksi <br> Batal</div>
							</a>
							<span class="badge badge-pill badge-danger notif-icon"><phpecho $transFailed;?></span>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="row mt-3">
				<div class="col" style="margin-bottom:10px">

					<div class="card">

						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-6">
									<div class="row">
										<div class="col-6">
											<h1><phpecho $transUnpaid;?></h1>
											<p>Tagihan</p>
										</div>
										<div class="col-6">
											<h1>0</h1>
											<p>Diskusi Retur</p>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col-4">
											<h1><phpecho $transProcess;?></h1>
											<p>On Process</p>
										</div>
										<div class="col-4">
											<h1><phpecho $transSuccess;?></h1>
											<p>Transaksi Sukses</p>
										</div>
										<div class="col-4">
											<h1><phpecho $transFailed;?></h1>
											<p>Transaksi Batal</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<!-- <div class="row mt-3">
				<div class="col-md-6">
					<div class="row">
						<div class="col-12" style="margin-bottom:10px">
							<div class="card">
								<div class="card-header" style="background-color:#009245;color:white">
									<h4>Uang Digital</h4>
								</div>
								<div class="card-body">
									<div class="d-flex justify-content-between">
										<p><img src="<phpecho base_url();?>assets/images/icon-img/money.png" alt="Icon Cash" class="mr-2 icon-sack">Kredit STIL</p>
										<p><phpecho $this->currencyModel->integerToCurrency('rupiah',$userMoney);?></p>
									</div>
									Lihat History | Cairkan Uang
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header" style="background-color:#009245;color:white">
							<h4>Favorit</h4>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<p>Barang Favorit</p>
								<a href="<phpecho base_url();?>my-account/wishlist">
									<p><phpecho $count['wishlist'];?></p>
								</a>
							</div>
							<div class="d-flex justify-content-between">
								<p>Toko Favorit</p>
								<a data-toggle="modal" data-target="#addCategoryModal" style="cursor:pointer">
									<p><phpecho $count['favstore'];?></p>
								</a>
							</div>
						</div>
					</div> -->
					<!--
					<div class="card mt-2">
						<div class="card-header" style="background-color:#009245;color:white">
							<h4>Newsletter</h4>
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<p>Status Berlangganan</p>
								<style media="screen">
								.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open>.dropdown-toggle.btn-default {
									color: #333;
									background-color: #e6e6e6;
									border-color: #adadad;
								}
								.btn-default:active, .btn-default.active, .open>.dropdown-toggle.btn-default {
								    background-image: none;
								}
								.btn-default {
								    color: #333;
								    background-color: #fff;
								    border-color: #ccc;
								}
								.toggle-group,.toggle-on,.toggle-off{
									cursor:pointer
								}
								</style>
								<input <phpif($is_subscribe==1){echo "checked";}?> id="newsletterstatus" type="checkbox"  data-toggle="toggle" data-on="Berlangganan	" data-off="Tidak Berlangganan" data-onstyle="success" data-offstyle="danger">
							</div>
						</div>
					</div>-->
					<br>
				</div>
        <div class="col-md-1" style="background-color:#f3f3f3;margin-top:-16px">
        </div>
			</div>
		</div>
