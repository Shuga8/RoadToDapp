<?php

namespace App\Http\Controllers\Api\External;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CoinmarketCapApiController extends Controller
{

    use HttpResponses;

    public $api_key = "0de57342-9cef-4950-ad0d-672b343a73a8";

    public function index(Request $request, int $start = 1, int $limit = 20)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?start=$start&limit=$limit",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "X-CMC_PRO_API_KEY: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);

        return response()->json($response["data"]);
    }
}
