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

use Swoft\Config\Annotation\Mapping\Config;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Consul\Agent;
use Swoft\Consul\KV;
use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Http\Server\HttpServer;
use Swoft\Log\Helper\CLog;
use Swoft\Server\SwooleEvent;

/**
 * Class RegisterServiceListener
 *
 * @since 2.0
 *
 * @Listener(event=SwooleEvent::START)
 */
class RegisterServiceListener implements EventHandlerInterface
{
    /**
     * @Inject()
     *
     * @var Agent
     */
    private $agent;

    /**
     * @Inject()
     *
     * @var KV
     */
    private $kv;
    /**
     * @Config("consul.consul_server")
     */
    protected $serverName;
    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event): void
    {
        $socket = env('SRM_CONSUL_CHECK_IP').':'.env('SRM_CONSUL_CHECK_PORT');
        // 商品客户端注册
        $this->kv->put('/upstreams/'.$this->serverName.'/'.$socket,'{"weight":1, "max_fails":2, "fail_timeout":10}');
    }
}
