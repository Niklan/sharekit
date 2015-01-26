<?php

/**
 * @file
 * Class for working with networks.
 */

class Sharek {

  /**
   * Request builder.
   *
   * @param $url
   * @param string $method
   * @param array $data
   * @return mixed
   * @throws \Exception
   * @internal param bool $returnJson
   */
  private function _request($url, $method = 'GET', $data = array()) {
    $curl = curl_init();

    // Create cURL options array.
    $curlOptions = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => FALSE,
      CURLOPT_RETURNTRANSFER => TRUE,
    );

    curl_setopt_array($curl, $curlOptions);

    if ($method == 'POST') {
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }

    // Set method type.
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

    $response = curl_exec($curl);

    // Check for cURL errors.
    if ($response === FALSE) {
      $curlError = curl_error($curl);
      curl_close($curl);
      throw new Exception('cURL Error: ' . $curlError);
    }

    // Check for HTTP errors.
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($httpCode >= 400) {
      curl_close($curl);
      throw new Exception('HTTP Error: ' . $httpCode);
    }

    // All fine.
    curl_close($curl);
    return $response;
  }

  /**
   * Gt count for single or multiple social networks.
   *
   * @param string $url
   * @param array $networks
   * @return array
   */
  public function getCount($url, $networks) {
    $result = array();

    foreach ($networks as $network) {
      switch ($network) {
        case 'facebook':
          $result['facebook'] = $this->_getFacebookCount($url);
          break;
        case 'twitter':
          $result['twitter'] = $this->_getTwitterCount($url);
          break;
        case 'plusone':
          $result['plusone'] = $this->_getPlusOneCount($url);
          break;
        case 'vkontakte':
          $result['vkontakte'] = $this->_getVkontakteCount($url);
          break;
        case 'mailru':
          $result['mailru'] = $this->_getMailruCount($url);
          break;
        case 'odnoklassniki':
          $result['odnoklassniki'] = $this->_getOdnoklassnikiCount($url);
          break;
        case 'pinterest':
          $result['pinterest'] = $this->_getPinterestCount($url);
          break;
      }
    }

    return $result;
  }

  /**
   * Return facebook share count for URL.
   *
   * @param $url
   * @return mixed
   * @throws \Exception
   */
  private function _getFacebookCount($url) {
    $request = $this->_request("https://graph.facebook.com/fql?q=SELECT+total_count+FROM+link_stat+WHERE+url=%22{$url}%22");
    $result = json_decode($request);

    return $result->data[0]->total_count;
  }

  /**
   * Get Twitter share count for URL.
   *
   * @param $url
   * @return mixed
   * @throws \Exception
   */
  private function _getTwitterCount($url) {
    $request = $this->_request("https://cdn.api.twitter.com/1/urls/count.json?url={$url}");
    $result = json_decode($request);

    return $result->count;
  }

  /**
   * Get plus one counter. This is 'hack' cuz google+ does not have public API
   * for getting plus ones.
   *
   * @param $url
   * @return int
   * @throws \Exception
   */
  private function _getPlusOneCount($url) {
    $request = $this->_request("https://plusone.google.com/_/+1/fastbutton?url={$url}");
    preg_match('/window\.__SSR = {c: ([\d]+)/', $request, $matches);

    if (isset($matches[0])) {
      $result = (int) str_replace('window.__SSR = {c: ', '', $matches[0]);
    }
    else {
      $result = 0;
    }

    return $result;
  }

  /**
   * Get Vkontakte share count.
   * For VK url with trailing slash and without different.
   *
   * @param $url
   * @return int
   * @throws \Exception
   */
  private function _getVkontakteCount($url) {
    $cleanedUrl = $string = rtrim($url, '/');
    $result = 0;

    // Request for url without trailing slash.
    $request = $this->_request("https://vk.com/share.php?act=count&url={$cleanedUrl}&index=0");
    preg_match('/\\(0, (.*)\\)/', $request, $matches);
    $result += $matches[1];

    // Request for ulr with trailing slash.
    $request = $this->_request("https://vk.com/share.php?act=count&url={$cleanedUrl}/&index=0");
    preg_match('/\\(0, (.*)\\)/', $request, $matches);
    $result += $matches[1];

    return $result;
  }

  /**
   * Get share count for Mail.Ru
   *
   * @param $url
   * @return mixed
   * @throws \Exception
   */
  private function _getMailruCount($url) {
    $request = $this->_request("http://connect.mail.ru/share_count?url_list={$url}");
    $result = json_decode($request);

    return $result->$url->shares;
  }

  /**
   * Get share count for odnoklassniki.
   * They have same problem as VK, url with and without trailing slash are
   * different.
   *
   * @param $url
   * @return int
   * @throws \Exception
   */
  private function _getOdnoklassnikiCount($url) {
    $cleanedUrl = $string = rtrim($url, '/');
    $result = 0;

    // Request for url without trailing slash.
    $request = $this->_request("http://connect.ok.ru/dk?st.cmd=extLike&ref={$cleanedUrl}&uid=0");
    preg_match("/\\('0','(.*)'\\)/", $request, $matches);
    $result += $matches[1];

    // Request for ulr with trailing slash.
    $request = $this->_request("http://connect.ok.ru/dk?st.cmd=extLike&ref={$cleanedUrl}/&uid=0");
    preg_match("/\\('0','(.*)'\\)/", $request, $matches);
    $result += $matches[1];

    return $result;
  }


  private function _getPinterestCount($url) {
    $cleanedUrl = $string = rtrim($url, '/');
    $result = 0;

    // Request for url without trailing slash.
    $request = $this->_request("http://api.pinterest.com/v1/urls/count.json?url={$cleanedUrl}");
    preg_match("/\"count\":(.*)}/", $request, $matches);
    $result += $matches[1];

    // Request for ulr with trailing slash.
    $request = $this->_request("http://api.pinterest.com/v1/urls/count.json?url={$cleanedUrl}");
    preg_match("/\"count\":(.*)}/", $request, $matches);
    $result += $matches[1];

    return $result;
  }

}
