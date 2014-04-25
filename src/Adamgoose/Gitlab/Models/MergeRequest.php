<?php namespace Adamgoose\Gitlab\Models;

class MergeRequest extends BaseModel {

  /**
   * Project
   * @return Project
   */
  public function project()
  {
    return $this->getParent();
  }

  /**
   * From
   * @return Branch
   */
  public function from()
  {
    return $this->getModel('branch', $this->fetch('projects/'.$this->project->id.'/repository/branches/'.$this->source_branch));
  }

  /**
   * To
   * @return Branch
   */
  public function to()
  {
    return $this->getModel('branch', $this->fetch('projects/'.$this->project->id.'/repository/branches/'.$this->target_branch));
  }

  /**
   * Notes
   * @return Collection of Note objects
   */
  public function notes()
  {
    return $this->getModels('note', $this->fetch('projects/'.$this->project->id.'/merge_requests/'.$this->id.'/notes'));
  }

}