<?php namespace Adamgoose\Gitlab\Models;

use Illuminate\Support\Collection;

class Group extends BaseModel {

  /**
   * Path for use in find() method
   * @var string
   */
  public static $path = 'groups/';

  /**
   * Members
   * @return Collection of Member objects
   */
  public function members()
  {
    return $this->getModels('user', $this->fetch('groups/'.$this->id.'/members'));
  }

  /**
   * Projects
   * @return Collection of Project objects
   */
  public function projects()
  {
    $collection = new Collection;

    foreach($this->attributes['projects'] as $project)
      $collection->push($this->getModel('project', $project));

    return $collection;
  }

}