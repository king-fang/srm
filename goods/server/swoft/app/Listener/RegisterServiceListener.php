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
     * @Config("consul.consul_server")
     */
    protected $serverName;
    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event): void
    {
        $httpServer = $event->getTarget();
        // 监听的当前服务健康的变量
        $srmConsulCheckType = env('SRM_CONSUL_CHECK_TYPE');
        $srmConsulCheckPort = env('SRM_CONSUL_CHECK_PORT');
        $srmConsulCheckIp = env('SRM_CONSUL_CHECK_IP');
        $service = [
            'ID'                => getSrmConsulServerId($this->serverName),
            'Name'              => $this->serverName,
            'Tags'              => [
                'rpc'
            ],
            'Address'           => env('SRM_HOST'),
            'Port'              => $httpServer->getPort(),
            'Meta'              => [
                'version' => '1.0'
            ],
            'EnableTagOverride' => false,
            'Weights'           => [
                'Passing' => 10,
                'Warning' => 1
            ],
            'Check' => [
                'name' => 'srm.goods.server',
                $srmConsulCheckType => "{$srmConsulCheckIp}:$srmConsulCheckPort",
                'interval' => '10s',  // consul 每隔10s检测
                'timeout' => '2s'   // 2秒超时
            ]
        ];
        // Register
        $this->agent->registerService($service);
        CLog::info('Swoft http register service success by consul!');
    }
}
