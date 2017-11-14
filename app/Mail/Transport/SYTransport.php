<?php
namespace App\Mail\Transport;

use Illuminate\Mail\Transport\Transport;
use Illuminate\Support\Facades\Log;
use Swift_Mime_Message;

class SYTransport extends Transport
{

    public function __construct()
    {
    }

    public function send(\Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        file_get_contents('http://www.xiaohigh.com/mail/index.php?to=xiaohigh@163.com&code=12345');
    }

}