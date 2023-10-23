# SmartIP-Detector

`SmartIP-Detector` is a robust PHP class designed to accurately determine the client's IP address, regardless of the environment. This solution is critical for applications requiring precise user location, ranging from security features like fraud detection to functionality enhancements such as content localization.

## Features

- **Cloudflare Support:** Seamlessly retrieves the user's original IP address forwarded by Cloudflare using the `CF-Connecting-IP` header. Essential for applications behind Cloudflare's protective infrastructure.
- **Comprehensive IP Validation:** Rigorously validates IP addresses to ensure they conform to IPv4 or IPv6 standards, thereby avoiding erroneous data and potential security vulnerabilities.
- **Dependability:** Gracefully handles a plethora of scenarios by employing a series of fallback mechanisms, ensuring an accurate IP detection regardless of server configuration or HTTP headers presence.

## Installation

Simply incorporate the `Smart_IP` class into your PHP project. You can manually add the `Smart_IP.php` file to your project or potentially use a package manager if the class is available as a package in the future (e.g., via Composer).

```php
require_once 'path_to/Smart_IP.php';
```

## Usage

Instantiate a new Smart_IP object and then call the ip() method to retrieve the client's IP address. The method returns a string containing a valid IP address if available; otherwise, it returns a default value.

```php
$detector = new Smart_IP();
echo $detector->ip();

// Output: "101.120.84.52" (example output, actual result will vary)
```

## Contribution

Contributions to improve SmartIP-Detector are welcome! Feel free to fork the repository and submit pull requests. For major changes, please open an issue first to discuss what you would like to change. Please ensure to update tests as appropriate.

## License

SmartIP-Detector is open-sourced software licensed under the MIT license.