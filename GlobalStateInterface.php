<?php

namespace mrssoft\globalstate;

interface GlobalStateInterface
{
    /**
     * @param string|null $name
     * @param null $default
     * @return mixed
     */
    public function get($name = null, $default = null);

    /**
     * @param string|array $name
     * @param mixed|null $value
     */
    public function set($name, $value = null);
}