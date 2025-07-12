<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel WebSockets + RabbitMQ Real-Time Chat

A Laravel 10 chat application with:

- 🧵 Real-time messaging via Laravel WebSockets  
- 📨 Notifications queued through RabbitMQ  
- 📧 Email alerts on chat messages and user registration  
- 🧑 Auth (login/register)
- 🔄 Broadcast chat messages using Echo + Pusher protocol

---

## 📦 1. How to Clone & Install

### Clone the repository

Choose **HTTPS** or **SSH**:

# HTTPS
git clone https://github.com/sashokrist/LaravelWedSoketsRabbitMQChat.git

# OR SSH
git clone git@github.com:sashokrist/LaravelWedSoketsRabbitMQChat.git

Then:

cd LaravelWedSoketsRabbitMQChat
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate

Configure your .env
Set your DB and Mailtrap credentials:

env

BROADCAST_DRIVER=pusher

QUEUE_CONNECTION=rabbitmq

PUSHER_APP_ID=local

PUSHER_APP_KEY=local

PUSHER_APP_SECRET=local

PUSHER_HOST=127.0.0.1

PUSHER_PORT=6001

PUSHER_SCHEME=http

PUSHER_APP_CLUSTER=mt1

MAIL_MAILER=smtp

MAIL_HOST=smtp.mailtrap.io

MAIL_PORT=2525

MAIL_USERNAME=your_mailtrap_user

MAIL_PASSWORD=your_mailtrap_pass

MAIL_ENCRYPTION=null

MAIL_FROM_ADDRESS=chat@example.com

MAIL_FROM_NAME="Laravel Chat"

RABBITMQ_HOST=127.0.0.1

RABBITMQ_PORT=5672

RABBITMQ_USER=guest

RABBITMQ_PASSWORD=guest

RABBITMQ_VHOST=/

Run migrations

php artisan migrate

2. How to Run
Make sure the following services are running:

MySQL (via XAMPP or similar)

RabbitMQ (http://localhost:15672)

Laravel WebSockets

# Start Laravel WebSocket server
php artisan websockets:serve

# Start the Laravel queue worker (uses RabbitMQ)
php artisan queue:work
php artisan queue:work rabbitmq
npm run dev

# Serve the app
php artisan serve

Visit: http://localhost:8000

3. Functionality Overview
✅ Authentication
User registration/login using Laravel Breeze.

Registration sends welcome email (via Mailtrap).

💬 Real-Time Chat
Authenticated users can send messages.

Messages are broadcast live via WebSockets.

Chat messages are saved and broadcast using MessageSent event.

📨 Queued Notifications
When a message is sent:

A job (NotifyChatUser) is dispatched using RabbitMQ.

Logs the message content to the Laravel log.

Sends an email to a test address (e.g., Mailtrap).

📧 Email Integration
Emails sent via Mailtrap.

On user registration: Welcome email.

On chat message sent: "New Chat Message" email.

🛠️ Stack
Laravel 10

Laravel WebSockets (beyondcode/laravel-websockets)

RabbitMQ (via vladimir-yuldashev/laravel-queue-rabbitmq)

Mailtrap for testing emails

Pusher-compatible WebSocket frontend via Laravel Echo

🧪 Testing
After registering and logging in, open two browser tabs:

Send a message in one.

See it appear in the other in real time.

Confirm the log and Mailtrap email.

✅ TODO
 Real-time WebSockets

 Queued job via RabbitMQ

 Email integration

 Minimal frontend
