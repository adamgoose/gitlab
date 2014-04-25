<?php namespace Adamgoose\Gitlab\Models;

class Issue extends BaseModel {

  /**
   * Project
   * @return Project
   */
  public function project()
  {
    return $this->getParent();
  }

  /**
   * Comments
   * @return Collection of Note objects
   */
  public function comments()
  {
    return $this->getModels('note', $this->fetch('projects/'.$this->project->id.'/issues/'.$this->id.'/notes'));
  }

}