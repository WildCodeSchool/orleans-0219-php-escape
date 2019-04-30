<?php


namespace App\Model;

class MissionManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'missions';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
