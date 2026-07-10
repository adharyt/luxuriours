<select class="selection-1" name="time" style="width:165px!important">
  <?php
    $languages=$this->LanguageModel->getLanguage();
    foreach($languages as $language){
  ?>
    <option value="<?php echo $language->id;?>" <?php if($language->id==getSessionLanguage()){echo "selected";}?>><?php echo $language->language;?></option>
  <?php } ?>
</select>
