<?php


namespace common\components\sender;


interface Sender
{
    public function sendEmail($params);
}