# Real-Time Multiplayer Tic Tac Toe

## Project Overview

This is a real-time multiplayer Tic Tac Toe game built with Laravel, Livewire, and Reverb, featuring instant move synchronization and a responsive design.

## Features

- Real-time multiplayer gameplay
- Instant move synchronization
- Responsive and modern UI
- Win/draw detection
- Player turn management
- Game reset functionality

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP 8.2+
- Composer
- Node.js and npm
- Laravel 11
- A local development environment (MAMP, XAMPP, or similar)

## Installation Steps

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/tic-tac-toe.git
cd tic-tac-toe
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Create Environment File

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Configure Database

1. Open `.env` file
2. Set up your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Set Up Reverb (Real-Time Communication)

```bash
php artisan reverb:install
php artisan reverb:start
```

### 9. Compile Frontend Assets

```bash
npm run dev
```

### 10. Start Laravel Development Server

```bash
php artisan serve
```

## Running the Application

Open your browser and navigate to `http://localhost:8000`

## Multiplayer Gameplay

1. Register/Login two different users
2. First user starts as Player X
3. Second user automatically becomes Player O
4. Take turns clicking on the grid
5. Game detects wins and draws automatically

## Troubleshooting

- Ensure all dependencies are installed
- Check database connection
- Verify Reverb is running
- Clear config cache: `php artisan config:clear`

## Technologies Used

- Laravel
- Livewire
- Reverb
- Tailwind CSS
- WebSockets

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<!-- ## License

Distributed under the MIT License. See `LICENSE` for more information. -->

## Contact

Your Name - [Yushabh Dhande](https://dub.sh/yushabh-dhande)

Project Link: [https://github.com/yush2428/reverb_tic_tac_toe](https://github.com/yush2428/reverb_tic_tac_toe)