<?php
namespace App\Mailer;


class UserMailer extends Mailer
{
    public function welcome($user)
    {
        $subject = '欢迎您注册本商城,请点击验证邮箱';
        $view = 'register';
        $data = ['%user%' => [$user->name],'%url%' => [env('APP_URL').'/user/'.$user->id.'/'.$user->emailToken]];
        $this->sendTo($user, $subject, $view, $data);
    }
}