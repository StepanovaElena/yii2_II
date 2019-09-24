<?php


namespace common\behaviors;


use common\models\Projects;
use yii\base\Behavior;

class ProjectTitleBehavior extends Behavior
{
    public $attribute;

    public function events()
    {
        return [
            //Controller::EVENT_BEFORE_ACTION => ' '
        ];
    }

    public function getTitle(){
        $id = $this->owner->{$this->attribute};
        $project = Projects::findOne(['id' => $id]);

        return $project->title;
    }
}