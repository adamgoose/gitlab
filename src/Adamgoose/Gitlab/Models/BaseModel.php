<?php namespace Adamgoose\Gitlab\Models;

use Str;
use ReflectionMethod;
use Adamgoose\Gitlab\Client;
use Illuminate\Support\Contracts\JsonableInterface;
use Illuminate\Support\Contracts\ArrayableInterface;

abstract class BaseModel extends Client implements JsonableInterface, ArrayableInterface {

  /**
   * Model Attributes
   * @var array
   */
  protected $attributes;

  /**
   * Parent Model
   * @var BaseModel
   */
  protected $parent;

  /**
   * @param array     $attributes Model Attributes
   * @param BaseModel $parent     Parent Model
   */
  public function __construct(array $attributes, $parent = null)
  {
    $this->attributes = $attributes;
    $this->parent = $parent;
  }

  /**
   * Lookup by ID
   * @param  int       $id ID of desired model
   * @return BaseModel     Model Instance
   */
  public static function find($id)
  {
    $model = 'Adamgoose\Gitlab\Models\\'.class_basename(get_called_class());

    return new $model(with(new Client)->fetch($model::$path.$id));
  }

  /**
   * Get Parent
   * @return BaseModel Parent Model
   */
  public function getParent()
  {
    return $this->parent;
  }

  /**
   * Dynamically Get Attributes
   * @param  string $property Desired Attribute
   * @return mixed
   */
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

  /**
   * Cast Attributes to JSON
   * @param  integer $options Options
   * @return string           JSON Encoded Model
   */
  public function toJson($options = 0)
  {
    return json_encode($this->attributes, $options);
  }

  /**
   * Cast Attributes to String (JSON)
   * @return string JSON Encoded Model
   */
  public function __toString()
  {
    return $this->toJson();
  }

  /**
   * Cast Attributes to Array
   * @return array Attributes
   */
  public function toArray()
  {
    return $this->attributes;
  }

}