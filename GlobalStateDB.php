<?
namespace mrssoft\globalstate;

use yii\base\Component;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class GlobalStateDB extends Component implements GlobalStateInterface
{
    public $tableName = '{{%globalstate}}';

    public $fieldName = 'name';

    public $fieldValue = 'value';

    private $_data = null;

    public function get($name = null, $default = null)
    {
        $this->read();
        if ($name === null) {
            return $this->_data;
        }
        if (array_key_exists($name, $this->_data)) {
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
            $this->write($this->_data);
        } else {
            $this->_data[$name] = $value;
            $this->write([$name => $value]);
        }
    }

    private function read()
    {
        if ($this->_data === null) {
            $query = (new Query())->from($this->tableName)->all();
            $this->_data = ArrayHelper::map($query, $this->fieldName, $this->fieldValue);
        }
    }

    private function write($data)
    {
        foreach ($data as $name => $value) {
            \Yii::$app->db->createCommand()->update(
                $this->tableName,
                [$this->fieldValue => $value],
                [$this->fieldName => $name]
            )->execute();
        }
    }
}