# Starshop

Your monopoly-busting option for Starship parts!

## Description

Starshop is a Symfony-based web application designed to provide an alternative marketplace for Starship components and parts.

## Requirements

- PHP 8.2 or higher
- Composer
- Symfony CLI (optional but recommended)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/starshop.git
cd starshop
```

2. Install dependencies:
```bash
composer install
```

3. Start the development server:
```bash
symfony server:start
```

Or using PHP's built-in server:
```bash
php -S localhost:8000 -t public/
```

4. Visit `http://localhost:8000` in your browser

## Project Structure

```
starshop/
├── bin/                    # Symfony console binary
├── config/                 # Configuration files
├── public/                 # Web root directory
├── src/                    # Application source code
│   └── Controller/         # Controllers
├── var/                    # Cache and logs (auto-generated)
└── vendor/                 # Composer dependencies
```

## Development

This project uses:
- Symfony 7.3
- PHP 8.2+
- Composer for dependency management

## License

This project is proprietary software.

## Contributing

This is a personal project. For questions or suggestions, please open an issue on GitHub. 