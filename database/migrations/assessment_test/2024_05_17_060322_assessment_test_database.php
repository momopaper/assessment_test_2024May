<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssessmentTestDatabase extends Migration
{
    public function up()
    {
        Schema::create('personalities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('deleted')->nullable();
        });

        Schema::create('practical_skills', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('deleted')->nullable();
        });

        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('type')->nullable();
            $table->boolean('deleted')->nullable();
        });

        Schema::create('basic_abilities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('deleted')->nullable();
        });

        Schema::create('job_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('sort_order')->nullable();
            $table->string('created_by')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
            $table->boolean('deleted')->nullable();
        });

        Schema::create('job_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('job_category_id')->nullable();
            $table->integer('sort_order')->nullable();
            $table->string('created_by')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
            $table->boolean('deleted')->nullable();
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('media_id')->nullable();
            $table->integer('job_category_id')->nullable();
            $table->integer('job_type_id')->nullable();
            $table->text('description')->nullable();
            $table->text('detail')->nullable();
            $table->text('business_skill')->nullable();
            $table->text('knowledge')->nullable();
            $table->string('location')->nullable();
            $table->text('activity')->nullable();
            $table->boolean('academic_degree_doctor')->nullable();
            $table->boolean('academic_degree_master')->nullable();
            $table->boolean('academic_degree_professional')->nullable();
            $table->boolean('academic_degree_bachelor')->nullable();
            $table->string('salary_statistic_group')->nullable();
            $table->string('salary_range_first_year')->nullable();
            $table->string('salary_range_average')->nullable();
            $table->string('salary_range_remarks')->nullable();
            $table->text('restriction')->nullable();
            $table->integer('estimated_total_workers')->nullable();
            $table->text('remarks')->nullable();
            $table->string('url')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->integer('sort_order')->nullable();
            $table->boolean('publish_status')->nullable();
            $table->integer('version')->nullable();
            $table->string('created_by')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
            $table->boolean('deleted')->nullable();
        });

        Schema::create('jobs_basic_abilities', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('basic_ability_id');
            $table->primary(['job_id', 'basic_ability_id']);
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('basic_ability_id')->references('id')->on('basic_abilities')->onDelete('cascade');
        });

        Schema::create('jobs_career_paths', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('affiliate_id');
            $table->primary(['job_id', 'affiliate_id']);
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('affiliate_id')->references('id')->on('affiliates')->onDelete('cascade');
        });

        Schema::create('jobs_personalities', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('personality_id');
            $table->primary(['job_id', 'personality_id']);
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('personality_id')->references('id')->on('personalities')->onDelete('cascade');
        });

        Schema::create('jobs_practical_skills', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('practical_skill_id');
            $table->primary(['job_id', 'practical_skill_id']);
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('practical_skill_id')->references('id')->on('practical_skills')->onDelete('cascade');
        });

        Schema::create('jobs_rec_qualifications', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('affiliate_id');
            $table->primary(['job_id', 'affiliate_id']);
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('affiliate_id')->references('id')->on('affiliates')->onDelete('cascade');
        });

        Schema::create('jobs_req_qualifications', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('affiliate_id');
            $table->primary(['job_id', 'affiliate_id']);
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('affiliate_id')->references('id')->on('affiliates')->onDelete('cascade');
        });

        Schema::create('jobs_tools', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('affiliate_id');
            $table->primary(['job_id', 'affiliate_id']);
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('affiliate_id')->references('id')->on('affiliates')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs_tools');
        Schema::dropIfExists('jobs_req_qualifications');
        Schema::dropIfExists('jobs_rec_qualifications');
        Schema::dropIfExists('jobs_practical_skills');
        Schema::dropIfExists('jobs_personalities');
        Schema::dropIfExists('jobs_career_paths');
        Schema::dropIfExists('jobs_basic_abilities');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_types');
        Schema::dropIfExists('job_categories');
        Schema::dropIfExists('basic_abilities');
        Schema::dropIfExists('affiliates');
        Schema::dropIfExists('practical_skills');
        Schema::dropIfExists('personalities');
    }
}
