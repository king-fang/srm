<?php declare(strict_types=1);

namespace App\Rpc\Service;

use App\Rpc\Lib\GoodsInterface;
use App\Rpc\Lib\OrderInterface;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class OrderService
 * @since 2.0
 *
 * @Service()
 */
class OrderService implements OrderInterface {

    /**
     * @param int   $id
     * @param mixed $type
     * @param int   $count
     *
     * @return array
     */
    public function getList(int $id, $type, int $count = 10) :array {
        return [
            'list' => '这是里商品服务:'.env('SRM_HOST')
        ];
    }

    public function createOrder(): array
    {
        // 这里是创建订单的逻辑
        return [
            'code' => 200,
            'msg' => '创建成功'
        ];
    }
}
