<?
namespace mrssoft\globalstate;

interface GlobalStateInterface
{
    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function get($name, $default = null);

    /**
     * @param string $name
     * @param mixed $value
     */
    public function set($name, $value);
}