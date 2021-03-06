<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

function user_func(): string
{
    return 'hello';
}

/**
 * 获取Server 名称
 * @param $serverName
 * @return string
 */
function getSrmConsulServerId($serverName) {
    $host = explode('.',env('SRM_HOST'));
    return $serverName.'_'.$host[0].'_'.$host[3];
}
