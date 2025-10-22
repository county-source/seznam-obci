<?php
declare(strict_types=1);

namespace App\Core;

use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;

final class RouterFactory
{
    public static function createRouter(): RouteList
    {
        $r = new RouteList;
        $r->addRoute('/', 'Kraj:default');
        $r->addRoute('/kraje', 'Kraj:default');
        $r->addRoute('/okresy', 'Okres:default');
        $r->addRoute('/obce', 'Obec:default');

        // dočasný fallback, ať je hned vidět, že router žije:
        $r->addRoute('<presenter>/<action>[/<id>]', 'Kraj:default');
        return $r;
    }
}
