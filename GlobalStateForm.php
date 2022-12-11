<?php

namespace mrssoft\globalstate;

class GlobalStateForm extends \yii\base\Model
{
    /**
     * @var GlobalStateInterface
     */
    public $globalstate;

    private $_data = [];

    public function init()
    {
        if (empty($this->globalstate)) {
            $this->globalstate = \Yii::$app->globalstate;
        }

        $this->_data = $this->globalstate->get();
        $this->setAttributes($this->_data);
    }

    public function rules()
    {
        return [
            [$this->attributes(), 'string', 'max' => 255],
            [$this->attributes(), 'filter', 'filter' => 'trim']
        ];
    }

    public function attributes()
    {
        static $attributes = null;
        if ($attributes === null) {
            $attributes = array_keys($this->globalstate->get());
        }
        return $attributes;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }
        return null;
    }

    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

    public function save()
    {
        $this->globalstate->set($this->_data);
    }
}