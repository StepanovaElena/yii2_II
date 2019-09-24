<?php

namespace common\rules;

use common\models\Participants;
use common\models\Projects;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\rbac\Rule;

class OwnerProjectRule extends Rule
{
    public $name = 'ownerProjectRule';

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
        /** @var Projects $projects */
        $projects = ArrayHelper::getValue($params, 'projects');

        if (!$projects) {
            throw new \Exception('Need projects param in rule');
        }

        /** @var Participants $participants */
        $participants = ArrayHelper::getValue($params, 'participants');

        foreach ($participants as $person) {
            if ($user == $person->user_id)
                return true;
        }

        return $user == $projects->created_by;
    }
}