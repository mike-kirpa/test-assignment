<?php

namespace tests;

use app\components;

/**
 * FactoryTest contains test cases for factory component
 * 
 * IMPORTANT NOTE:
 * All test cases down below must be implemented
 * You can add new test cases on your own
 * If they could be helpful in any form
 */
class FactoryTest extends \Codeception\Test\Unit
{
    /**
     * Test case for creating platform component
     * 
     * IMPORTANT NOTE:
     * Should cover succeeded and failed suites
     *
     * @return void
     */
    public function testCreate()
    {
        $actual = \Yii::$app->factory->create('github');
        $this->assertTrue($actual instanceof components\platforms\Github);
    }
}