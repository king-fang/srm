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
 * @Controller(prefix="goods")
 */
class GoodsController
{
    /**
     * @Reference(pool="goods.pool")
     *
     * @var GoodsInterface
     */
    private $goodsService;

    /**
     * @RequestMapping("list")
     *
     * @param Response $response
     * @return Response
     */
    public function getList(Response $response): Response
    {
        $result  = $this->goodsService->getList(12, 'type');
        $ip = '客户端IP:'.env('SRM_HOST');
        $response = $response->withContent('<html lang="en"><h1>'.$ip.'</h1> <h1>'.$result['list'].'</h1></html>');
        $response = $response->withContentType(ContentType::HTML);
        return $response;
    }
}
