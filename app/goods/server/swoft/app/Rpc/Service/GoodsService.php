<?php declare(strict_types=1);

namespace App\Rpc\Service;

use App\Rpc\Lib\GoodsInterface;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class GoodsService
 * @since 2.0
 *
 * @Service()
 */
class GoodsService implements GoodsInterface {

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
}
