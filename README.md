# laravel-ignition-deepseek-solution

Fix your Laravel exceptions with AI-powered solutions using DeepSeek. 
This package integrates DeepSeek AI with Laravel Ignition to provide intelligent error solutions for your Laravel applications. 

**Idea** - https://beyondco.de/blog/ai-powered-error-solutions-for-laravel.

## Features

- **AI-Powered Error Solutions**: Automatically generate solutions for Laravel exceptions using DeepSeek AI.
- **Easy Integration**: Seamlessly integrates with Laravel Ignition.
- **Customizable**: Configure the AI model, temperature, and caching behavior.
- **Development Focused**: Designed for use in development environments.

## Installation

You can install the package via composer:

```bash
  composer require nnovosad19/ai-solution --dev
```

**Note:** This package is intended for development purposes only. Do not use it in production.

## Publishing Configuration File:

Publish the DeepSeek configuration file:

```php artisan vendor:publish --tag=deepseek```

Publish the AI Solution configuration file:

```php artisan vendor:publish --tag=ai-solution```

## Environment Variables

After publishing the configuration files, add your DeepSeek API key to the .env file:

```DEEPSEEK_API_KEY="your_api_key"```

## Optional Configuration
You can customize the following settings in the ai-solution configuration file (config/ai-solution.php):

- **enable_ignition_solution**: Control module on/off enable ignition solution (default: on).
- **enable_exception_solution**: Control module on/off enable exception solution (default: on).
- **model**: The AI model to use (default: deepseek-chat).
- **temperature**: Controls the randomness of the AI's responses (default: 1.3).
- **cache_ttl**: Time-to-live for cached responses in seconds (default: 3600).

## Usage
Once installed and configured, the package will automatically provide AI-powered solutions for Laravel exceptions via Ignition.

## Contributing
Contributions are welcome! If you find a bug or have a feature request, please open an issue on GitHub.

## License
This package is open-source software licensed under the [MIT license](https://opensource.org/license/MIT).

## Support
If you encounter any issues or have questions, please open an issue on [GitHub](https://github.com/nnovosad/laravel-ignition-deepseek-solution).