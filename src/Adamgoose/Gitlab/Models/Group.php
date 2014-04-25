<?php namespace Adamgoose\Gitlab\Models;

use Illuminate\Support\Collection;

class Group extends BaseModel {

  public static $path = 'groups/';

  public function members()
  {
    return $this->getModels('user', $this->fetch('groups/'.$this->id.'/members'));
  }

  public function projects()
  {
    $collection = new Collection;

    foreach($this->attributes['projects'] as $project)
      $collection->push($this->getModel('project', $project));

    return $collection;
  }

}