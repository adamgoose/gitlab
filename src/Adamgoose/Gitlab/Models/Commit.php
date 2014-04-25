<?php namespace Adamgoose\Gitlab\Models;

class Commit extends BaseModel {

  /**
   * Project
   * @return Project
   */
  public function project()
  {
    return $this->getParent();
  }

  /**
   * Diff
   * @return Diff
   */
  public function diff()
  {
    return $this->getModels('diff', $this->fetch('projects/'.$this->project->id.'/repository/commits/'.$this->id.'/diff'));
  }

}