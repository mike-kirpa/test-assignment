<?php

/**
 * Base contains test cases for testing api endpoint
 * 
 * @see https://codeception.com/docs/modules/Yii2
 * 
 * IMPORTANT NOTE:
 * All test cases down below must be implemented
 * You can add new test cases on your own
 * If they could be helpful in any form
 */
class BaseCest
{
 
    /**
     * Example test case
     *
     * @return void
     */
 
     public function cestExample(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [
                'kfr'
            ],
            'platforms' => [
                'github'
            ]
        ]);
        $expected = json_decode('[
            {
                "name": "kfr",
                "platform": "github",
                "total-rating": 1.5,
                "repos": [],
                "repo": [
                    {
                        "name": "kf-cli",
                        "fork-count": 0,
                        "star-count": 2,
                        "watcher-count": 2,
                        "rating": 1
                    },
                    {
                        "name": "cards",
                        "fork-count": 0,
                        "star-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "UdaciCards",
                        "fork-count": 0,
                        "star-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "unikgen",
                        "fork-count": 0,
                        "star-count": 1,
                        "watcher-count": 1,
                        "rating": 0.5
                    }
                ]
            }
        ]');
        $I->assertEquals($expected, json_decode($I->grabPageSource()));
    }

    /**
     * Test case for api with bad request params
     *
     * @return void
     */

     public function cestBadParams(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'xyz' => [
                'kfr'
            ],
            'platforms' => [
                'github'
            ]
        ]);

        $expected = '<pre>Bad Request: Missing required parameters: users</pre>';

        $I->seeResponseCodeIs(400);
        $I->assertEquals($expected, $I->grabPageSource());
    }

    /**
     * Test case for api with empty user list
     *
     * @return void
     */

     public function cestEmptyUsers(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [

            ],
            'platforms' => [
                'github',
            ]
        ]);

        $expected = '<pre>Bad Request: Missing required parameters: users</pre>';

        $I->seeResponseCodeIs(400);
        $I->assertEquals($expected, $I->grabPageSource());
    }

    /**
     * Test case for api with empty platform list
     *
     * @return void
     */
 
     public function cestEmptyPlatforms(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [
                'kfr'
            ],
            'platforms' => [

            ]
        ]);

        $expected = '<pre>Bad Request: Missing required parameters: platforms</pre>';

        $I->seeResponseCodeIs(400);
        $I->assertEquals($expected, $I->grabPageSource());
    }

    /**
     * Test case for api with non empty platform list
     *
     * @return void
     */
 
     public function cestSeveralPlatforms(\FunctionalTester $I)
    {
         $I->amOnPage([
            'base/api',
            'users' => [
                'kfr'
            ],
            'platforms' => [
                'github'
            ]
        ]);

        $expected = json_decode('[
            {
                "name": "kfr",
                "platform": "github",
                "total-rating": 1.5,
                "repos": [],
                "repo": [
                    {
                        "name": "kf-cli",
                        "fork-count": 0,
                        "star-count": 2,
                        "watcher-count": 2,
                        "rating": 1
                    },
                    {
                        "name": "cards",
                        "fork-count": 0,
                        "star-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "UdaciCards",
                        "fork-count": 0,
                        "star-count": 0,
                        "watcher-count": 0,
                        "rating": 0
                    },
                    {
                        "name": "unikgen",
                        "fork-count": 0,
                        "star-count": 1,
                        "watcher-count": 1,
                        "rating": 0.5
                    }
                ]
            }
        ]');
        $I->seeResponseCodeIs(200);
        $I->assertEquals($expected, json_decode($I->grabPageSource()));
    }

    /**
     * Test case for api with non empty user list
     *
     * @return void
     */
 
     public function cestSeveralUsers(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [
                'test'
            ],
            'platforms' => [
                'github'
            ]
        ]);

        $expected = json_decode('[
            {
                "name": "test",
                "platform": "github",
                "total-rating": 20.333333333333332,
                "repos": [],
                "repo": [
                    {
                        "name": "HelloWorld",
                        "fork-count": 18,
                        "star-count": 3,
                        "watcher-count": 3,
                        "rating": 13.5
                    },
                    {
                        "name": "SDWebImage",
                        "fork-count": 3,
                        "star-count": 1,
                        "watcher-count": 1,
                        "rating": 2.5
                    },
                    {
                        "name": "rokehan",
                        "fork-count": 2,
                        "star-count": 0,
                        "watcher-count": 0,
                        "rating": 1.3333333333333333
                    },
                    {
                        "name": "Test--01",
                        "fork-count": 3,
                        "star-count": 0,
                        "watcher-count": 0,
                        "rating": 2
                    },
                    {
                        "name": "sNews",
                        "fork-count": 0,
                        "star-count": 2,
                        "watcher-count": 2,
                        "rating": 1
                    }
                ]
            }
        ]');
        $I->seeResponseCodeIs(200);
        $I->assertEquals($expected, json_decode($I->grabPageSource()));
    }

    /**
     * Test case for api with unknown platform in list
     *
     * @return void
     */
 
     public function cestUnknownPlatforms(\FunctionalTester $I)
    {
        try {
            $I->amOnPage([
                'base/api',
                'users' => [
                    'kfr'
                ],
                'platforms' => [
                    'xyz'
                ]
            ]);
        } catch (Exception $e) {
            codecept_debug(get_class($e));
            $I->assertTrue(get_class($e) == 'LogicException', 'exception class LogicException');
        }
}

    /**
     * Test case for api with unknown user in list
     *
     * @return void
     */
 
     public function cestUnknownUsers(\FunctionalTester $I)
    {
        try {
            $I->amOnPage([
                'base/api',
                'users' => [
                    'fdsgfghgytryrt'
                ],
                'platforms' => [
                    'github'
                ]
            ]);
        } catch (Exception $e) {
            codecept_debug(get_class($e));
            $I->assertTrue(get_class($e) == 'LogicException', 'exception class LogicException');
        }
    }

    /**
     * Test case for api with mixed (unknown, real) users and non empty platform list
     *
     * @return void
     */
 
     public function cestMixedUsers(\FunctionalTester $I)
    {
        try {
            $I->amOnPage([
                'base/api',
                'users' => [
                    'test','fdsgfghgytryrt'
                ],
                'platforms' => [
                    'github'
                ]
            ]);
        } catch (Exception $e) {
            codecept_debug(get_class($e));
            $I->assertTrue(get_class($e) == 'LogicException', 'exception class LogicException');
        }    }

    /**
     * Test case for api with mixed (github, gitlab, bitbucket) platforms and non empty user list
     *
     * @return void
     */
 
     public function cestMixedPlatforms(\FunctionalTester $I)
    {
        $I->amOnPage([
            'base/api',
            'users' => [
                'mike-kirpa'
            ],
            'platforms' => [
                'github',
                'gitlab',
                'bitbucket'
            ]
        ]);

        $expected = [];
        $I->seeResponseCodeIs(200);
        $I->assertNotEquals($expected, json_decode($I->grabPageSource()));
    }
    
}