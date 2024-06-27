<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function handlePayment(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.tap.company/v2/charges/",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode([
            'amount' => 1,
            'currency' => 'KWD',
            'customer_initiated' => true,
            'threeDSecure' => true,
            'save_card' => false,
            'description' => 'Test Description',
            'metadata' => [
                'udf1' => 'Metadata 1'
            ],
            'reference' => [
                'transaction' => 'txn_01',
                'order' => 'ord_01'
            ],
            'receipt' => [
                'email' => true,
                'sms' => true
            ],
            'customer' => [
                'first_name' => 'test',
                'middle_name' => 'test',
                'last_name' => 'test',
                'email' => 'test@test.com',
                'phone' => [
                        'country_code' => 965,
                        'number' => 51234567
                ]
            ],
            'merchant' => [
                'id' => '1234'
            ],
            'source' => [
                'id' => 'src_card'
            ],
            'post' => [
                'url' => 'http://your_website.com/post_url'
            ],
            'redirect' => [
                'url' => 'http://your_website.com/redirect_url'
            ]
          ]),
          CURLOPT_HTTPHEADER => [
            "Authorization: Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ",
            "accept: application/json",
            "content-type: application/json"
          ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        $output = json_decode($response);

        return redirect()->to($output->transaction->url);
    }
}
