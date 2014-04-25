<?php namespace Adamgoose\Gitlab\Models;

class Diff extends BaseModel {

  /**
   * Commit
   * @return Commit
   */
  public function commit()
  {
    return $this->getParent();
  }

}