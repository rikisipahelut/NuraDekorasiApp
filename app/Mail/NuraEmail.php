<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NuraEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     * 
     */
    public $nama = 'default';
    public $email = 'default';
    public $token = 'default';
    public $tipe = 'default';
    
    public function __construct($email,$nama,$token,$tipe)
    {
        //
        $this->email = $email;
        $this->nama = $nama;
        $this->token = $token;
        $this->tipe = $tipe;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($nama);
        // return $this->view('email-template');
        return $this->from('pengirim@malasngoding.com')
                   ->view('email-template')
                   ->with(
                    [
                        'nama' => $this->nama,
                        'website' => 'www.nuradekor.com',
                        'email' => $this->email,
                        'token' =>$this->token,
                        'tipe' =>$this->tipe
                    ]);
    }
}
