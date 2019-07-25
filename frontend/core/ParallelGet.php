<?php

/**
 * Class ParallelGet
 */
class ParallelGet
{
    public $res;

    /**
     * ParallelGet constructor.
     * @param $urls
     */
    function __construct($urls)
    {
        // Create get requests for each URL
        $mh = curl_multi_init();
        foreach($urls as $i => $url)
        {
            $ch[$i] = curl_init($url);
            curl_setopt($ch[$i], CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch[$i], CURLOPT_HEADER, 0);
            curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch[$i], CURLOPT_URL, $url);
            curl_setopt($ch[$i], CURLOPT_FOLLOWLOCATION, TRUE);
            curl_multi_add_handle($mh, $ch[$i]);
        }

        // Start performing the request
        do {
            $execReturnValue = curl_multi_exec($mh, $runningHandles);
        } while ($execReturnValue == CURLM_CALL_MULTI_PERFORM);

        // Loop and continue processing the request
        while ($runningHandles && $execReturnValue == CURLM_OK) {

            // !!!!! changed this if and the next do-while !!!!!
            if (curl_multi_select($mh) != -1) {
                usleep(100);
            }

            do {
                $execReturnValue = curl_multi_exec($mh, $runningHandles);
            } while ($execReturnValue == CURLM_CALL_MULTI_PERFORM);

        }

        // Check for any errors
        if ($execReturnValue != CURLM_OK) {
            trigger_error("Curl multi read error $execReturnValue\n", E_USER_WARNING);
        }

        // Extract the content
        foreach($urls as $i => $url)
        {
            // Check for errors
            $curlError = curl_error($ch[$i]);
            if($curlError != "") {
                //print "Curl error on handle $i: $curlError<br>";
            }
            $res[$i] = json_decode(curl_multi_getcontent($ch[$i]));

            // Remove and close the handle
            curl_multi_remove_handle($mh, $ch[$i]);
            curl_close($ch[$i]);
        }
        // Clean up the curl_multi handle
        curl_multi_close($mh);

        $this->res = $res;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->res;
    }
}
