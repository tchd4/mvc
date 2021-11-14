<?php


namespace App\Core;



class Collection implements \App\Core\Interfaces\Collection
{
    private $items = [];
    public function __construct( array $data = [])
    {
        $this->items = $data;
    }

    /**
     * @inheritDoc
     */
    function make(): object
    {
        $this->items = !is_array($this->items) ? $this->items : current($this->items);
        return $this;
    }

    /**
     * @inheritDoc
     */
    function collections(): Array
    {
        return is_array($this->items) ? $this->items : current($this->items);
    }

    /**
     * @inheritDoc
     */
    function toArray(): Array
    {
        return (Array)$this->items;
    }


    public function all() : array
    {
        return $this->items;
    }

    public function toJson(): string
    {
        return json_encode($this->items);
    }

    public function first():?object
    {
        return current($this->items) ?? NULL;
    }

    public function last():?object
    {
        return $this->first(array_reverse($this->items)) ?? NULL;
    }

    public function only(array|string $keys) :? array
    {
        return array_intersect_key($this->items, array_flip((array)$keys));
    }
}