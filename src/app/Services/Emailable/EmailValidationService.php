<?php

declare(strict_types = 1);

namespace App\Services\Emailable;

use App\Contracts\EmailValidationInterface;
use App\DTO\EmailValidationResult;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Utils;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class EmailValidationService implements EmailValidationInterface
{

    public string $baseUrl = 'https://api.emailable.com/v1/';

    public function __construct(private string $apiKey)
    {
        
    }

    public function validate(string $email): EmailValidationResult
    {
        $maxRetry = 3;

        $stack = new HandlerStack();
        $stack->setHandler(Utils::chooseHandler());
        $stack->push($this->getRetryMiddleware($maxRetry));

        $client = new Client(
            [
                'base_uri' => $this->baseUrl,
                'timeout' => 5,
                'handler' => $stack,
            ]
        );
            
        $params = [
            'api_key' => $this->apiKey,
            'email' => $email
        ];


        $response = $client->get('verify?',['query' => $params] );

        
        $body = json_decode($response->getBody()->getContents(),true);
        
        return new EmailValidationResult($body['score'],$body['state'] === 'deliverable');

    }
    public function getRetryMiddleware(int $maxRetry) 
    {
       return  Middleware::retry(
            function(
                int $retries,
                RequestInterface $request,
                ?ResponseInterface $response,
                ?RuntimeException  $e       
            ) use($maxRetry){

                if($retries >= $maxRetry)
                {
                    return false;
                }
                if($response && in_array($response->getStatusCode(),[249, 429, 503,404]))
                {
                    echo 'Retrying [ '.$retries.'] Status:'. $response->getStatusCode().'<br>/';
                    return true;
                }
                if($e instanceof ConnectException){
                    echo 'Retrying ['. $retries .'] Connection Error <br/>';

                    return true;
                }

                return false;
            },
        );
    }
}
