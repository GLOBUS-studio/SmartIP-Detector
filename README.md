# SmartIP-Detector

A universal class for determining the IP address of the client.

* Support for checking the header CloudFlare
* Address validation (IPv4 / IPv6)

# Use:
```
$test = new Smart_IP();
echo $test->ip();

// 101.120.84.52
```