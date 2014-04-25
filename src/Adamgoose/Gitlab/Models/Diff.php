<?php namespace Adamgoose\Gitlab\Models;

class Diff extends BaseModel {

  public function commit()
  {
    return $this->getParent();
  }

}