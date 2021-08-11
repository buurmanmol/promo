<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BuckarooController extends Controller
{
    public function createSubscription(Request $request)
    {
//        dd($request->all());
        $startDate = Carbon::create($request->get('start_date'))->format('d-m-Y');
        $endDate = Carbon::create($request->get('end_date'))->format('d-m-Y');
        $user = $request->get('user');
        $addressArray = explode(' ', $user['address']);
        $housenumber = end($addressArray);
        if (($key = array_search($housenumber, $addressArray)) !== false) {
            unset($addressArray[$key]);
        }
        $txt = $user['address'];
        $str= preg_replace('/\W\w+\s*(\W*)$/', '$1', $txt);
        $street = $str;
//        dd($housenumber);
        $postArray =
            array(
                "Services" => array ("ServiceList" =>
                        array (
                            0 =>
                                array (
                                    "Name" => "Subscriptions",
                                    "Action" => "CreateSubscription",
                                    "Parameters" =>
                                        array (
                                            0 =>
                                                array (
                                                    "Name" => "StartDate",
                                                    "GroupType" => "AddRatePlan",
                                                    "GroupID" => "",
                                                    "Value" => $startDate,
                                                ),
                                            1 =>
                                                array (
                                                    "Name" => "RatePlanCode",
                                                    "GroupType" => "Addrateplan",
                                                    "GroupID" => "",
                                                    "Value" => "hpwda37b",
                                                ),
                                            2 =>
                                                array (
                                                    "Name" => "Code",
                                                    "GroupType" => "Debtor",
                                                    "GroupID" => "",
                                                    "Value" => $user['id'],
                                                ),
                                            3 =>
                                                array (
                                                    "Name" => "FirstName",
                                                    "GroupType" => "Person",
                                                    "GroupID" => "",
                                                    "Value" => $user['first_name'],
                                                ),
                                            4 =>
                                                array (
                                                    "Name" => "LastName",
                                                    "GroupType" => "Person",
                                                    "GroupID" => "",
                                                    "Value" => $user['last_name'],
                                                ),
//                                            5 =>
//                                                array (
//                                                    "Name" => "Gender",
//                                                    "GroupType" => "Person",
//                                                    "GroupID" => "",
//                                                    "Value" => "1",
//                                                ),
                                            5 =>
                                                array (
                                                    "Name" => "Culture",
                                                    "GroupType" => "Person",
                                                    "GroupID" => "",
                                                    "Value" => "nl-NL",
                                                ),
                                            6 =>
                                                array (
                                                    "Name" => "BirthDate",
                                                    "GroupType" => "Person",
                                                    "GroupID" => "",
                                                    "Value" => "01-01-1990",
                                                ),
                                            7 =>
                                                array (
                                                    "Name" => "Street",
                                                    "GroupType" => "Address",
                                                    "GroupID" => "",
                                                    "Value" => $street,
                                                ),
                                            8 =>
                                                array (
                                                    "Name" => "HouseNumber",
                                                    "GroupType" => "Address",
                                                    "GroupID" => "",
                                                    "Value" => $housenumber,
                                                ),
                                            9 =>
                                                array (
                                                    "Name" => "ZipCode",
                                                    "GroupType" => "Address",
                                                    "GroupID" => "",
                                                    "Value" => $user['postal_code'],
                                                ),
                                            10 =>
                                                array (
                                                    "Name" => "ConfigurationCode",
                                                    "Value" => "r4n7sr9f",
                                                ),
                                            11 =>
                                                array (
                                                    "Name" => "City",
                                                    "GroupType" => "Address",
                                                    "GroupID" => "",
                                                    "Value" => $user['city'],
                                                ),
                                            12 =>
                                                array (
                                                    "Name" => "Country",
                                                    "GroupType" => "Address",
                                                    "GroupID" => "",
                                                    "Value" => "NL",
                                                ),
                                            13 =>
                                                array (
                                                    "Name" => "Email",
                                                    "GroupType" => "Email",
                                                    "GroupID" => "",
                                                    "Value" => $user['email'],
                                                ),
                                            14 =>
                                                array (
                                                    "Name" => "PricePerUnit",
                                                    "GroupType" => "UpdateRatePlanCharge",
                                                    "GroupID" => "",
                                                    "Value" => $request->get('price'),
                                                ),
                                            15 =>
                                                array (
                                                    "Name" => "EndDate",
                                                    "GroupType" => "AddRatePlan",
                                                    "GroupID" => "",
                                                    "Value" => $endDate,
                                                ),
                                            16 =>
                                                array (
                                                    "Name" => "RatePlanChargeCode",
                                                    "GroupType" => "AddRatePlanChargeCode",
                                                    "GroupID" => "",
                                                    "Value" => "nxjshpxt",
                                                ),
                                        )
                                )
                        )
                )
        );

        $post = json_encode($postArray);
//        dd($post);
//        dd($post);
        $jsonArray = json_encode($postArray);
        $md5  = md5($post, true);
        $post = base64_encode($md5);

        $websiteKey = "mG8nQEY9eA";
        $uri        = strtolower(urlencode("testcheckout.buckaroo.nl/json/DataRequest"));
        $nonce      = "nonce_" . rand(0000000, 9999999);
        $time       = time();

        $hmac       = $websiteKey . "POST" . $uri . $time . $nonce . $post;
        $s          = hash_hmac("sha256", $hmac, "JoweErjbvaoK19O", true);
        $hmac       = base64_encode($s);

        $output =  "hmac " . $websiteKey . ":" . $hmac . ":" . $nonce . ":" . $time;
//        dd($post);

//        dd($output, $jsonArray, $nonce, $time);
        $client = new Client(['base_uri' => 'https://testcheckout.buckaroo.nl']);
        $response = $client->post('/json/DataRequest', [
//            'debug' => TRUE,
            'headers' => [
                "Authorization" => $output,
                "Access-Control-Allow-Origin" => "*",
                "Access-Control-Allow-Methods" => "GET, POST",
                "Content-Type" => "application/json",
            ],
            'body' => $jsonArray,
        ]);

//        dd($response);
//        $response = Http::withHeaders([
//            "Authorization" => $output,
//            "Access-Control-Allow-Origin" => "*",
//            "Access-Control-Allow-Methods" => "GET, POST",
//            "Content-Type" => "application/json",
//        ])->withOptions(['debug'=>true])->post('https://testcheckout.buckaroo.nl/json/DataRequest', [
//            'body' => $jsonArray,
//        ]);


//        dd($response);

//         dd($response->headers());
//        dd($response);
//        dd($response);
        return ["data" => $request->all(), "hmac" => $output];
    }


}
