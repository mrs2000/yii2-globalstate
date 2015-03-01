<?
namespace mrssoft\globalstate;

use yii\base\Component;

class GlobalStateFile extends Component implements GlobalStateInterface
{
    public $filename = 'globalstate.bin';

    public $path = '@runtime';

    private $_data = null;

    public function get($name = null, $default = null)
    {
        $this->read();
        if ($name === null) {
            return $this->_data;
        }
        if (array_key_exists($name, $this->_data))
        {
            return $this->_data[$name];
        }
        return $default;
    }

    public function set($name, $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                $this->_data[$key] = $value;
            }
        } else {
            $this->_data[$name] = $value;
        }
        return $this->write();
    }

    private function read()
    {
        if ($this->_data === null) {
            $path = $this->getPath();
            $this->_data = [];
            if (is_file($path) && ($this->_data = file_get_contents($path)))
            {
                $this->_data = unserialize($this->_data);
            }
        }
    }

    private function write()
    {
        if (empty($this->_data))
        {
            $this->_data = [];
        }
        return (bool)file_put_contents($this->getPath(), serialize($this->_data));
    }

    private function getPath()
    {
        return \Yii::getAlias($this->path).DIRECTORY_SEPARATOR.$this->filename;
    }
}