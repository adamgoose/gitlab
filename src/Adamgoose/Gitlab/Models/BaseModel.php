<?php namespace Adamgoose\Gitlab\Models;

use Str;
use Adamgoose\Gitlab\Client;
use ReflectionMethod;
use Illuminate\Support\Contracts\JsonableInterface;
use Illuminate\Support\Contracts\ArrayableInterface;

abstract class BaseModel extends Client implements JsonableInterface, ArrayableInterface {

  protected $attributes;

  protected $parent;

  public function __construct(array $attributes, $parent = null)
  {
    $this->attributes = $attributes;
    $this->parent = $parent;
  }

  public static function find($id)
  {
    $model = 'Adamgoose\Gitlab\Models\\'.class_basename(get_called_class());

    return new $model(with(new Client)->fetch($model::$path.$id));
  }

  public function getParent()
  {
    return $this->parent;
  }

  public function __get($property)
  {
    if(method_exists($this, $property)) {
      $method = new ReflectionMethod(get_called_class(), $property);
      if($method->getNumberOfParameters() == 0)
        return call_user_func([$this, $property]);
    }

    if(array_key_exists($property, $this->attributes))
      return $this->attributes[$property];

    return null;
  }

  public function toJson($options = 0)
  {
    return json_encode($this->attributes, $options);
  }

  public function __toString()
  {
    return $this->toJson();
  }

  public function toArray()
  {
    return $this->attributes;
  }

}