<?php
namespace Seguce92\DomPDF;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class Facade extends IlluminateFacade {

    /**
     * [getFacadeAccessor description]
     * @method getFacadeAccessor
     * @return [Strin]            [string]
     */
    protected static function getFacadeAccessor() { return 'dompdf.wrapper'; }

    /**
     * Resolve a new Instance
     * [__callStatic description]
     * @method __callStatic
     * @param  [type]       $method [description]
     * @param  [type]       $args   [description]
     * @return [type]               [description]
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::$app->make(static::getFacadeAccessor());

        switch (count($args))
        {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            case 2:
                return $instance->$method($args[0], $args[1]);

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);

            default:
                return call_user_func_array(array($instance, $method), $args);
        }
    }


}
