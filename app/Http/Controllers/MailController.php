<?php

namespace App\Http\Controllers;
use App\Mail\Testmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class MailController extends Controller
{
    public function sendemail()//function to send email
    {
      /*$details=[
        'title' => 'Application Success',
        'body' => 'Hello,Thank you for applying for our university'
      ];
      Mail::to("mostafanawam44@gmail.com")->send(new Testmail($details));
      return "email sent";*/
    }
}
