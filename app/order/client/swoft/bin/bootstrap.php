<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require dirname(__DIR__) . '/vendor/autoload.php';

echo "获取的命令".$argv[$argc - 1]."\n";

$retCall = " ";

// php bin/swoft rpc:start ext_init=-t:tcp?-i:172.200.7.110?-p:18317
if ($extInitCalls = strstr($argv[$argc - 1],'ext_init')) {
    $initCalls = (explode('=',$extInitCalls))[1];
    if ($calls = strstr($initCalls,'?')) {
        $calls = explode('?',$initCalls);
        foreach ($calls as $call) {
            $retCall .= str_replace(":"," ",$call)." ";
        }
    } else {
        $retCall .= str_replace(":"," ",$initCalls)." ";
    }
}
exec('sh /init.sh'.$retCall);
// $loader->addPsr4('Swoft\\Cache\\', 'vendor/swoft/cache/src/');
