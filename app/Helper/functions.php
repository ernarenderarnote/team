<?php 

use Carbon\Carbon;
use Illuminate\Support\Str;

if (! function_exists('carbon')) {

    function carbon($date = null)
    {
    	if(is_null($date))
    		return new Carbon();
    	else{
    		$parseDate =  new Carbon();
    		return $parseDate->parse($date);
    	}
    }

}


if (! function_exists('token')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function token()
    {
    	$key = config('app.key');

	    if (Str::startsWith($key, 'base64:')) {
	        $key = base64_decode(substr($key, 7));
	    }

		return hash_hmac('sha256', Str::random(40), $key);
    }
}



?>