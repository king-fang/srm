<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Http\Controller;

use App\Rpc\Lib\GoodsInterface;
use App\Rpc\Lib\OrderInterface;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Rpc\Client\Annotation\Mapping\Reference;
use Swoft\Http\Message\Response;
use Swoft\Http\Message\ContentType;
/**
 * Class GoodsController
 *
 * @since 2.0
 *
 * @Controller(prefix="order")
 */
class OrderController
{
    /**
     * @Reference(pool="order.pool")
     *
     * @var OrderInterface
     */
    private $orderService;

    /**
     * @RequestMapping("create")
     *
     * @param Response $response
     * @return Response
     */
    public function create(Response $response): Response
    {
        $result  = $this->orderService->createOrder();
        $ip = '客户端IP:'.env('SRM_HOST');
        $result['ip'] = $ip;
        $response = $response->withContent($result);
        $response = $response->withContentType(ContentType::JSON);
        return $response;
    }
}
