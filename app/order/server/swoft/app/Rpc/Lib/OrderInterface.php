<?php
declare(strict_types=1);

namespace App\Rpc\Lib;

/**
 * Interface OrderInterface
 *
 * @since 2.0
 */
interface OrderInterface {

    /**
     * @param int   $id
     * @param mixed $type
     * @param int   $count
     *
     * @return array
     */
    public function getList(int $id, $type, int $count = 10): array;


    /**
     * @return array
     */
    public function createOrder(): array;
}
