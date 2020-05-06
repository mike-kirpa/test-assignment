<?php

namespace tests;

use app\models;

/**
 * UserTest contains test cases for user model
 * 
 * IMPORTANT NOTE:
 * All test cases down below must be implemented
 * You can add new test cases on your own
 * If they could be helpful in any form
 */
class UserTest extends \Codeception\Test\Unit
{
    /**
     * Test case for adding repo models to user model
     * 
     * IMPORTANT NOTE:
     * Should cover succeeded and failed suites
     *
     * @return void
     */
    public function testAddingRepos()
    {
        $user = new models\User('identifier', 'name', 'github');
        $githubRepo = new models\GithubRepo('reponame', 1, 2, 3);
        $user->addRepos([$githubRepo]);

        if($user->getData()['repo'][0]['name'] == 'reponame'
            &&$user->getData()['repo'][0]['fork-count'] == 1
            &&$user->getData()['repo'][0]['star-count'] == 2
            &&$user->getData()['repo'][0]['watcher-count'] == 3
            &&$user->getData()['repo'][0]['rating'] == 2
            ){
                $result = TRUE;
        }
        else {
            $result = FALSE;
        }
        $this->assertTrue($result);
    }

    /**
     * Test case for counting total user rating
     *
     * @return void
     */
    public function testTotalRatingCount()
    {
        $user = new models\User('identifier', 'name', 'github');
        $githubRepo = new models\GithubRepo('reponame1', 1, 2, 3);
        $gitlabRepo = new models\GitlabRepo('reponame1', 1, 2);
        $user->addRepos([$githubRepo, $gitlabRepo]);
        $actual = $user->getTotalRating();
        $expected = 3.5;
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test case for user model data serialization
     *
     * @return void
     */
    public function testData()
    {
        $user = new models\User('identifier', 'name', 'github');
        $actual = $user->getData();
        $expected = [
            'name' => 'name',
            'platform' => 'github',
            'total-rating' => 0,
            'repos' => []
        ];
        if($actual['name'] == 'name'
            &&$actual['platform'] == 'github'
            &&$actual['total-rating'] == 0
            &&$actual['repos'] == []
            ){
                $result = TRUE;
        }
        else {
            $result = FALSE;
        }
        $this->assertTrue($result);
    }

    /**
     * Test case for user model __toString verification
     *
     * @return void
     */
    public function testStringify()
    {
        $I = new models\User('identifier', 'name', 'github');
//        $githubRepo = new models\GithubRepo('reponame1', 1, 2, 3);
//        $I->addRepos([$githubRepo]);

        $expected = sprintf(
            "%-75s %19d 🏆\n%'=98s\n",
            'name (github)',
            0,
            ""
//            'reponame1',
//            "\n"
        );
        $this->assertEquals($expected, $I);
    }
}