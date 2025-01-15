<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\Controller as BaseController;
use App\Mail\OrderConfirmationMail;



class Controller extends BaseController
{

 public function index(){
    return view('welcome');
 }


 public function Emailsend($email, $data)
        {
            try {
               // dd("here");
                Mail::to($email)->send(new OrderConfirmationMail($data));
                $response = [
                    "success" => 1,
                ];
            } catch (\Exception $e) {
                $response = [
                    "success" => 0,
                    "message" => $e->getMessage(),
                ];
            }
            return $response;
        }
}
