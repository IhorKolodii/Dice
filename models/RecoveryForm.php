<?php

    namespace app\models;

    class RecoveryForm extends \dektrium\user\models\RecoveryForm
    {
        /**
         * @var string
         */
        public $verifyCode;
        public $passwordConfirm;
        /**
         * @inheritdoc
         */
        public function rules()
        {
            $rules = parent::rules();
            $rules['captchaRequired'] = ['verifyCode', 'required'];
            $rules['captcha'] = ['verifyCode', 'captcha', 'captchaAction'=>'/dice/captcha'];
            $rules['passwordConfirm'] = ['passwordConfirm', 'compare', 'compareAttribute' => 'password', 'message'=>'Passwords must match.'];
            return $rules;
        }
        
        public function scenarios()
            {
                return [
                    'request' => ['email', 'verifyCode'],
                    'reset'   => ['password', 'passwordConfirm']
                ];
            }
        
        public function attributeLabels() {
          $labels = parent::attributeLabels();
          $labels['passwordConfirm'] = 'Confirm Password';
          $labels['verifyCode'] = 'Verify code';
          return $labels;
        }
    }