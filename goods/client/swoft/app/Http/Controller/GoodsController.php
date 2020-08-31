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
     * @return array
     */
    public function getList(): array
    {
        $result  = $this->goodsService->getList(12, 'type');
        return [
            'client_ip' => env('SRM_HOST'),
            'list' => $result['list']
        ];
    }
}
