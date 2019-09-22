<?php namespace frontend\tests\models;

use common\fixtures\ProjectsFixture;
use common\models\Projects;
use common\models\Tasks;

class ProjectTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->tester->haveFixtures([
            'project' => [
                'class' => ProjectsFixture::className(),
                'dataFile' => codecept_data_dir() . 'project.php'
            ]
        ]);
    }

    public function testCreate()
    {
        $model = new Projects(
            [
                'id' => 1,
                'title' => 'Title',
                'description' => 'Description',
                'created_by' => 1,
                'created_at' => '2019-09-18',
                'updated_by' => 1,
                'updated_at' => '2019-09-18',
                'status' => 1,
            ]
        );

        expect('model should validate', $model->validate())->true();
        //expect($model->save());
    }

    //public function testUpdate()
    //{
    //    $projectFixture = $this->tester->grabFixture('project', 0);
    //    $model = Projects::findOne(['id' => $projectFixture['id']]);
    //    expect_that($model !== null);
    //    $model->description = 'new description';
    //    expect_that($model->updateAttributes(['description']));
    //    $updatedProject = Projects::findOne(['description' => 'new description']);
    //    expect_that($updatedProject !== null);
    //}

    protected function _after()
    {
    }

}