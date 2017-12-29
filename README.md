# angunasuktuq-saas-client

To speed development of this project, please donate to 

# mission

Angunasuktuq Client for Hunting Hackers by finding fingerprints in Logs

With this client you will be able to identify suspects transaction and ip addresses responsible for hacking servers or ecommerce. 

# installation


``` sh
composer require jeanguybillard/angunasuktuq-saas-client
```

# setup
``` sh
cp .env.example {projectdirectory}/.env
```

And contact https://www.linkedin.com/in/jean-guy-billard-6186001/ for a security key 

Set the secret key and the server address in .env file

``` ini
Angunasuktuq-saas-server-address = "127.0.0.1"
Angunasuktuq-security-key = "/ZeNeDRjYkWJ6A1HI8dM8A=="
``` 

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
# php sample code

used for identifying hackers ips address

``` php
use Angunasuktuq\Angunasuktuq;

$angunasuktuq = new Angunasuktuq($saasServer);
$angunasuktuq->load("/var/logs/access.log"); 
var_dump($angunasuktuq->getSuspects());
```

or for identifying fraudsters accounts


``` php
use Angunasuktuq\Angunasuktuq;

$angunasuktuq = new Angunasuktuq($saasServer);
$angunasuktuq->load("/data/sales.csv"); 
var_dump($angunasuktuq->getSuspects());
```

# curl example


``` sh
curl --key '~/.ssh/id_rsa' --limit-rate 1M -i -X POST -H "Content-Type: multipart/form-data" 
-F "data=@/var/logs/access.log;userid=1234" http://{saas-server}/data/{analysis-name}/upload/

curl --key '~/.ssh/id_rsa' --limit-rate 1M -X POST http://{saas-server}/data/{analysis-name}/suspects/

```

or 


``` sh
curl --key '~/.ssh/id_rsa' --limit-rate 1M -i -X POST -H "Content-Type: multipart/form-data" 
-F "data=@/data/sales.csv;userid=1234" http://{saas-server}/data/{analysis-name}/upload/

curl --key '~/.ssh/id_rsa' --limit-rate 1M -X POST http://{saas-server}/data/{analysis-name}/suspects/

```
