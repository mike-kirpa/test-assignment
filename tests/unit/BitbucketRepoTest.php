<?php

namespace tests;

use app\models;

/**
 * BitbucketRepoTest contains test cases for bitbucket repo model
 * 
 * IMPORTANT NOTE:
 * All test cases down below must be implemented
 * You can add new test cases on your own
 * If they could be helpful in any form
 */
class BitbucketRepoTest extends \Codeception\Test\Unit
{
    /**
     * Test case for counting repo rating
     *
     * @return void
     */
    public function testRatingCount()
    {
        $I = new models\BitbucketRepo('user', 1, 2);
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
        $I = new models\BitbucketRepo('user', 1, 2);
        $actual = $I->getData();
        if($actual['name'] == 'user'
            &&$actual['fork-count'] == 1
            &&$actual['watcher-count'] == 2
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
        $I = new models\BitbucketRepo('user', 1, 2);
        $expected = sprintf(
            "%-75s %4d ⇅ %6s %4d 👁️",
            'user',
            1,
            "",
            2);
        $this->assertEquals($expected, $I);
    }
}