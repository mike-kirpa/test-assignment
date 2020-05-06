<?php

namespace tests;

use app\models;

/**
 * GithubRepoTest contains test cases for github repo model
 * 
 * IMPORTANT NOTE:
 * All test cases down below must be implemented
 * You can add new test cases on your own
 * If they could be helpful in any form
 */
class GithubRepoTest extends \Codeception\Test\Unit
{
    /**
     * Test case for counting repo rating
     *
     * @return void
     */
    public function testRatingCount()
    {
        $I = new models\GithubRepo('user', 1, 2, 3);
        $actual =  $I->getRating();
        $this->assertEquals(2, $actual);
    }

    /**
     * Test case for repo model data serialization
     *
     * @return void
     */
    public function testData()
    {
        $I = new models\GithubRepo('user', 1, 2, 3);
        $actual = $I->getData();
        if($actual['name'] == 'user'
            &&$actual['fork-count'] == 1
            &&$actual['star-count'] == 2
            &&$actual['watcher-count'] == 3
            &&$actual['rating'] == 2) {
                $result = TRUE;
            }
        else {
            $result = FALSE;
        }

        $this->assertTrue($result);
    }

    /**
     * Test case for repo model __toString verification
     *
     * @return void
     */
    public function testStringify()
    {
        $I = new models\GithubRepo('user', 1, 2, 3);
        $expected = sprintf(
            "%-75s %4d ⇅ %4d ★ %4d 👁️",
            'user',
            1,
            2,
            3);
        $this->assertEquals($expected, $I);
    }
}