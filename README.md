yii2-globalstate
===========================

Save and load global data

Install
-------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist mrssoft/yii2-globalstate "dev-master"
```

or add

```json
"mrssoft/yii2-globalstate": "dev-master"
```

to the require section of your composer.json


Usage
-----

Add to you config:
```php
'components' => [
	'globalstate' => [
		'class' => 'mrssoft\globalstate\GlobalStateFile',
        'path' => '@runtime', // Path for save data (optional)
        'filename' => 'globalstate.bin' //Filename (optional)
	], 
]    
```

Get value:
```php
$value = Yii::$app->globalstate->get('key');

//or

$value = Yii::$app->globalstate->get('key', $default);
```

Set value:
```php
Yii::$app->globalstate->set('key', $value);
```

