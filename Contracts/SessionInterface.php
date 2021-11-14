<?php

namespace App\Contracts;


/**
 * Interface SessionInterface
 */
interface SessionInterface
{
    /**
     * @return mixed
     */
    public static function start();
    /**
     * @param string $key
     * @return mixed
     */
    public static function get(string $key);

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public static function set(string $key, $value): self;

    /**
     * @param string $key
     */
    public static function remove(string $key): void;

    /**
     *
     */
    public static function clear(): void;

    /**
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool;
}