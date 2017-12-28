# angunasuktuq-saas-client
To speed development of this project, please donate to 

#mission
Angunasuktuq Client for Hunting Hackers by finding fingerprints in Logs

With this client you will be able to identify suspects transaction and ip addresses responsible for hacking servers or ecommerce. 

#installation

```
composer require jeanguybillard/angunasuktuq-saas-client
```

```
cp .env.example {projectdirectory}
```

And contact https://www.linkedin.com/in/jean-guy-billard-6186001/ for a security key 

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
# php sample code

used for identifying hackers ips address

``` php
use Angunasuktuq\Angunasuktuq;

$angunasuktuq = new Angunasuktuq($saasServer);
$angunasuktuq->load("/var/logs/access.log"); 
var_dump($angunasuktuq->getSuspects());
```

or for identifying fraudsters accounts


```
use Angunasuktuq\Angunasuktuq;

$angunasuktuq = new Angunasuktuq($saasServer);
$angunasuktuq->load("/data/sales.csv"); 
var_dump($angunasuktuq->getSuspects());
```

#curl example


```
curl --key '~/.ssh/id_rsa' --limit-rate 1M -i -X POST -H "Content-Type: multipart/form-data" 
-F "data=@/var/logs/access.log;userid=1234" http://{saas-server}/data/{analysis-name}/upload/

curl --key '~/.ssh/id_rsa' --limit-rate 1M -X POST http://{saas-server}/data/{analysis-name}/suspects/

```

or 


```
curl --key '~/.ssh/id_rsa' --limit-rate 1M -i -X POST -H "Content-Type: multipart/form-data" 
-F "data=@/data/sales.csv;userid=1234" http://{saas-server}/data/{analysis-name}/upload/

curl --key '~/.ssh/id_rsa' --limit-rate 1M -X POST http://{saas-server}/data/{analysis-name}/suspects/

```
