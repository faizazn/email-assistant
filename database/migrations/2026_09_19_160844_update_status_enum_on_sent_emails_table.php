<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE sent_emails MODIFY status ENUM('draft', 'sent', 'failed') DEFAULT 'draft'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE sent_emails MODIFY status ENUM('sent', 'failed') DEFAULT 'sent'");
    }
};