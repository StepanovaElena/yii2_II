<?php

namespace api\models;


use common\models\ProjectsBase;

class Projects extends ProjectsBase
{
    //перечень полей для отображения
    public function fields()
    {
        return [
            'id',
            'title',
            'created_at' => function ($model) {
                return \Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y');
            },
            'composite' => function ($model) {
                return $model->created_by . '/' . $model->updated_by;
            }
        ];
    }

    public function extraFields()
    {
        return [
            'created_by' => function($model){
                return ;
            }
        ];
    }
}
