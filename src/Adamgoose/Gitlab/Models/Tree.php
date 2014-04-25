<?php namespace Adamgoose\Gitlab\Models;

use Illuminate\Support\Collection;

class Tree extends BaseModel {

  /**
   * Project
   * @return Project
   */
  public function project()
  {
    return $this->getParent();
  }

  /**
   * Tree
   * @return Collection of Blob and Tree objects
   */
  public function tree()
  {
    $collection = new Collection;

    foreach($this->fetch('projects/'.$this->project->id.'/repository/tree', ['path' => $this->name]) as $asset)
      $collection->push($this->getModel($asset['type'], $asset));

    return $collection;
  }
  
}