<?php

namespace Cart\Support\Storage\Contracts;

interface StorageInterface{
    public function set($index, $value);

    public function get($index);

    public function all();

    public function exists($index);

    public function un_set($index);

    public function clear();

    public function count();
}