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

    /**
     * Build parameters
     *
     * @param array $parameters
     * @return array
     */
    protected function buildParameters($parameters)
    {
        $result = array();

        // We loop all parameters to find their real key (= dutch key which the API uses)
        foreach ($parameters as $key => $value) {
            // If null we ignore the parameter
            if ($value != null) {
                $realKey = '';

                switch ($key) {
                    case 'clubNumber':
                        $realKey = 'stamnummer';
                        break;
                    case 'provinceId':
                        $realKey = 'province_id';
                        break;
                    case 'seriesId':
                        $realKey = 'reeks';
                        break;
                    default:
                        throw new Exception('The key "' . $key . '" is invalid.');
                        break;
                }

                // Add to result
                $result[$realKey] = $value;
            }
        }

        return $result;
    }

    /**
     * Do call
     *
     * @param string $method
     * @param array $parameters
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

        // init headers
        $headers = array();

        // execute
        $response = curl_exec($curl);

        // get HTTP response code
        $httpCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // close
        curl_close($curl);

        // response is empty or false
        if (empty($response)) {
            throw new Exception('Error: ' . $response);
        }

        // init result
        $result = false;

        // successfull response
        if (($httpCode == 200) || ($httpCode == 201)) {
            $result = json_decode($response);
        }

        // return
        return $result;
    }

    /**
     * Get matches
     *
     * @param string $seriesId
     * @param integer $provinceId
     * @param string $clubNumber
     * @return json
     */
    public function getMatches(
        $seriesId = null,
        $provinceId = null,
        $clubNumber = null
    ) {
        // Init parameters
        $parameters = $this->buildParameters([
            'seriesId' => $seriesId,
            'provinceId' => $provinceId,
            'clubNumber' => $clubNumber,
        ]);

        return $this->doCall(self::API_METHOD_MATCHES, $parameters);
    }

    /**
     * Get series
     *
     * @param integer $provinceId   Fill in if you want to filter for province.
     * @return json
     */
    public function getSeries(
        $provinceId = null
    ) {
        // Init parameters
        $parameters = $this->buildParameters([
            'provinceId' => $provinceId,
        ]);

        return $this->doCall(self::API_METHOD_TEAMS, $parameters);
    }

    /**
     * Get standings
     *
     * @param string $seriesId
     * @param integer $provinceId
     * @return json
     */
    public function getStandings(
        $seriesId = null,
        $provinceId = null
    ) {
        // Init parameters
        $parameters = $this->buildParameters([
            'seriesId' => $seriesId,
            'provinceId' => $provinceId,
        ]);

        return $this->doCall(self::API_METHOD_STANDINGS, $parameters);
    }
}
