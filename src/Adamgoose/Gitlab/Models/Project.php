<?php namespace Adamgoose\Gitlab\Models;

use Gitlab\Client;
use Illuminate\Support\Collection;

class Project extends BaseModel {

  public static $path = 'projects/';

  public function events()
  {
    return $this->getModels('event', $this->fetch('projects/'.$this->id.'/events'));
  }

  public function members()
  {
    return $this->getModels('user', $this->fetch('projects/'.$this->id.'/members'));
  }

  public function member($id)
  {
    return $this->getModel('user', $this->fetch('projects/'.$this->id.'/members/'.$id));
  }

  public function hooks()
  {
    return $this->getModels('hook', $this->fetch('projects/'.$this->id.'/hooks'));
  }

  public function hook($id)
  {
    return $this->getModel('hook', $this->fetch('projects/'.$this->id.'/hooks/'.$id));
  }

  public function branches()
  {
    return $this->getModels('branch', $this->fetch('projects/'.$this->id.'/repository/branches'));
  }

  public function branch($name)
  {
    return $this->getModel('branch', $this->fetch('projects/'.$this->id.'/repository/branches/'.$name));
  }

  public function tags()
  {
    return $this->getModels('tag', $this->fetch('projects/'.$this->id.'/repository/tags'));
  }

  public function tree()
  {
    $collection = new Collection;

    foreach($this->fetch('projects/'.$this->id.'/repository/tree') as $asset)
      $collection->push($this->getModel($asset['type'], $asset));

    return $collection;
  }

  public function commits()
  {
    return $this->getModels('commit', $this->fetch('projects/'.$this->id.'/repository/commits'));
  }

  public function commit($sha)
  {
    return $this->getModel('commit', $this->fetch('projects/'.$this->id.'/repository/commits/'.$sha));
  }

  public function snippets()
  {
    return $this->getModels('snippet', $this->fetch('projects/'.$this->id.'/snippets'));
  }

  public function snippet($id)
  {
    return $this->getModel('snippet', $this->fetch('projects/'.$this->id.'/snippets/'.$id));
  }

  public function keys()
  {
    return $this->getModels('key', $this->fetch('projects/'.$this->id.'/keys'));
  }

  public function key($id)
  {
    return $this->getModel('key', $this->fetch('projects/'.$this->id.'/keys/'.$id));
  }

  public function issues()
  {
    return $this->getModels('issue', $this->fetch('projects/'.$this->id.'/issues'));
  }

  public function issue($id)
  {
    return $this->getModel('issue', $this->fetch('projects/'.$this->id.'/issues/'.$id));
  }

  public function milestones()
  {
    return $this->getModels('milestone', $this->fetch('projects/'.$this->id.'/milestones'));
  }

  public function milestone($id)
  {
    return $this->getModel('milestone', $this->fetch('projects/'.$this->id.'/milestones/'.$id));
  }

  public function merge_requests()
  {
    return $this->getModels('merge_request', $this->fetch('projects/'.$this->id.'/merge_requests'));
  }

  public function merge_request($id)
  {
    return $this->getModel('merge_request', $this->fetch('projects/'.$this->id.'/merge_requests/'.$id));
  }

}