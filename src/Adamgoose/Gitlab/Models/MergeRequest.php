<?php namespace Adamgoose\Gitlab\Models;

class MergeRequest extends BaseModel {

  public function project()
  {
    return $this->getParent();
  }

  public function from()
  {
    return $this->getModel('branch', $this->fetch('projects/'.$this->project->id.'/repository/branches/'.$this->source_branch));
  }

  public function to()
  {
    return $this->getModel('branch', $this->fetch('projects/'.$this->project->id.'/repository/branches/'.$this->target_branch));
  }

  public function notes()
  {
    return $this->getModels('note', $this->fetch('projects/'.$this->project->id.'/merge_requests/'.$this->id.'/notes'));
  }

}