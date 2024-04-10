<?php

namespace App\Http\Controllers;

use Infobip\Api\SmsApi;
use Infobip\ApiException;
use Infobip\Configuration;
use Illuminate\Http\Request;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

class SendSMSController extends Controller
{
    //

    public function loadPage(){
        return view('send-sms');
    }

    public function sendSMS(Request $request){
        $configuration = new Configuration(
            host: 'k28z4e.api.infobip.com', //get these data from the account dashboard
            apiKey: '99de93bd0e671ef99355b3bdcc332eea-75607338-5132-46dd-bd3b-c32f3766fb9a' // now replace these data with the actual ones from infobip account..
        );
        
        $sendSmsApi = new SmsApi(config: $configuration);

        $message = new SmsTextualMessage(
            destinations: [
                new SmsDestination(to: $request->number)
            ],
            from: 'Code', //this from has character limit.. read from their documentation
            text: $request->message
        );

        $request = new SmsAdvancedTextualRequest(messages: [$message]);

        try {
            $smsResponse = $sendSmsApi->sendSmsMessage($request);
            return redirect('/send-sms')->with('success','SMS was sent successfully');
        } catch (ApiException $apiException) {
            return redirect('/send-sms')->with('fail',$apiException->getMessage());
        }

    }
}
