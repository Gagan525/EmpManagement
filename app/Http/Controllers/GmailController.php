<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Google\Service\Gmail as GoogleGmail;

class GmailController extends Controller
{
    //
    protected $client;

    public function __construct()
    {
        $this->client = new GoogleClient();
        $this->client->setApplicationName('Employee Management System');
        $this->client->setScopes([
            'https://www.googleapis.com/auth/gmail.readonly',
            'https://www.googleapis.com/auth/gmail.modify',
        ]);
        $this->client->setClientId('903930607607-qfh5q5pleo0f845v9m7b9lktnej29v77.apps.googleusercontent.com');
        $this->client->setClientSecret('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');
        $this->client->setAccessType('offline');
        $this->client->setRedirectUri(route('gmail.callback'));
    }

    public function auth()
    {
        $authUrl = $this->client->createAuthUrl();
        // return $authUrl;
        return redirect($authUrl);

        return view('employees.gmail.auth', compact('authUrl'));
    }

    public function callback(Request $request)
    {
        $code = $request->input('code');

        if ($code) {
            $this->client->setAccessType('offline');
            $this->client->setApprovalPrompt('force');
            $token = $this->client->fetchAccessTokenWithAuthCode($code);
            
            if (isset($token['access_token'])) {
                $this->client->setAccessToken($token);
                // return $token['refresh_token'];

                // Save the refresh token to the database for later use
                $refresh_token = $token['refresh_token'];
                // ...
                $this->client->fetchAccessTokenWithRefreshToken($refresh_token);

                return redirect()->route('gmail.inbox');
            }
        }

        return redirect()->route('home');
    }

    public function inbox()
    {
        $gmail = new GoogleGmail($this->client);
        // Check if access token is expired
        if ($this->client->isAccessTokenExpired()) {
            // Get new access token using the refresh token
            // $refreshToken = $this->client->getRefreshToken();
            $refreshToken = "1//0gT_bkWPAnxN6CgYIARAAGBASNwF-L9IrzvBKVWFZAZnfGXHQ7KAqxKoLtB9eadbmPMShAJzstfZSvHHFPrpj2i6YJRyd59EXm00";

            if (!$refreshToken) {
                // Redirect to the authentication URL if refresh token is not available
                return redirect()->route('gmail.auth');
            }

            $this->client->fetchAccessTokenWithRefreshToken($refreshToken);

            // Save the new access token to the client
            $accessToken = $this->client->getAccessToken();
            $this->client->setAccessToken($accessToken);
        }

        $messages = $gmail->users_messages->listUsersMessages('me', ['maxResults' => 20, 'q' => 'in:inbox']);

        $emails = [];

        if ($messages->getMessages()) {
            foreach ($messages->getMessages() as $message) {
                $msg = $gmail->users_messages->get('me', $message->getId());
                $headers = $msg->getPayload()->getHeaders();
                $parts = $msg->getPayload()->getParts();
                $email = [];

                foreach ($headers as $header) {
                    if ($header->getName() == 'From') {
                        $email['from'] = $header->getValue();
                    }
                    if ($header->getName() == 'Subject') {
                        $email['subject'] = $header->getValue();
                    }
                    if ($header->getName() == 'Date') {
                        $email['date'] = $header->getValue();
                    }
                }

                if ($parts) { // check if $parts is not null
                    foreach ($parts as $part) {
                        if ($part->mimeType == 'text/plain') {
                            $body = $part->body->data;
                        }
                        if ($part->mimeType == 'text/html') {
                            $body = $part->body->data;
                        }
                    }
                    $email['body'] = base64_decode(strtr($body, '-_', '+/'));
                } else {
                    $email['body'] = '';
                }
    
                $email['date'] = date('M jS Y g:i A', strtotime($headers[15]->getValue()));
    
                $emails[] = $email;
                $email['date'] = date('M jS Y g:i A', strtotime($headers[15]->getValue()));

                $emails[] = $email;
            }
        }

        return view('employees.gmail.inbox', compact('emails'));
    }
}
