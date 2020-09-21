<?php

namespace App\Expansion;
use Swoft\Consul\Agent as Base;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Consul\Consul;
use Swoft\Consul\Response;

/**
 * Class Agent
 *
 * @Bean()
 */
class Agent extends Base {

    /**
     * @Inject()
     *
     * @var Consul
     */
    private $consul;


    public function getService($serverName): Response
    {
        return $this->consul->get('/v1/health/service/'.$serverName);
    }
}
