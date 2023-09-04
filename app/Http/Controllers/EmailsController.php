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
            'g-recaptcha-response' => 'required|captcha',
            'ime' => 'required',
            'email' => 'required',
            'poruka' => 'required',
            
        ]); 
        $ime = $request->get('ime');
        $ime = sentence_case($ime);
        $email = $request->get('email');
        $poruka = $request->get('poruka');
       
       Mail::send('emails.message', [
        'name' => $ime,
        'email' => $email,
        'comment' => $poruka ],
        function ($m) use ($email,$ime) {
                $m->from($email);
                $m->to('powerlifting.software@gmail.com', 'PowerMeets')
                ->subject('PowerMeets Contact Form')
                ->replyTo($email, $ime);
});
        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }else{
                     return back()->with('success', 'Thanks for contacting us, we will get back to you soon!');
        }
    } 
}
