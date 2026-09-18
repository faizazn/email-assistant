# Email Assistant

Laravel app that generates AI-written emails from prompt templates and sends them to saved contacts.

## Stack
- Laravel 13
- Hugging Face Inference API (gpt-oss-120b)
- Mailtrap (dev SMTP)
- Bootstrap 5

## Setup

\`\`\`bash
git clone <repo-url>
cd email-assistant
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
\`\`\`

## Configuration

Add to `.env`:
- `HUGGING_FACE_TOKEN` — from huggingface.co/settings/tokens
- `MAIL_USERNAME` / `MAIL_PASSWORD` — from your Mailtrap inbox settings

## How it works

1. Add contacts (name + email)
2. Add prompt templates — use `{friend_name}` as a placeholder
3. On the home page, pick a contact and a prompt
4. Submit — the AI generates the message and it's emailed to the contact

