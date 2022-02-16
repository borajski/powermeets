<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

class EmailsController extends Controller
{
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
            'poruka' => 'required'
        ]);

        $ime = $request->get('ime');
        $ime = sentence_case($ime);
        $email = $request->get('email');
        $poruka = $request->get('poruka');
       // $sadrzaj = ['replyTo' => $email,'ime' => $ime, 'interes' => $interes, 'poruka' => $poruka];
        
       Mail::send('emails.message', [
        'name' => $ime,
        'email' => $email,
        'comment' => $poruka ],
        function ($m) use ($email) {
                $m->from($email);
                $m->to('sinisa.knezevic@gmax.hr', 'PowerMeets')
                        ->subject('Website Contact Form');
});



       
       /* Mail::send($poruka, function ($m) {
            $m->from($email, $ime); 
            $m->to('sknezev@inet.hr', 'PowerMeets')->subject('Web Inquiry');
        });


       // Mail::to("sknezev@inet.hr")->send(new FeedbackMailP($sadrzaj)); */

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }else{
            // return view('emails.test');
            //return redirect('/contact')->with('success', 'You have successfully applied');
            return back()->with('success', 'Thanks for contacting me, I will get back to you soon!');
        }
    } 
}
