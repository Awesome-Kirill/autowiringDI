<?php
/**
 * Created by PhpStorm.
 * User: awd
 * Date: 21.08.18
 * Time: 12:56
 */

require_once __DIR__ . '/vendor/autoload.php';

class Test{}

class  Sopl{

    public function __construct(Aazzzz $sa, Basas $t)
    {
    }

}
class Andy{
    public function __construct(Sopl $sa, Test $t)
    {
    }
}

class  Buzz{

}
class Aazzzz{}
class Basas{}
class  Fuz{
    public function __construct(Andy $andy)
    {
    }

}

class ACAD{
    public function __construct(Basas $sss)
    {
    }
}
class  Dzigurda{
    public function __construct(ACAD $sss, Test $asw)
    {
    }

}

class TesaAndy{
    public function __construct()
    {

    }

}
class ReflTest
{
    public function __construct(Buzz $as, Dzigurda $asd, TesaAndy $sasda, Fuz $sad )
    {
    }
}


$tests = new AutowiringDI\Test();
$object = $tests->make('ReflTest');

var_dump($tests->get('ReflTest'));