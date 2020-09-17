<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Listener;

use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Consul\Agent;
use Swoft\Consul\KV;
use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Http\Server\HttpServer;
use Swoft\Server\SwooleEvent;
use Swoft\Config\Annotation\Mapping\Config;
/**
 * Class DeregisterServiceListener
 *
 * @since 2.0
 *
 * @Listener(SwooleEvent::SHUTDOWN)
 */
class DeregisterServiceListener implements EventHandlerInterface
{
    /**
     * @Inject()
     *
     * @var Agent
     */
    private $agent;

    /**
     * @Config("consul.consul_server")
     */
    protected $serverName;


    /**
     * @Inject()
     *
     * @var KV
     */
    private $kv;
    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event): void
    {
//        $httpServer = $event->getTarget();

        $socket = env('SRM_CONSUL_CHECK_IP').':'.env('SRM_CONSUL_CHECK_PORT');
        // 商品客户端注册
        $this->kv->delete('/upstreams/'.$this->serverName.'/'.$socket);
//        $this->agent->deregisterService(getSrmConsulServerId($this->serverName));
    }
}
