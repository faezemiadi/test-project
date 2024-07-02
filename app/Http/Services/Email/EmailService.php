<?php

namespace App\Http\Services\Email;

use Illuminate\Support\Facades\Mail;

class EmailService{

    private $from = [
        ['address' => null ,'name' => null]
    ];
    private $details;
    private $subject;
    private $to;
    private $file = [];

    public function fire()
    {

        Mail::to($this->to)->send(new MailViewProvider($this->subject,$this->from,$this->details,$this->to,$this->file));

        return true;
        
    }

    public function setFrom($address,$name){

        $this->from =[ [
            'address' => $address,
            'name' => $name
        ]];
    }

    public function getFile(){

        return $this->file;
    }

    public function setFile($key,$file){

        $this->file[$key] = $file->type == 0 ? public_path($file->file_path):storage_path($file->file_path);
    }

    public function getFrom(){

        return $this->from;
    }

    public function setDetails($details){

        $this->details = $details;
    }

    public function getDetails(){

        return $this->details;
    }

    public function setSubject($subject){

        $this->subject = $subject;
    }

    public function getSubject(){

        return $this->subject;
    }

    public function setTo($to){

        $this->to = $to;
    }

    public function getTo(){

        return $this->to;
    }
}