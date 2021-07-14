<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductBooking;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Session;
use Omnipay\Omnipay;

class ProductBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking_products=ProductBooking::get();
        return view('admin.productbook.index',compact('booking_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $card_id = $request->card_id;

        $data = array();
        $amount = 0;
        foreach ($card_id as $i => $value) {
            $cart = Cart::find($value);
            //dd($cart);
            $amount = $amount + $cart->product->price;
            $data[$i]['product_id'] = $cart->product_id;
            $data[$i]['qty'] = $cart->qty;
            $data[$i]['user_id'] = $cart->user_id;
            $data[$i]['payment_status'] = $request->payment_type;
        }

        ///dd($data);

        $productBooking = ProductBooking::insert($data);
        $bookIds = ProductBooking::orderBy('id', 'desc')->take(count($data))->pluck('id');
        if ($productBooking) {
            Cart::destroy($card_id);
            if ($request->payment_type == 'eway') {
                Session::put('bookIds', $bookIds);
                $url = $this->ewayPayment($amount);
                return response()->json(['type' => 'eway', 'url' => $url]);
            } else {
                return response()->json(['type' => 'pay_person']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBooking $productBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductBooking $productBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductBooking $productBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductBooking::where('id', $id)->delete();
        return back();
    }
    public function ewayPayment($amount)
    {
        $total_amount = $amount;
        $apikey = '60CF3CvNGMqmznYAIqqfVTzpxVRtTQvkJGVwi2HeRFELnfLZHP8SG9Lag1AmhldExQMsmV';
        $apiPassword = 'HrNDgK3E';
        $apiEndpoint = 'Sandbox';
        $client = \Eway\Rapid::createClient($apikey, $apiPassword, $apiEndpoint);

        $transction = [
            'RedirectUrl' => route('product.bookingSuccess'),
            'CancelUrl' => route('Product.bookingFail'),
            'TransactionType' => \Eway\Rapid\Enum\TransactionType::PURCHASE,
            'Payment' => [
                'TotalAmount' => $total_amount * 100,
            ],
        ];
        $response = $client->createTransaction(\Eway\Rapid\Enum\ApiMethod::RESPONSIVE_SHARED, $transction);

        $sharedURL = '';
        if (!$response->getErrors()) {
            $sharedURL = $response->SharedPaymentUrl;
        }
        return $sharedURL;
    }
    public function bookingFail()
    {
        Session::forget('bookIds');
        return redirect()->route('cart');
    }
    public function bookingSuccess()
    {
        $bookIds = Session::get('bookIds');
        ProductBooking::whereIn('id', $bookIds)->update(['payment_status' => '1']);
        Session::forget('bookIds');
        return redirect()->route('cart');
    }
    public function change_bookingstatus(Request $request)
    {
        $id=$request->id;
        $booking_status=$request->booking_status;
        $booking_product=ProductBooking::where('id',$id)->update(['booking_status'=>$booking_status]);

    }
}
