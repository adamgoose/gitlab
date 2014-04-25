<?php namespace Adamgoose\Gitlab\Models;

use Gitlab\Client;
use Illuminate\Support\Collection;

class Project extends BaseModel {

  /**
   * Path for use in find() method
   * @var string
   */
  public static $path = 'projects/';

  /**
   * Events
   * @return Collection of Event objects
   */
  public function events()
  {
    return $this->getModels('event', $this->fetch('projects/'.$this->id.'/events'));
  }

  /**
   * Members
   * @return Collection of Member objects
   */
  public function members()
  {
    return $this->getModels('user', $this->fetch('projects/'.$this->id.'/members'));
  }

  /**
   * Member
   * @param  int $id
   * @return Member
   */
  public function member($id)
  {
    return $this->getModel('user', $this->fetch('projects/'.$this->id.'/members/'.$id));
  }

  /**
   * Hooks
   * @return Collection of Hook objects
   */
  public function hooks()
  {
    return $this->getModels('hook', $this->fetch('projects/'.$this->id.'/hooks'));
  }

  /**
   * Hook
   * @param  int $id
   * @return Hook
   */
  public function hook($id)
  {
    return $this->getModel('hook', $this->fetch('projects/'.$this->id.'/hooks/'.$id));
  }

  /**
   * Branches
   * @return Collection of Branch objects
   */
  public function branches()
  {
    return $this->getModels('branch', $this->fetch('projects/'.$this->id.'/repository/branches'));
  }

  /**
   * Branch
   * @param  string $name
   * @return Branch
   */
  public function branch($name)
  {
    return $this->getModel('branch', $this->fetch('projects/'.$this->id.'/repository/branches/'.$name));
  }

  /**
   * Tags
   * @return Collection of Tag objects
   */
  public function tags()
  {
    return $this->getModels('tag', $this->fetch('projects/'.$this->id.'/repository/tags'));
  }

  /**
   * Tree
   * @return Collection of Blob and Tree objects
   */
  public function tree()
  {
    $collection = new Collection;

    foreach($this->fetch('projects/'.$this->id.'/repository/tree') as $asset)
      $collection->push($this->getModel($asset['type'], $asset));

    return $collection;
  }

  /**
   * Commits
   * @return Collection of Commit objects
   */
  public function commits()
  {
    return $this->getModels('commit', $this->fetch('projects/'.$this->id.'/repository/commits'));
  }

  /**
   * Commit
   * @param  string $sha
   * @return Commit
   */
  public function commit($sha)
  {
    return $this->getModel('commit', $this->fetch('projects/'.$this->id.'/repository/commits/'.$sha));
  }

  /**
   * Snippets
   * @return Collection of Snippet objects
   */
  public function snippets()
  {
    return $this->getModels('snippet', $this->fetch('projects/'.$this->id.'/snippets'));
  }

  /**
   * Snippet
   * @param  int $id
   * @return Snippet
   */
  public function snippet($id)
  {
    return $this->getModel('snippet', $this->fetch('projects/'.$this->id.'/snippets/'.$id));
  }

  /**
   * Keys
   * @return Collection of Key objects
   */
  public function keys()
  {
    return $this->getModels('key', $this->fetch('projects/'.$this->id.'/keys'));
  }

  /**
   * Key
   * @param  int $id
   * @return Key
   */
  public function key($id)
  {
    return $this->getModel('key', $this->fetch('projects/'.$this->id.'/keys/'.$id));
  }

  /**
   * Issues
   * @return Collection of Issue objects
   */
  public function issues()
  {
    return $this->getModels('issue', $this->fetch('projects/'.$this->id.'/issues'));
  }

  /**
   * Issue
   * @param  int $id Global ID, not relative ID
   * @return Issue
   */
  public function issue($id)
  {
    return $this->getModel('issue', $this->fetch('projects/'.$this->id.'/issues/'.$id));
  }

  /**
   * Milestones
   * @return Collection of Milestone objects
   */
  public function milestones()
  {
    return $this->getModels('milestone', $this->fetch('projects/'.$this->id.'/milestones'));
  }

  /**
   * Milestone
   * @param  int $id
   * @return Milestone
   */
  public function milestone($id)
  {
    return $this->getModel('milestone', $this->fetch('projects/'.$this->id.'/milestones/'.$id));
  }

  /**
   * Merge Requests
   * @return Collection of MergeRequest objects
   */
  public function merge_requests()
  {
    return $this->getModels('merge_request', $this->fetch('projects/'.$this->id.'/merge_requests'));
  }

  /**
   * Merge Request
   * @param  int $id
   * @return MergeRequest
   */
  public function merge_request($id)
  {
    return $this->getModel('merge_request', $this->fetch('projects/'.$this->id.'/merge_requests/'.$id));
  }

}