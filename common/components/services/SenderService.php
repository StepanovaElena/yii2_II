<?php


namespace common\components\services;


use common\components\sender\Sender;
use yii\mail\MailerInterface;

class SenderService implements Sender
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

    public function sendEmail($params)
    {
        $this->mailer->compose()
                ->setSubject('Вам добавлена роль')
                ->setFrom('stepanova_eg@bk.ru')
                ->setTo('stepanova_eg@bk.ru')
                ->send();
    }
}