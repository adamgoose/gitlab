<?php namespace Adamgoose\Gitlab\Models;

class Branch extends BaseModel {

  /**
   * Project
   * @return Project
   */
  public function project()
  {
    return $this->getParent();
  }
  
}