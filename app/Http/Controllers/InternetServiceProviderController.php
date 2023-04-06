<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use App\Services\WifiCalculator\WifiCalculator;
use Illuminate\Http\Request;

class InternetServiceProviderController extends Controller
{
    public function getMptInvoiceAmount(Request $request)
    {
        $mpt = new Mpt();
        $wifiCalculator = new WifiCalculator($mpt);
        $amount = $wifiCalculator->calculateInvoiceAmount($request->get('month') ?: 1);
        
        return response()->json([
            'data' => $amount
        ]);
    }
    
    public function getOoredooInvoiceAmount(Request $request)
    {
        $ooredoo = new Ooredoo();
        $wifiCalculator = new WifiCalculator($ooredoo);
        $amount = $wifiCalculator->calculateInvoiceAmount($request->get('month') ?: 1);
        
        return response()->json([
            'data' => $amount
        ]);
    }
}
