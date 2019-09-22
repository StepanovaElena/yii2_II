<?php namespace frontend\tests\unit\models;

use common\fixtures\TasksFixture;
use common\models\Tasks;

class TaskTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'task' => [
                'class' => TasksFixture::className(),
                'dataFile' => codecept_data_dir() . 'task.php'
            ]
        ]);
    }

    public function testCreate()
    {
        $model = new Tasks();
        $model->setAttributes([
            'title' => 'заголовок',
            'description' => 'описание',
            'executor_id' => 1,
            'started_at' => '2019-08-12',
            'completed_at' => '2019-08-12',
            'created_by' => 1,
            'updated_by' => '',
            'updated_at' => '',
            'project_id' => 1
        ]);

        expect_that($model->save());
    }

    public function testCreateEmptyFormSubmit()
    {
        $model = new Tasks();
        expect_not($model->validate());
        expect_not($model->save());
    }

    public function testDelete()
    {
        $taskFixture = $this->tester->grabFixture('task', 0);
        $model = Tasks::findOne(['executor_id' => $taskFixture['executor_id']]);
        expect_that($model !==  null);
        expect_that($model->delete());
    }

    public function testUpdate()
    {
        $taskFixture = $this->tester->grabFixture('task', 0);
        $model = Tasks::findOne(['executor_id' => $taskFixture['executor_id']]);
        expect_that($model !== null);
        $model->description = 'new description';
        expect_that($model->save());
        $updatedTask = Tasks::findOne(['description' => 'new description']);
        expect_that($updatedTask !== null);
    }
    // tests
    protected function _after()
    {
    }
}