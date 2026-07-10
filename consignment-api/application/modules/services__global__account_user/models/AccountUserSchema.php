<?php
 class AccountUserSchema extends CI_Model {

   function __construct(){
     $this->load->helper($this->config->item('helpers_ext').'regex');
   }

   public function checkName($value){
     if(strlen($value)>=1){
       if(regex_accountUser_validateName($value)){
         $response=(object)array(
            "message"  =>  "OK",
            "data"     =>  NULL
         );
       }else{
         $response=(object)array(
            "message"  =>  "INVALID_FORMAT__NAME",
            "data" => (object)array(
              "text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_NAME__INVALID')
            )
        );
       }
     }else{
       $response=(object)array(
          "message"  => "BLANK__NAME",
          "data" => (object)array(
            "text"  => $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_NAME__BLANK')
          )
       );
     }
     return $response;
   }

   public function checkUsername($value){
       $this->load->model('AuthenticationModel');
       $this->load->model('UserModel');
       if(strlen($value)>=1){
         if(regex_accountUser_validateUsername($value)){
           $c_duplicate_username1 = $this->AuthenticationModel->checkUsername($value);
           $c_duplicate_username2 = $this->UserModel->checkUsername($value);
           if(is_null($c_duplicate_username1) && is_null($c_duplicate_username2)){
               $response=(object)array(
                  "message"  =>  "OK",
                  "data"     =>  NULL
               );
           }else{
               $response=(object)array(
                  "message"  =>  "DUPLICATE__USERNAME",
                  "data" => (object)array(
                    "text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_USERNAME__DUPLICATE')
                  )
               );
           }
         }else{
           $response=(object)array(
              "message"  =>  "INVALID_FORMAT__USERNAME",
              "data" => (object)array(
                "text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_USERNAME__INVALID')
              )
           );
         }
       }else{
         $response=(object)array(
            "message"  => "BLANK__USERNAME",
            "data" => (object)array(
              "text"  => $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_USERNAME__BLANK')
            )
         );
       }

       return $response;
    }

    public function checkPhone($value,$username){
        $this->load->model('UserModel');
        if(strlen($value)>=1){
          if(regex_accountUser_validatePhone($value)){
            $c_duplicate_phone = $this->UserModel->checkPhone($value,$username);
            if(is_null($c_duplicate_phone)){
                $response=(object)array(
                   "message"  =>  "OK",
                   "data"     =>  NULL
                );
            }else{
                $response=(object)array(
                   "message"  =>  "DUPLICATE__PHONE_NUMBER",
                   "data" => (object)array(
                     "text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_PHONE__DUPLICATE')
                   )
                );
            }
          }else{
            $response=(object)array(
               "message"  =>  "INVALID_FORMAT__PHONE_NUMBER",
               "data" => (object)array(
                 "text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_PHONE__INVALID')
               )
            );
          }
        }else{
          $response=(object)array(
             "message"  => "BLANK__PHONE_NUMBER",
             "data" => (object)array(
               "text"  => $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_PHONE__BLANK')
             )
          );
        }

        return $response;
     }

     public function checkEmail($value,$username){
         $this->load->model('UserModel');
         if(strlen($value)>=1){
           if(regex_accountUser_validateEmail($value)){
             $c_duplicate_email = $this->UserModel->checkEmail($value,$username);
             if(is_null($c_duplicate_email)){
                 $response=(object)array(
                    "message"  =>  "OK",
                    "data"     =>  NULL
                 );
             }else{
                 $response=(object)array(
                    "message"  =>  "DUPLICATE__EMAIL",
                    "data" => (object)array(
                      "text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_EMAIL__DUPLICATE')
                    )
                 );
             }
           }else{
             $response=(object)array(
                "message"  =>  "INVALID_FORMAT__EMAIL",
                "data" => (object)array(
                  "text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_EMAIL__INVALID')
                )
             );
           }
         }else{
           $response=(object)array(
              "message"  => "BLANK__EMAIL",
              "data" => (object)array(
                "text"  => $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_EMAIL__BLANK')
              )
           );
         }

         return $response;
      }

      public function checkPassword($value){
          if(strlen($value)>=1){
            if(regex_accountUser_validatePassword($value)){
              $response=(object)array(
                 "message"  =>  "OK",
                 "data"     =>  NULL
              );
            }else{
              $response=(object)array(
                 "message"  =>  "INVALID_FORMAT__PASSWORD",
                 "data" => (object)array(
                   "text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_PASSWORD__INVALID')
                 )
              );
            }
          }else{
            $response=(object)array(
               "message"  => "BLANK__PASSWORD",
               "data" => (object)array(
                 "text"  => $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_PASSWORD__BLANK')
               )
            );
          }

          return $response;
       }

       public function checkGender($value){
           if($value=='M' || $value=='F'){
             return strtoupper($value);
           }else{
             return 'M';
           }
        }

        public function checkBirthdate($value){
            if(datetime_validate($value,'Y-m-d')==TRUE){
              return $value;
            }else{
              return '2021-01-01';
            }
         }

         public function checkPasswordDB($username,$password){
             $this->load->model('AuthenticationModel');
             $accountCredential=$this->AuthenticationModel->getAccountCredentials($username);
             $db_salt=$accountCredential->salt;
             $db_passwd=$accountCredential->password;

             //HASH PASSWORD
             $this->load->helper('cryptmgr');
             $password_to_verify=crypt_hashPassword($password,$db_salt,$hash=FALSE);

             if(password_verify($password_to_verify,$db_passwd)){
               $response=(object)array(
                 "message" => "OK",
                 "data"    => (object)array(
                   "text"  =>  $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_PASSWORD_DB__MATCH')
                 )
               );
             }else{
               $response=(object)array(
                 "message" => "WRONG_PASSWORD",
                 "data"    => (object)array(
                   "text"  => $this->LanguageModel->getWording('_RESPONSE__GLOBAL__ACCOUNT_USER__CHECK_PASSWORD_DB__NOT_MATCH')
                 )
               );
             }
             return $response;
          }

}

?>
