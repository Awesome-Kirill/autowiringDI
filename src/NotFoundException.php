<?php
/**
 * Created by PhpStorm.
 * User: awd
 * Date: 22.08.18
 * Time: 0:59
 */

namespace AutowiringDI;
use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends \Exception implements NotFoundExceptionInterface
{

}

