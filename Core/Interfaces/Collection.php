<?php


namespace App\Core\Interfaces;


interface Collection
{
    /**
     * @return object
     */
     function make() : object;

    /**
     * @return array
     */
    function collections() : array;

    /**
     * @return Array
     */
    function toArray():Array;

    function all(): array;

    function toJson() : string;

    function first() :?object;

    function last() :?object;

    function only(array|string $keys) :?array;
}