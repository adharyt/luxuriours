

		<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12" style="margin-top:-16px;background-color:#f3f3f3">
			<div class="row d-flex" style="margin-left:0px;margin-top:20px;margin-bottom:10px;padding-left:15px;padding-right:15px;">
				<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
					<span class="fas fa-user-alt"></span>
				</div>
				<div class="ml-3 mt-2 p-0 h-100 align-middle header_account_title">
					<h3>Change Password</h3>
				</div>
			</div>

			<div class="card profile-settings-password-container" style="border-radius:8px">
					 <div class="col-6 profile-settings-password-form-container">
							 <div class="form-group m-0 mb-3 p-0">
									 <label class="profile-settings-password-text" for="old-password">Masukkan Kata Sandi Lama kamu</label>
									 <input   type="password" class="form-control form-control-bordered" id="old_password" placeholder="">
									 <div class="profile-settings-password-warning-text" id="validate_old_password" style="display:none;"></div>
							 </div>
							 <div class="form-group m-0 mb-3 p-0">
									 <label class="profile-settings-password-text" for="old-password">Masukkan Kata Sandi Baru kamu</label>
									 <input   type="password" class="form-control form-control-bordered" id="new_password" placeholder="">
									 <div class="profile-settings-password-warning-text" id="validate_password" style="display:none;"></div>
							 </div>
							 <div class="form-group m-0 mb-3 p-0">
									 <label class="profile-settings-password-text" for="old-password">Konfirmasi Kata Sandi Baru kamu</label>
									 <input   type="password" class="form-control form-control-bordered" id="new_password_confirm" placeholder="">
									 <div class="profile-settings-password-warning-text" id="validate_rpassword" style="display:none;"></div>
							 </div>
							 <div class="button-konfirmasi-password" onClick="pass_change__update();">
									 Simpan Perubahan
							 </div>
					 </div>
					 <a class="col">
							 <img class="profile-settings-password-image" src="<?php echo $this->ConfigModel->getAppInfo('PATH__ASSETS_SHARED').'/images/graphic-img/account__reset_password__success.png';?>" alt="">
					 </a>
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
