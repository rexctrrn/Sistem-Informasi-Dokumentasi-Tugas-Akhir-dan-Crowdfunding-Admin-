<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\Donasi;
use Inertia\Inertia;

class DonasiController extends Controller
{
    //
    
    public function index(){
        $jumlahDonasi = Donasi::sum('jumlah_donasi');
        return inertia::render('Donasi',[
            'jumlahDonasi' => $jumlahDonasi,
            'donasi' => Donasi::all()
        ]);
    }
    public function apiStore(Request $request){
        $tokenAuth = "Basic  U0ItTWlkLXNlcnZlci11djBrWnQwVndFNTZQX3V2aVBvLTNLVzU6";
        $url = "https://api.sandbox.midtrans.com/v1/payment-links";
        $body = [
            'customer_required' => false,
            'transaction_details' => [
                "order_id"=> rand(0, 99999),
                "gross_amount"=> $request->amount,
                "payment_link_id"=> Str::random(16)
            ],
            'userId' => 1
        ];
        $response = Http::withHeaders(
            ['Authorization' => $tokenAuth]
        )->post($url, $body);

        if ($response->successful()) {
            # code...
            Donasi::create([
                'metode_pembayaran'=>'Qris',
                'status' => 'sukses',
                'jumlah_donasi' => $request->amount,
            ]);
            return $response['payment_url'];
        }
    }

    public function destroy(Request $request)
    {
        //
        $data = Donasi::destroy($request->id);
        if ($data) {
            # code...
            return redirect()->route('donasi');

        }
    }
}
