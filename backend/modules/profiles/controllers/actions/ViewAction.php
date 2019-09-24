<?php


namespace backend\modules\profiles\controllers\actions;


use backend\modules\profiles\services\contracts\ProfileService;
use yii\base\Action;

class ViewAction extends Action
{
    /** @var ProfileService */
    private $service;

    public function __construct($id, $module, ProfileService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function run($uuid)
    {
        $profile = $this->service->getProfileByUuid($uuid);
        $projects = $this->service->findUserProjects($profile->id);
        $count = count($projects);
        //$active = $profileComponent->findActiveProjects();
        //$tasks = $profileComponent->findUserTasks();

        return $this->controller->render('view', [
            'profile' => $profile,
            'count' => $count
        ]);
    }
}