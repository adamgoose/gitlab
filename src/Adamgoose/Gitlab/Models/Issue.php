<?php namespace Adamgoose\Gitlab\Models;

class Issue extends BaseModel {

  public function project()
  {
    return $this->getParent();
  }

  public function comments()
  {
    return $this->getModels('note', $this->fetch('projects/'.$this->project->id.'/issues/'.$this->id.'/notes'));
  }

}