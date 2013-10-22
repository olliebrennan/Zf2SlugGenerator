<?php

namespace Zf2SlugGenerator\Entity;

class Result
{
    /**
     * @var integer $count
     */
    protected $count;

    /**
     * @return the $count
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param number $count
     */
    public function setCount($count)
    {
        $this->count = (int)$count;
    }
}
