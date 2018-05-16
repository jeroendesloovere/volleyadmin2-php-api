<?php

namespace JeroenDesloovere\VolleyAdmin2;

/**
 * In this file we store all generic functions that we will be using for VolleyAdmin2.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class VolleyAdmin2
{
    const API_URL = 'http://www.volleyadmin2.be/services';

    // Possible methods
    const API_METHOD_STANDINGS = 'rangschikking';
    const API_METHOD_MATCHES = 'wedstrijden';
    const API_METHOD_TEAMS = 'series';
    
    // Possible variables
    const CLUB_NUMBER = 'stamnummer';
    const PROVINCE_ID = 'province_id';
    const SERIES_ID = 'reeks';

    /**
     * Do call
     *
     * @param string $method
     * @param array $parameters
     * @return array
     * @throws Exception
     */
    protected function doCall($method, $parameters = array())
    {
        // check if curl is available
        if (!function_exists('curl_init')) {
            throw new Exception('This method requires cURL (http://php.net/curl), it seems like the extension isn\'t installed.');
        }

        $parameters['format'] = 'json';
        $parameterString = '';
        foreach ($parameters as $key => $value) {
            $parameterString .= ($parameterString == '') ? '?' : '&';
            $value = str_replace(' ', '%20', $value);
            $parameterString .= $key . '=' . $value;
        }

        // define endPoint
        $endPoint = self::API_URL . '/' . $method . '_xml.php' . $parameterString;

        // init curl
        $curl = curl_init();

        // set options
        curl_setopt($curl, CURLOPT_URL, $endPoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);

        // execute curl
        $response = curl_exec($curl);

        // fetch errors from curl
        $errorNumber = curl_errno($curl);
        $errorMessage = curl_error($curl);

        // close curl
        curl_close($curl);

        // we have errors
        if ($errorNumber != '') {
            throw new Exception($errorMessage);
        }

        // redefine response as json decoded
        return json_decode($response);
    }

    /**
     * Check parameters
     *
     * @param array $parameters
     * @return array
     * @throws Exception
     */
    protected function checkParameters($parameters)
    {
        $result = array();

        // We loop all parameters to find their real key (= dutch key which the API uses)
        foreach ($parameters as $key => $value) {
            if ($value === null) {
                continue;
            }

            if (!in_array($key, $this->getPossibleParameters())) {
                throw new Exception('The key "' . $key . '" is invalid.');
            }

            $result[$key] = $value;
        }

        return $result;
    }

    /**
     * @return array
     */
    private function getPossibleParameters()
    {
        return array(
            self::CLUB_NUMBER,
            self::PROVINCE_ID,
            self::SERIES_ID,
        );
    }

    /**
     * Get matches
     *
     * @param string $seriesId
     * @param int $provinceId
     * @param string $clubNumber
     * @return array
     * @throws Exception
     */
    public function getMatches(
        $seriesId = null,
        $provinceId = null,
        $clubNumber = null
    ) {
        return $this->doCall(
            self::API_METHOD_MATCHES,
            $this->checkParameters(array(
                self::SERIES_ID => $seriesId,
                self::PROVINCE_ID => $provinceId,
                self::CLUB_NUMBER => $clubNumber,
            ))
        );
    }

    /**
     * Get series
     *
     * @param int $provinceId - Fill in if you want to filter for province.
     * @return array
     * @throws Exception
     */
    public function getSeries($provinceId = null)
    {
        return $this->doCall(
            self::API_METHOD_TEAMS,
            $this->checkParameters(array(
                self::PROVINCE_ID => $provinceId,
            ))
        );
    }

    /**
     * Get standings
     *
     * @param string $seriesId
     * @param int $provinceId
     * @return array
     * @throws Exception
     */
    public function getStandings(
        $seriesId = null,
        $provinceId = null
    ) {
        return $this->doCall(
            self::API_METHOD_STANDINGS,
            $this->checkParameters(array(
                self::SERIES_ID => $seriesId,
                self::PROVINCE_ID => $provinceId,
            ))
        );
    }
}
