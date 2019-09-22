<?php


namespace backend\modules\profiles\services\logger;


use common\components\logger\Logger;
use yii\mail\MailerInterface;

class LoggerProfile implements Logger
{
    /** @var MailerInterface */
    public $mailer;

    /**
     * LoggerProfile constructor.
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function log($txt)
    {
        $this->mailer->compose()
            ->setSubject('Создание профиля пользователя')
            ->setFrom('stepanova_eg@bk.ru')
            ->setTo('stepanova_eg@bk.ru')
            ->send();
    }
}