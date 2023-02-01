<?php

namespace app\mail;

use Yii;

class Mail{

    public function sendMail($email, $password, $model){
        Yii::$app->mailer->compose()
            ->setFrom('admin@email.com')
            ->setTo($email)
            ->setSubject('Signup | Verification')
            ->setTextBody('
        
                Hello. Your user account has been created successfully. You will receive an email with a link and your login credentials once your account has been activated by the Technical Team.
                Kind regards and God bless.

            ')
            ->send();
    }
    
    public function sendActivationMail($email, $password, $model){
        Yii::$app->mailer->compose()
            ->setFrom('admin@email.com')
            ->setTo($email)
            ->setSubject('Notification: Account Activated.')
            ->setTextBody('
        
                Hello. Your user account has been activated successfully. You may login with the following credentials and fill in your personal and family profile.
                ----------------------
                Username: '.$email.'
                Password: '.$password.'
                ----------------------
                Please click the link below to login to your account. Remember to change your password to a more secure password in your settings.
                http:41.72.98.88/unisda/web
                Kind regards and God bless.

            ')
            ->send();
    }
}
?>