<?php
declare(strict_types=1);

namespace App\Rpc\Lib;

interface GoodsInterface {

    /**
     * @param int   $id
     * @param mixed $type
     * @param int   $count
     *
     * @return array
     */
    public function getList(int $id, $type, int $count = 10): array;
}
