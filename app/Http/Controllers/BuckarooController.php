<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BuckarooController extends Controller
{
    public function createSubscription(Request $request)
    {
        $postArray =
            array(
                "ClientIP"=> null,
              "ReturnURL"=> null,
              "ReturnURLCancel"=> null,
              "ReturnURLError"=> null,
              "ReturnURLReject"=> null,
              "Invoice"=> null,
              "Description"=> null,
              "Currency"=> null,
              "Amount"=> 0.0,
              "AmountCredit"=> 0.0,
              "OriginalTransactionKey"=> null,
              "OriginalTransactionReference"=> null,
              "ClientUserAgent"=> null,
              "PushURL"=> null,
              "PushURLFailure"=> null,
                'Services' => array ('ServiceList' =>
                        array (
                            0 =>
                                array (
                                    'Name' => 'Subscriptions',
                                    'Action' => 'CreateSubscription',
                                    'Parameters' =>
                                        array (
                                            0 =>
                                                array (
                                                    'Name' => 'StartDate',
                                                    'GroupType' => 'Addrateplan',
                                                    'GroupID' => '',
                                                    'Value' => '11-09-2021',
                                                ),
                                            1 =>
                                                array (
                                                    'Name' => 'RatePlanCode',
                                                    'GroupType' => 'Addrateplan',
                                                    'GroupID' => '',
                                                    'Value' => 'hpwda37b',
                                                ),
                                            2 =>
                                                array (
                                                    'Name' => 'Code',
                                                    'GroupType' => 'Debtor',
                                                    'GroupID' => '',
                                                    'Value' => 'AapjeTest',
                                                ),
                                            3 =>
                                                array (
                                                    'Name' => 'FirstName',
                                                    'GroupType' => 'Person',
                                                    'GroupID' => '',
                                                    'Value' => 'Aapje',
                                                ),
                                            4 =>
                                                array (
                                                    'Name' => 'LastName',
                                                    'GroupType' => 'Person',
                                                    'GroupID' => '',
                                                    'Value' => 'de Tester',
                                                ),
                                            5 =>
                                                array (
                                                    'Name' => 'Gender',
                                                    'GroupType' => 'Person',
                                                    'GroupID' => '',
                                                    'Value' => '1',
                                                ),
                                            6 =>
                                                array (
                                                    'Name' => 'Culture',
                                                    'GroupType' => 'Person',
                                                    'GroupID' => '',
                                                    'Value' => 'nl-NL',
                                                ),
                                            7 =>
                                                array (
                                                    'Name' => 'BirthDate',
                                                    'GroupType' => 'Person',
                                                    'GroupID' => '',
                                                    'Value' => '01-01-1990',
                                                ),
                                            8 =>
                                                array (
                                                    'Name' => 'Street',
                                                    'GroupType' => 'Address',
                                                    'GroupID' => '',
                                                    'Value' => 'Hoofdstraat',
                                                ),
                                            9 =>
                                                array (
                                                    'Name' => 'HouseNumber',
                                                    'GroupType' => 'Address',
                                                    'GroupID' => '',
                                                    'Value' => '90',
                                                ),
                                            10 =>
                                                array (
                                                    'Name' => 'ZipCode',
                                                    'GroupType' => 'Address',
                                                    'GroupID' => '',
                                                    'Value' => '8441ER',
                                                ),
                                            11 =>
                                                array (
                                                    'Name' => 'ConfigurationCode',
                                                    'Value' => 'r4n7sr9f',
                                                ),
                                            12 =>
                                                array (
                                                    'Name' => 'City',
                                                    'GroupType' => 'Address',
                                                    'GroupID' => '',
                                                    'Value' => 'Groningen',
                                                ),
                                            13 =>
                                                array (
                                                    'Name' => 'Country',
                                                    'GroupType' => 'Address',
                                                    'GroupID' => '',
                                                    'Value' => 'NL',
                                                ),
                                            14 =>
                                                array (
                                                    'Name' => 'Email',
                                                    'GroupType' => 'Email',
                                                    'GroupID' => '',
                                                    'Value' => 'th-molit@gmail.com',
                                                ),

                                        ),
                                ),
                        ),
                ),
        );

        $post = json_encode($postArray);
//        dd($post);
//        dd($post);
        $jsonArray = json_encode($postArray);
        $jsonerror = json_last_error_msg();
        $md5  = md5($post, true);
        $post = base64_encode($md5);

        $websiteKey = 'mG8nQEY9eA';
        $uri        = strtolower(urlencode('https://testcheckout.buckaroo.nl/json/DataRequest'));
        $nonce      = 'nonce_' . rand(0000000, 9999999);
        $time       = time();

        $hmac       = $websiteKey . 'POST' . $uri . $time . $nonce . $post;
        $s          = hash_hmac('sha256', $hmac, 'JoweErjbvaoK19O', true);
        $hmac       = base64_encode($s);

        $output =  "hmac " . $websiteKey . ':' . $hmac . ':' . $nonce . ':' . $time;
//        dd($post);

        $url = "https://testcheckout.buckaroo.nl/json/DataRequest";

         $response = Http::dd()->withHeaders([
            'Authorization' => $output,
             'Content-Type' => 'application/json'
        ])->withOptions(['debug' => true])->post($url,
            [$post]
         );



//         dd($response->headers());
//        dd($response);
//        dd($response);
        return ['data' => $response->body(), 'hmac' => $output, 'error' => $jsonerror];
    }


}
