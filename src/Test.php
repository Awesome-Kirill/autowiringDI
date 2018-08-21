<?php
/**
 * Created by PhpStorm.
 * User: awd
 * Date: 21.08.18
 * Time: 13:00
 */

namespace AutowiringDI;


use Psr\Container\ContainerInterface;



class Test implements ContainerInterface{


    public $container = [];

    private function getArguments(array $map, array $key):array {
        $newArray = [];
        foreach ($key as $k){

            if($map[$k]){
                $newArray[] = $map[$k];
            }
            else{
                throw new ContainerException("not key: {$k}");
            };

        }
        return $newArray;
    }



    private function makeService(string $classR, array &$arr){
        $reflClasss = new \ReflectionClass($classR);
        if ($reflClasss->hasMethod('__construct')){
            $allConstructMethod = $reflClasss->getMethod('__construct')->getParameters();
            if(empty($allConstructMethod)){
                $arr["{$classR}"] = $reflClasss->newInstanceArgs();
                return;
            }

            $AllTypeHintClass = [];

            foreach ($allConstructMethod as $vs){
                if ($vs->getClass()){
                        $AllTypeHintClass[] = ($vs->getClass()->name);

                        if(!array_key_exists($vs->getClass()->name, $arr)){
                            $this->makeService($vs->getClass()->name,$arr);
                            }
                }
            }

            $arrayForNewInstanseArgs = $this->getArguments($arr,$AllTypeHintClass);

            $arr["{$classR}"] = $reflClasss->newInstanceArgs($arrayForNewInstanseArgs);

        } else{
            $arr["{$classR}"] = $reflClasss->newInstanceArgs();
            return;
        }
    }

    public function make(string $cls){
        $this->makeService($cls,$this->container);
        return $this->container["{$cls}"];
    }
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
    public function get($id)
    {
        if(!(bool)$this->container["{$id}"]){
           throw new NotFoundException('Service not found');
        }

        return $this->container["{$id}"];
    }

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
    public function has($id)
    {
        // TODO: Implement has() method.
        return (bool)$this->container["{$id}"];
    }
}