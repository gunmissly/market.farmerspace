<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('key')) {
            if (Session::get('role') == 'User') {
                $client = new Client();

                // buyer
                $response = $client->request("GET", "https://www.farmerspace.co/api/getProduct.php", [
                    'query' => ['UserType' => 'buyer'],
                ]);
                $buyer_bodyGetProduct = $response->getBody();

                // farmer
                $response = $client->request("GET", "https://www.farmerspace.co/api/getProduct.php", [
                    'query' => ['UserType' => 'farmer'],
                ]);
                $farmer_bodyGetProduct = $response->getBody();

                return view('market')
                    ->with('buyer_jsonDecodeGetProduct', json_decode($buyer_bodyGetProduct, true))
                    ->with('farmer_jsonDecodeGetProduct', json_decode($farmer_bodyGetProduct, true));

            } else {
                flash('This user is not enough authority', 'danger');
                return view('login');
            }
        } else {
            return view('login');
        }
    }

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create()
    {
        if (empty(Session::get('key'))) {
            return Redirect(url('/'));
        } else {

            return view('market.create');
        }
    }

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function store(Request $request)
    {
        if (empty($request->input('Latitude')) || empty($request->input('Longitude'))) {
            flash('โปรดระบุจุดรับ - ซื้อขาย ผลผลิต', 'warning');
            return back()->withInput();
        }
        /*=====================================
        =            Common Params            =
        =====================================*/
        $ProductName = $request->input('ProductName');
        $Species     = $request->input('Species');
        $Detail      = $request->input('Detail');
        $Price       = $request->input('Price');
        $Quantity    = $request->input('Quantity');
        $HarvestDay  = $request->input('HarvestDay');
        $Latitude    = $request->input('Latitude');
        $Longitude   = $request->input('Longitude');
        $UserID      = Session::get('key');
        //type of user *api condition
        $UserType = $request->input('userradio');
        /*=====  End of Common Params  ======*/

        if ($request->input('addresradio') == 'oldAddress') {

            // Get own address
            try {
                $client   = new Client();
                $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                    ['query' =>
                        ['Method' => 'ShowUserInfo',
                            'Phone'   => Session::get('phone'),
                            'PWD'     => Session::get('pwd'),
                        ],
                    ]);
                $bodyShowUserInfo = $response->getBody();
                $jsonDecode       = json_decode($bodyShowUserInfo, true);

                $Address     = $jsonDecode['dataListUserInfo'][0]['Address'];
                $SubDistrict = $jsonDecode['dataListUserInfo'][0]['SubDistrict'];
                $District    = $jsonDecode['dataListUserInfo'][0]['District'];
                $Province    = $jsonDecode['dataListUserInfo'][0]['Province'];
                $Zipcode     = $jsonDecode['dataListUserInfo'][0]['Zipcode'];
            } catch (Exception $e) {
                return $e->getMessage();
            }

        } elseif ($request->input('addresradio') == 'newAddress') {
            $Address     = $request->input('Address');
            $SubDistrict = $request->input('SubDistrict');
            $District    = $request->input('District');
            $Province    = $request->input('Province');
            $Zipcode     = $request->input('Zipcode');
        }

        $client   = new Client();
        $response = $client->request('POST', 'https://www.farmerspace.co/api/postProduct.php', [
            'form_params' => [
                'UserID'      => $UserID,
                'ProductName' => $ProductName,
                'Species'     => $Species,
                'Detail'      => $Detail,
                'Price'       => $Price,
                'Quantity'    => $Quantity,
                'HarvestDay'  => $HarvestDay,
                'Address'     => $Address,
                'SubDistrict' => $SubDistrict,
                'District'    => $District,
                'Province'    => $Province,
                'Zipcode'     => $Zipcode,
                'Latitude'    => $Latitude,
                'Longitude'   => $Longitude,
                'UserType'    => $UserType,
            ],
        ]);
        $bodyInsertProduct       = $response->getBody();
        $jsonDecodeInsertProduct = json_decode($bodyInsertProduct, true);
        //flash($jsonDecodeInsertProduct['message'],'success');
        return Redirect(url('/'));

    }

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function show($id)
    {

    }

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function edit($id)
    {
        // Condition of user type
        $UserType = substr($id, 0, 1);
        if ($UserType == 'B') {
            $UserType = 'buyer';
        } elseif ($UserType == 'S') {
            $UserType = 'farmer';
        }
        // End
        $client   = new Client();
        $response = $client->request("GET", "https://www.farmerspace.co/api/getProductById.php", [
            'query' => ['id' => $id, 'UserType' => $UserType],
        ]);
        $bodyGetProduct = $response->getBody();

        return view('market.edit')
            ->with('bodyGetProduct', json_decode($bodyGetProduct, true));
    }

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, $id)
    {
        if (empty($request->input('Latitude')) || empty($request->input('Longitude'))) {
            flash('โปรดระบุจุดรับ - ซื้อขาย ผลผลิต', 'warning');
            return back()->withInput();
        }
        /*=====================================
        =            Common Params            =
        =====================================*/
        $RequestID   = $request->input('RequestID');
        $ProductName = $request->input('ProductName');
        $Species     = $request->input('Species');
        $Detail      = $request->input('Detail');
        $Price       = $request->input('Price');
        $Quantity    = $request->input('Quantity');
        $HarvestDay  = $request->input('HarvestDay');
        $Latitude    = $request->input('Latitude');
        $Longitude   = $request->input('Longitude');
        $UserID      = Session::get('key');
        //type of user *api condition
        echo $UserType = $request->input('userradio');
        /*=====  End of Common Params  ======*/

        if ($request->input('addresradio') == 'oldAddress') {

            // Get own address
            try {
                $client   = new Client();
                $response = $client->request("GET", "http://farmerspace.azurewebsites.net/handlerforweb.ashx",
                    ['query' =>
                        ['Method' => 'ShowUserInfo',
                            'Phone'   => Session::get('phone'),
                            'PWD'     => Session::get('pwd'),
                        ],
                    ]);
                $bodyShowUserInfo = $response->getBody();
                $jsonDecode       = json_decode($bodyShowUserInfo, true);

                $Address     = $jsonDecode['dataListUserInfo'][0]['Address'];
                $SubDistrict = $jsonDecode['dataListUserInfo'][0]['SubDistrict'];
                $District    = $jsonDecode['dataListUserInfo'][0]['District'];
                $Province    = $jsonDecode['dataListUserInfo'][0]['Province'];
                $Zipcode     = $jsonDecode['dataListUserInfo'][0]['Zipcode'];
            } catch (Exception $e) {
                return $e->getMessage();
            }

        } elseif ($request->input('addresradio') == 'newAddress') {
            $Address     = $request->input('Address');
            $SubDistrict = $request->input('SubDistrict');
            $District    = $request->input('District');
            $Province    = $request->input('Province');
            $Zipcode     = $request->input('Zipcode');
        }

        $client   = new Client();
        $response = $client->request('POST', 'https://www.farmerspace.co/api/putProduct.php', [
            'form_params' => [
                'RequestID'   => $RequestID,
                'UserID'      => $UserID,
                'ProductName' => $ProductName,
                'Species'     => $Species,
                'Detail'      => $Detail,
                'Price'       => $Price,
                'Quantity'    => $Quantity,
                'HarvestDay'  => $HarvestDay,
                'Address'     => $Address,
                'SubDistrict' => $SubDistrict,
                'District'    => $District,
                'Province'    => $Province,
                'Zipcode'     => $Zipcode,
                'Latitude'    => $Latitude,
                'Longitude'   => $Longitude,
                'UserType'    => $UserType,
            ],
        ]);
        $bodyUpdateProduct       = $response->getBody();
        $jsonDecodeUpdateProduct = json_decode($bodyUpdateProduct, true);
        //flash($jsonDecodeInsertProduct['message'],'success');
        //echo $jsonDecodeUpdateProduct['message'];
        return Redirect(url('/'));

    }

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function destroy($id)
    {
        //
    }
}
