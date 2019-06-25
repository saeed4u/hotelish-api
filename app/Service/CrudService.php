<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 23:55
 */

namespace App\Service;


use App\Repo\Repo;
use App\Utils\ApiResponse;
use App\Utils\Logging;

abstract class CrudService
{
    use ApiResponse, Logging;
    /**
     * @var Repo $repo
     */
    protected $repo;

    /**
     * CrudService constructor.
     * @param Repo $repo
     */
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }


}