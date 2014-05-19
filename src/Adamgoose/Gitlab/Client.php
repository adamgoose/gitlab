<?php namespace Adamgoose\Gitlab;

use Config;
use GuzzleHttp\Client as Http;
use Illuminate\Support\Collection;

class Client {

  /**
   * API
   * @var Http
   */
  protected $api;

  /**
   * Make API Call
   * @param  string $path  API Path
   * @param  array  $query Additional query parameters (optional)
   * @return GuzzleHttp\Response
   */
  public function fetch($path, array $query = [])
  {
    if(!($this->api instanceof Http))
      $this->setupHttpClient();

    return $this->api->get($path, ['query' => $query])->json();
  }

  /**
   * Instantiate HTTP Client
   * @return void
   */
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
        'query' => ['private_token' => Config::get('gitlab::private_token')],
      ],
    ]);
  }

  /**
   * Get filled model
   * @param  string $model      Which model to instantiate
   * @param  array  $attributes Generally, API response
   * @return BaseModel
   */
  public function getModel($model, $attributes)
  {
    $model = 'Adamgoose\Gitlab\Models\\'.studly_case($model);

    return new $model($attributes, $this);
  }

  /**
   * Get a collection of filled models
   * @param  string $model     Which model to instantiate
   * @param  array  $instances Generally, API response
   * @return Collection
   */
  public function getModels($model, $instances)
  {
    $collection = new Collection;

    foreach($instances as $instance)
      $collection->push($this->getModel($model, $instance));

    return $collection;
  }

}
