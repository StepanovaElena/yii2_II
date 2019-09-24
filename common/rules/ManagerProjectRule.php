<?php

namespace common\rules;

use common\models\Participants;
use common\models\Projects;
use common\models\Tasks;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\rbac\Rule;

class ManagerProjectRule extends Rule
{
    public $name = 'MangerProjectRule';

    /**
     * Executes the rule.
     *
     * @param string|int $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return bool a value indicating whether the rule permits the auth item it is associated with.
     * @throws \Exception
     */
    public function execute($user, $item, $params)
    {
        /** @var Tasks $tasks */
        $tasks = ArrayHelper::getValue($params, 'tasks');
        if (!$tasks) {
            throw new \Exception('Need tasks param in rule');
        }

        /** @var Participants $participants */
        $participants = Participants::find()->andWhere(['project_id' => $tasks->project_id])->all();

        foreach ($participants as $person) {
            if ($person->user_id == $user &&  $person->role == 'manager') {
                return true;
            }
        }
        return false;
    }
}