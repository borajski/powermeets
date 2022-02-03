<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailsController extends Controller
{
    /*
    public function send(Request $request)
    {
        function sentence_case($string) {
            $sentences = explode(" ",$string);
            $sentences = array_reverse($sentences);
            $new_string = '';
            foreach ($sentences as $key => $sentence) {
                $new_string = ucfirst(mb_strtolower(trim($sentence)))." ".$new_string;
            }
            return $new_string;
        }
        $this->validate($request, [
            'ime' => 'required',
            'email' => 'required',
            'interes' => 'required',
            'poruka' => 'required'
        ]);

        $ime = $request->input('ime');
        $ime = sentence_case($ime);
        $email = $request->input('email');
        $interes = $request->input('interes');
        $poruka = $request->input('poruka');
        $sadrzaj = ['replyTo' => $email,'ime' => $ime, 'interes' => $interes, 'poruka' => $poruka];


        Mail::to("sknezev@inet.hr")->send(new FeedbackMailP($sadrzaj));

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }else{
            // return view('emails.test');
            return redirect('/contact')->with('success', 'You have successfully applied');
        }
    } */
}
