<?php

namespace api\models;




use common\models\TasksBase;

class Tasks extends TasksBase
{
    public function fields()
    {
        return ['id', 'title'];
    }
}
