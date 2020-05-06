<?php

namespace app\models;

use \yii\base;

use app\interfaces;

/**
 * GithubRepo implementation of interfaces\Repo
 */
class GithubRepo extends base\Model implements interfaces\IRepo
{
    /**
     * GithubRepo ctor
     *
     * @param string $name
     * @param int $forkCount
     * @param int $starCount
     * @param int $watcherCount
     */
    public function __construct($name, $forkCount, $starCount, $watcherCount)
    {
        $this->name = $name;
        $this->forkCount = $forkCount;
        $this->starCount = $starCount;
        $this->watcherCount = $watcherCount;
    }

    /**
     * @inheritDoc
     */
    public function __toString() : string
    {
        return sprintf(
            "%-75s %4d ⇅ %4d ★ %4d 👁️",
            $this->name,
            $this->forkCount,
            $this->starCount,
            $this->watcherCount
        );
    }

    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getForkCount() : int
    {
        return $this->forkCount;
    }

    /**
     * @inheritDoc
     */
    public function getStarCount() : int
    {
        return $this->starCount;
    }

    /**
     * @inheritDoc
     */
    public function getWatcherCount() : int
    {
        return $this->watcherCount;
    }

    /**
     * @inheritDoc
     */
    public function getRating() : float
    {
        return (($this->forkCount * 2.0) + ($this->starCount / 2.0) + $this->watcherCount) / 3.0;
    }

    /**
     * @inheritDoc
     */
    public function getData() : array
    {
        return [
            'name' => $this->name,
            'fork-count' => $this->forkCount,
            'star-count' => $this->starCount,
            'watcher-count' => $this->watcherCount,
            'rating' => $this->rating,
        ];
    }

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $forkCount;

    /**
     * @var int
     */
    private $starCount;

    /**
     * @var int
     */
    private $watcherCount;
}
