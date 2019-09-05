<?php namespace frontend\tests;

use frontend\component\ProfileStorage;
use frontend\component\SearchProfileService;

class SearchProfileTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function testSomeFeature()
    {
        $storage = $this->getMockBuilder(ProfileStorage::class)
        ->setMethods(['find'])->getMock();

        $storage->expects($this->once())->method('find')->with('Sergey')->willReturn('Ivanov');

        $searcher = new SearchProfileService($storage);
        $name = $searcher->searchProfileName('Sergey');
        expect($name)->notNull();
        expect($name)->equals('IVANOV');
    }

    protected function _before()
    {
    }

    // tests

    protected function _after()
    {
    }
}