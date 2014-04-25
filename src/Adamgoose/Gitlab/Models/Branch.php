<?php namespace Adamgoose\Gitlab\Models;

class Branch extends BaseModel {

  public function project()
  {
    return $this->getParent();
  }
  
}