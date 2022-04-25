<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\User;

class CheckoutController extends Controller
{
    public function index() {
        return view('cart.checkout');
    }

    public function buyProducts(Request $request) {
        $street = $request->street;
        $pb = $request->pb;
        $city = $request->city;
        $country = $request->country;
        $phone = $request->phone;
        $total = $request->total;

        if(empty($street) || empty($pb) || empty($city) || empty($country) || empty($phone)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

       

        Checkout::createCheckout($street, $pb, $city, $country, $phone, $total);


        return response()->json([
            'success'=>'Uspešno ste izvršili kupovinu! Osvojili ste 10 poena!'
        ]);


    }

    public function updatePoints(Request $request) {
        $points = $request->points;

        User::updatePoints($points);
    }

    public function getCheckoutByUser() {
        $data = Checkout::where('user_id', auth()->user()->id)->paginate(6);

        // dd($data);

        return response()->json($data);
    }

    public function deleteCheckout($id) {
        Checkout::where('id', $id)->delete();
    }

    public function allCheck() {
        return view('menadzer.checkouts');
    }

    public function getCheck() {
        $data = Checkout::orderBy('created_at', 'desc')->paginate(10);

        return response()->json($data);
    }

    public function deleteCheckMen($id) {
        Checkout::where('id', $id)->delete();
    }
}
