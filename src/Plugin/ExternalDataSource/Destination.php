<?php
use GuzzleHttp\Client;
/**
 * @file
 * Provides Drupal\external_data_source\Plugin\ExternalWsSource\Destination.
 */

namespace Drupal\umd_terp_base\Plugin\ExternalDataSource;

use Drupal\external_data_source\Plugin\ExternalDataSourceBase;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception as GuzzleException;

/**
 * Provides a 'Destination' ExternalDataSource.
 *
 * @ExternalDataSource(
 *   id = "destination",
 *   name = @Translation("Destination"),
 *   description = @Translation("This Plugin will gather a list of UMD Destination.")
 * )
 */
class Destination extends ExternalDataSourceBase {

  /**
   *
   * @return string
   */
  public function getPluginId() {
    return 'destination';
  }

  /**
   *
   * @return string
   */
  public function getPluginDefinition() {
    return $this->t('This Plugin will gather a list of UMD Destinations.');
  }

  /**
   * setRequest
   * Setting sent request
   *
   * @params Symfony\Component\HttpFoundation\Request $request
   */
  public function setRequest(Request $request) {
    $this->request = $request;
  }

  /**
   * getRequest
   * getting sent request
   *
   * @return \Symfony\Component\HttpFoundation\Request $request
   */
  public function getRequest() {
    return $this->request;
  }

  /**
   * getResponse
   * Call WS to retrieve data
   * @return array
   */
  public function getResponse() {
    $data = _umd_terp_base_middleware_taxonomy('destination');
    return $this->formatResponse($data);
  }

  /**
   * formatResponse
   *
   * @param array $response
   * Formatting data retrieved from ws to match [{"value":"","label":""},
   *   {"value":"", "label":""}] return array $collection retrieved suggestions
   *
   * @return array $collection
   */
  public function formatResponse(array $response) {
    $collection = _umd_terp_base_middleware_format_taxonomy($response);
    return $collection;
  }

}