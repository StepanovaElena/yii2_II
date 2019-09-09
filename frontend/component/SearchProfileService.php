<?php


namespace frontend\component;


use yii\helpers\ArrayHelper;

class SearchProfileService
{
    private $storage;

    public function _construct(ProfileStorage $storage)
    {
        $this->storage = $storage;
    }

    public function searchProfileName($name)
    {
        $name = $this->storage->find($name);
        return mb_strtoupper($name, 'utf-8');
    }
}