<?php

namespace Psr\Container;

/**
 * Describes the interface of a container that exposes methods to read its entries.
 */
interface ContainerInterface
{
    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id);

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id);
}

/**
 * Base interface representing a generic exception in a container.
 */
interface ContainerExceptionInterface
{
}

interface NotFoundExceptionInterface extends ContainerExceptionInterface
{
}


class DIContainer
{




}


//var_dump(array_values(array_intersect_key($array1, array_flip($array2))));

function getSillArray(array $map, array $key){
    $newArray = [];
    foreach ($key as $k){

        if($map[$k]){
            $newArray[] = $map[$k];
        }
        else{
            throw new Exception("Нету такого ключа {$k}");
        };

    }
    return $newArray;
}

///var_dump(getSillArray($array1,$array2));

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

class  Xuy{

}
class Aazzzz{}
class Basas{}
class  Pizda{
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
    public function __construct(Xuy $as, Dzigurda $asd, TesaAndy $sasda, Pizda $sad )
    {
    }
}


$arrayContainer = [];

function reflectionRecur(string $classsR, array &$arr){


    $reflClasss = new ReflectionClass($classsR);
    // Проверяем есть ли конструткор. Если нету то Создаем класс
   if ($reflClasss->hasMethod('__construct')){
        /// Получаем все методы констрктора
        $allConstructMethod = $reflClasss->getMethod('__construct')->getParameters();

        // Если пустой конструктор создаем класс. Базовый случай рекурсии.
        if(empty($allConstructMethod)){
            $arr["{$classsR}"] = $reflClasss->newInstanceArgs();
            return;

        }

       $AllTypeHintClass = [];
        /// Проверяем только классы. Откидываем скаляры.
       foreach ($allConstructMethod as $vs){
           if ($vs->getClass()){
               /// Заполняем массив со всеми Хинтами. string
               $AllTypeHintClass[] = ($vs->getClass()->name);

               /// Проверяем есть ли созданный обьект в Массиве $arrayContainer

               /// Если не --> уход в рекурсию
               if(!array_key_exists($vs->getClass()->name, $arr)){
                   reflectionRecur($vs->getClass()->name,$arr);
               }

           }
       }

       $arrayForNewInstanseArgs = getSillArray($arr,$AllTypeHintClass);

       $arr["{$classsR}"] = $reflClasss->newInstanceArgs($arrayForNewInstanseArgs);

   } else{
       /// Создаем экземляр и помещаем его в arrayContainer
       $arr["{$classsR}"] = $reflClasss->newInstanceArgs();
       return;

   }

}

(reflectionRecur('ReflTest',$arrayContainer));
var_dump($arrayContainer['ReflTest']);

