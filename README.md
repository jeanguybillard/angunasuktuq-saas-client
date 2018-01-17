
# angunasuktuq-saas-client

This library made by Hacking Experts Community detects servers responsible for the DDOS Attacks. It works by uploading sample data to Angunasuktuq-Server where complexe calculation and analysis is performed; the result will be a list of potentials culporate ip addresses, that should be blacklisted.

# mission

Corporation recognize that DDoS attacks can be costly. THe story of bitconnect is the perfect example on how important it is to protect against DDoS. https://bitconnect.co/system-news/94/changes-coming-for-the-bitconnect-system-halt-of-lending-and-exchange-platform

Angunasuktuq-Client library Hunts in realtime Hackers by finding their fingerprints in your server access logs, and blocking them before they bring the site down. 

# installation

``` sh
composer require jeanguybillard/angunasuktuq-saas-client
```

# setup

Here is how to configure the Saas service 

Get AngunasukTuk' IP Server and API security key by contacting https://www.linkedin.com/in/jean-guy-billard-6186001/ and asking for a security key. 

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
# php example

Here is an example for loading access log data and retrieve suspected hacker's ip addresses

``` php
use Angunasuktuq;

$angunasuktuq = new Angunasuktuq([
                                 "account-id" => "24b55f4d-6a60-43bc-a627-9a57acce210d",
                                 "account-name" => "redtube.com",
                                 "report-name" => "access-log-analysis",
                                 "saas-server-address" => "127.0.0.1",
                                 "saas-api-key" => "b5b6a39e-6253-4b08-a83a-6412-ae26360f"
                              ]);
$angunasuktuq->load("/var/logs/access.log"); 
var_dump($angunasuktuq->getSuspects());
```

# curl example

Here is the same example but with curl.

``` sh
curl --key '~/.ssh/id_rsa' --limit-rate 1M -i -X POST 
-H "Content-Type: multipart/form-data"
-H "Authorisation: Bearer b5b6a39e-6253-4b08-a83a-6412-ae26360f" 
-F "data=@/var/logs/access.log;account-id='24b55f4d-6a60-43bc-a627-9a57acce210d';" 
https://127.0.0.1/redtube.com/data/access-log-analysis/upload/

curl --key '~/.ssh/id_rsa' --limit-rate 1M -X POST 
-H "Authorisation: Bearer b5b6a39e-6253-4b08-a83a-6412-ae26360f" 
-F "account-id='24b55f4d-6a60-43bc-a627-9a57acce210d'"
http://127.0.0.1/redtube.com/data/access-log-analysis/suspects/

```

# reference 

This service is base on white papers publish on blackhat.com; https://www.blackhat.com/docs/us-17/thursday/us-17-Prandl-PEIMA-Harnessing-Power-Laws-To-Detect-Malicious-Activities-From-Denial-Of-Service-To-Intrusion-Detection-Traffic-Analysis-And-Beyond-wp.pdf

Also, This sercie use advance mathematical calculation for detecting fraud as defined by the Association Certified Fraud Examiner http://www.acfe.com/Benfords/ 
