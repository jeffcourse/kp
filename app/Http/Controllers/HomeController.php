<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BeliController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\JualController;

class HomeController extends Controller
{
    public function welcome()
    {
        $beliController = new BeliController();
        $transLunas = $beliController->welcomeBeli()['transLunas'];
        $transStatus = $beliController->welcomeBeli()['transStatus'];

        $masterController = new MasterController();
        $totalProducts = $masterController->welcome()['totalProducts'];
        $totalPrice = $masterController->welcome()['totalPrice'];

        $jualController = new JualController();
        $transLunasJual = $jualController->welcomeJual()['transLunasJual'];
        $transStatusJual = $jualController->welcomeJual()['transStatusJual'];

        return view('welcome', compact('transLunas', 'transStatus', 'totalProducts', 'totalPrice', 'transLunasJual', 'transStatusJual'));
    }
}
