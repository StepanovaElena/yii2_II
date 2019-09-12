<?php namespace frontend\tests\functional;
use common\fixtures\TasksFixture;
use frontend\tests\FunctionalTester;

class TaskCest
{
    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'task' => [
                'class' => TasksFixture::className(),
                'dataFile' => codecept_data_dir() . 'task.php'
            ]
        ]);
    }

    public function testView(FunctionalTester $I)
    {
        $I->amOnPage('/task/view?id=2');
        $I->see('Title', 'h1');
    }

    public function testCreate(FunctionalTester $I)
    {
        $I->amOnPage('/task/create');
        $I->see('Create Tasks','h1');
        $I->submitForm('tasks-form', [
            'Post[title]' => 'Post Create Title',
            'Post[description]' => 'Post Create Text',
            'Post[started_at]' => '2019-08-12',
        ]);
        $I->expectTo('see view page');
        $I->see('Post Create Title', 'h1');
    }
}
