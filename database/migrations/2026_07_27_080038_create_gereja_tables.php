<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // church_categories
        Schema::create('church_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('slug', 120)->unique();
            $table->text('description')->nullable();
            $table->string('icon_path')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // churches
        Schema::create('churches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_category_id')->constrained('church_categories')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('name', 150);
            $table->string('slug', 180)->unique();
            $table->text('address');
            $table->string('district', 100)->nullable();
            $table->string('city', 100)->default('Makassar');
            $table->string('province', 100)->default('Sulawesi Selatan');
            $table->string('postal_code', 10)->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->longText('description')->nullable();
            $table->longText('worship_guide')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('website_url')->nullable();
            $table->unsignedMediumInteger('capacity')->nullable();
            $table->string('main_image_path')->nullable();
            $table->enum('verification_status', ['draft', 'verified', 'rejected'])->default('draft');
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // worship_schedules
        Schema::create('worship_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->constrained('churches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title', 120);
            $table->unsignedTinyInteger('day_of_week');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->string('preacher_name', 120)->nullable();
            $table->string('language', 50)->default('Indonesia');
            $table->text('description')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->boolean('is_recurring')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // facilities
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('slug', 120)->unique();
            $table->string('icon_name', 100)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // church_facility
        Schema::create('church_facility', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->constrained('churches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('facility_id')->constrained('facilities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->unique(['church_id', 'facility_id']);
        });

        // activities
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->constrained('churches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title', 160);
            $table->string('slug', 190)->unique();
            $table->longText('description')->nullable();
            $table->string('location_name', 160)->nullable();
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->string('image_path')->nullable();
            $table->string('registration_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // announcements
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->nullable()->constrained('churches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title', 160);
            $table->longText('content');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at')->nullable();
            $table->enum('priority', ['low', 'normal', 'high'])->default('normal');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // articles
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('title', 180);
            $table->string('slug', 210)->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('thumbnail_path')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // church_images
        Schema::create('church_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->constrained('churches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_cover')->default(false);
            $table->timestamps();
        });

        // favorites
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('church_id')->constrained('churches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->unique(['user_id', 'church_id']);
        });

        // notification_preferences
        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('worship_schedule_id')->constrained('worship_schedules')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedSmallInteger('reminder_minutes')->default(30);
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_scheduled_at')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'worship_schedule_id']);
        });

        // search_histories
        Schema::create('search_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('query')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('church_categories')->nullOnDelete()->cascadeOnUpdate();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer('results_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('search_histories');
        Schema::dropIfExists('notification_preferences');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('church_images');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('church_facility');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('worship_schedules');
        Schema::dropIfExists('churches');
        Schema::dropIfExists('church_categories');
    }
};
