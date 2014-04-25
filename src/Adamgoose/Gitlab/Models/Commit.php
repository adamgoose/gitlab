<?php namespace Adamgoose\Gitlab\Models;

class Commit extends BaseModel {

  public function project()
  {
    return $this->getParent();
  }

  public function diff()
  {
    return $this->getModels('diff', $this->fetch('projects/'.$this->project->id.'/repository/commits/'.$this->id.'/diff'));
  }

}