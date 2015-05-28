<?php

    namespace app\models;

    class RegistrationForm extends \dektrium\user\models\RegistrationForm
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
            $rules[] = ['verifyCode', 'required'];
            $rules[] = ['verifyCode', 'captcha', 'captchaAction'=>'/dice/captcha'];
            $rules[] = ['passwordConfirm', 'compare', 'compareAttribute' => 'password', 'message'=>'Passwords must match.'];
            return $rules;
        }
        
        public function attributeLabels() {
          $labels = parent::attributeLabels();
          $labels['passwordConfirm'] = 'Confirm Password';
          $labels['verifyCode'] = 'Verify code';
          return $labels;
        }
    }