
		<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12" style="margin-top:-16px;background-color:#f3f3f3">
			<div class="row d-flex" style="margin-left:0px;margin-top:20px;margin-bottom:10px;padding-left:15px;padding-right:15px;">
				<div class="p-0 h-100 align-middle" style="margin-top: 0.8rem">
					<span class="fas fa-user-alt"></span>
				</div>
				<div class="ml-3 mt-2 p-0 h-100 align-middle header_account_title">
					<h3><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__TITLE');?></h3>
				</div>
			</div>
			<div class="card p-2 profile-summary-card-container" style="border-radius:8px">
				<div class="row">
					<div class="col-3">
						<div class="card p-0 bg-light" style="width:100%;background-color:white!important">
  							<div class="card-body d-flex flex-column text-center">
  								<center>
  									<img id="currentpic" src="<?php echo $userdata->photo;?>" alt="Photo Profile" class="img-thumbnail img-profile" style="border:0px;">
  									<br><br>
  									<label for="upload_image" class="btn btn-light mt-2" style="border-color: #009245;cursor:pointer"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__UPDATE_PROFILE_PICTURE');?></label>
  									<input type="file" name="upload_image" id="upload_image" accept="image/*" style="opacity:0;position:absolute;z-index: -1;">
  								</center>
  							</div>
  					</div>
					</div>
					<div class="col-9">
						<form class="form-group">
							<div class="row">
								<fieldset class="form-group col-lg-9">
									<label for="nama-label"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_NAME');?></label>
									<input readonly type="text" class="form-control form-control-bordered text-dark" id="name" value="<?php echo $userdata->name;?>" style="background-color:#E8E8E8">
									<div id="validate_name" style="color:red;font-style:oblique"></div>
								</fieldset>
							</div>

							<div class="row">
								<fieldset class="form-group col-lg-9 mt-2" id="datetimepicker3">
									<label for="date-label"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_BIRTHDATE');?></label>
									<input readonly type='date' placeholder="dd/mm/yyyy" value="<?php echo $userdata->birthdate;?>" class="form-control form-control-bordered text-dark" id="date-label" style="background-color:#E8E8E8"/>
								</fieldset>
							</div>

							<div class="row">
								<fieldset class="form-group col-lg-9 mt-2" >
									<label for="jeniskelamin-label" style="margin-left: 10px"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_GENDER');?></label>
									<select disabled class="form-control form-control-bordered text-dark" id="jeniskelamin-label" style="background-color:#E8E8E8">
										<option value="M" <?php if($userdata->gender=="M"){echo "selected";}?>><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_GENDER__MALE');?></option>
										<option value="F" <?php if($userdata->gender=="F"){echo "selected";}?>><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_GENDER__FEMALE');?></option>
									</select>
									<span></span>
								</fieldset>
							</div>


							<div class="row">
								<fieldset class="form-group col-lg-9 mt-2">
									<label for="email-label"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_EMAIL');?></label>
									<input readonly type="email" class="form-control form-control-bordered bg-white text-dark" value="<?php echo $userdata->email;?>" style="background-color:#E8E8E8 !important">
								</fieldset>
								<div class="align-self-end pb-3	mb-1">
									<?php if(!is_null($userdata->validated_email_at)){ ?>
										<span class="badge badge-pill bg-success text-white mt-3 p-2">
											<span class="fas fa-check mr-1"></span>
											<?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_BADGE__VERIFIED');?>
										</span>
									<?php }else{ ?>
										<span class="badge badge-pill bg-secondary text-white mt-3 p-2">
											<span class="fas fa-exclamation-circle mr-1"></span>
											<?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_BADGE__NOT_VERIFIED');?>
										</span>
									<?php } ?>
								</div>
							</div>

							<div class="row">
								<fieldset class="form-group col-lg-9 mt-2">
									<label for="telp-label"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_PHONE');?></label>
									<input  readonly type="number" class="form-control form-control-bordered  text-dark" id="phone"  pattern="[0-9]" value="<?php echo $userdata->phone;?>" style="background-color:#E8E8E8">
									<div id="validate_phone" style="color:red;font-style:oblique"></div>
								</fieldset>
							</div>

							<div class="row">
								<fieldset class="form-group col-lg-9">
									<label for="nama-label">Username</label>
									<input readonly type="text" class="form-control form-control-bordered text-dark" value="<?php echo $this->session->userdata('username');?>" style="background-color:#E8E8E8">
								</fieldset>
							</div>


							<div class="row">
								<div class="col-lg-9 mt-2 d-flex justify-content-end">
									<div class="btn btn-success" id="btnEdit" onClick="editProfile();" style="cursor:pointer;"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_BUTTON_EDIT');?></div>
									<div class="btn btn-secondary" id="btnCancel" onClick="location.reload();" style="display:none;cursor:pointer;"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_BUTTON_EDIT_CANCEL');?></div>&nbsp;
									<div class="btn btn-success" id="btnSave" onClick="saveProfile();" style="display:none;cursor:pointer;"><?php echo $this->LanguageModel->getWording('_PAGE__GLOBAL__USER_PROFILE_EDIT__FORM_BUTTON_EDIT_SUBMIT');?></div>

								</div>
							</div>
						</form>
					</div>
				</div>
				<div id="uploadimageModal" class="modal" role="dialog" style="z-index:1060">
				 <div class="modal-dialog">
				  <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				        </div>
				        <div class="modal-body">
				          <div class="row">
							       <div class="col-md-12 text-center">
							        <div id="image_to_crop" style="width:100%; margin-top:5px;height:auto"></div>
											<br>
											<button class="btn btn-success" id="crop_and_upload">Crop & Upload Image</button>
							       </div>
				    			</div>
				       </div>

				     </div>
				    </div>
				</div>

			</div>

					<br>
				</div>
        <div class="col-md-1" style="background-color:#f3f3f3;margin-top:-16px">
        </div>
			</div>
		</div>
