<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Mail;

class Mails extends Model
{
  protected $from_email = '';
  protected $from_name = '';
  protected $locale = '';
  
  public function __construct(){
    $this->from_email = env('MAIL_FROM_EMAIL');
    $this->from_name = env('MAIL_FROM_NAME');
  }

  public function signup_email($user, $password = ''){
    if(!$user) return;
    $template = "emails.signup_email";
    $send = Mail::send($template, ['user' => $user, 'password' => $password], function ($m) use ($user) {
        $m->from($this->from_email, $this->from_name);
        $m->to($user->email, $user->email)->subject('Impresso Sign Up');
    });
    return;
  }

}
