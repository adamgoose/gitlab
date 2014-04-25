<?php namespace Adamgoose\Gitlab;

use Config;
use GuzzleHttp\Client as Http;
use Illuminate\Support\Collection;

class Client {

  protected $api;

  public function fetch($path, array $query = [])
  {
    if(!($this->api instanceof Http))
      $this->setupHttpClient();

    return $this->api->get($path, ['query' => $query])->json();
  }

  private function setupHttpClient()
  {
    $this->api = new Http([
      'base_url' => [
        'http'.(Config::get('gitlab::secure') ? 's' : '').'://'.Config::get('gitlab::hostname').'/api/{version}/',
        [
          'version' => Config::get('gitlab::api_version')
        ]
      ],
      'defaults' => [
        'query' => ['private_token' => 'TWr7iJtT3WkMQmZrNZzJ']
      ],
    ]);
  }

  public function getModel($model, $attributes)
  {
    $model = 'Adamgoose\Gitlab\Models\\'.studly_case($model);

    return new $model($attributes, $this);
  }

  public function getModels($model, $instances)
  {
    $collection = new Collection;

    foreach($instances as $instance)
      $collection->push($this->getModel($model, $instance));

    return $collection;
  }

}