<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::beginTransaction();
        // Insert affiliates
        $affiliateIds = [];
        for ($i = 0; $i < 300; $i++) {
            $affiliateId = DB::table('affiliates')->insertGetId([
                'name' => $faker->word,
                'type' => $faker->numberBetween(1, 3),
                'deleted' => null
            ]);
            $affiliateIds[] = $affiliateId;
        }

        // Insert job categories
        $jobCategoriesIds = [];
        for ($i = 0; $i < 100; $i++) {
            $categoryId = DB::table('job_categories')->insertGetId([
                'name' => $faker->word,
                'sort_order' => $faker->numberBetween(1, 100),
                'created_by' => 'Admin',
                'created' => now(),
                'modified' => now(),
                'deleted' => null
            ]);
            $jobCategoriesIds[] = $categoryId;
        }

        // Insert job types
        $jobTypesIds = [];
        foreach ($jobCategoriesIds as $categoryId) {
            $typeId = DB::table('job_types')->insertGetId([
                'name' => $faker->word,
                'job_category_id' => $categoryId,
                'sort_order' => $faker->numberBetween(1, 100),
                'created_by' => 'Admin',
                'created' => now(),
                'modified' => now(),
                'deleted' => null
            ]);
            $jobTypesIds[] = $typeId;
        }

        // Insert jobs
        foreach ($jobTypesIds as $typeId) {
            DB::table('jobs')->insert([
                'name' => $faker->jobTitle,
                'media_id' => $faker->numberBetween(1, 10),
                'job_category_id' => $jobCategoriesIds[array_rand($jobCategoriesIds)],
                'job_type_id' => $typeId,
                'description' => $faker->paragraph,
                'detail' => $faker->text,
                'business_skill' => $faker->word,
                'knowledge' => $faker->word,
                'location' => $faker->city,
                'activity' => $faker->sentence,
                'academic_degree_doctor' => $faker->boolean(25),  // 25% probability
                'academic_degree_master' => $faker->boolean(25),
                'academic_degree_professional' => $faker->boolean(25),
                'academic_degree_bachelor' => $faker->boolean(50),  // 50% probability
                'salary_statistic_group' => $faker->randomLetter,
                'salary_range_first_year' => $faker->randomNumber(5),
                'salary_range_average' => $faker->randomNumber(5),
                'salary_range_remarks' => $faker->sentence,
                'restriction' => $faker->sentence,
                'estimated_total_workers' => $faker->randomNumber(3),
                'remarks' => $faker->sentence,
                'url' => $faker->url,
                'seo_description' => $faker->sentence,
                'seo_keywords' => $faker->words(3, true),
                'sort_order' => $faker->randomNumber(3),
                'publish_status' => $faker->boolean,
                'version' => $faker->randomDigit,
                'created_by' => 'Admin',
                'created' => now(),
                'modified' => now(),
                'deleted' => null
            ]);
        }

        // Insert personalities
        $personalityIds = [];
        for ($i = 0; $i < 100; $i++) {
            $personalityId = DB::table('personalities')->insertGetId([
                'name' => $faker->word,
                'deleted' => null
            ]);
            $personalityIds[] = $personalityId;
        }

        // Insert practical skills
        $skillIds = [];
        for ($i = 0; $i < 100; $i++) {
            $skillId = DB::table('practical_skills')->insertGetId([
                'name' => $faker->word,
                'deleted' => null
            ]);
            $skillIds[] = $skillId;
        }

        // Insert basic abilities
        $abilityIds = [];
        for ($i = 0; $i < 100; $i++) {
            $abilityId = DB::table('basic_abilities')->insertGetId([
                'name' => $faker->word,
                'deleted' => null
            ]);
            $abilityIds[] = $abilityId;
        }

        // Seed the relationship tables
        foreach (DB::table('jobs')->get() as $job) {
            foreach (array_rand($personalityIds, 5) as $index) {
                DB::table('jobs_personalities')->insert([
                    'job_id' => $job->id,
                    'personality_id' => $personalityIds[$index]
                ]);
            }

            foreach (array_rand($skillIds, 5) as $index) {
                DB::table('jobs_practical_skills')->insert([
                    'job_id' => $job->id,
                    'practical_skill_id' => $skillIds[$index]
                ]);
            }

            foreach (array_rand($abilityIds, 5) as $index) {
                DB::table('jobs_basic_abilities')->insert([
                    'job_id' => $job->id,
                    'basic_ability_id' => $abilityIds[$index]
                ]);
            }
            foreach (array_rand($affiliateIds, 5) as $index) {
                DB::table('jobs_tools')->insert([
                    'job_id' => $job->id,
                    'affiliate_id' => $affiliateIds[$index]
                ]);
            }

            foreach (array_rand($affiliateIds, min(5, count($affiliateIds))) as $index) {
                DB::table('jobs_req_qualifications')->insert([
                    'job_id' => $job->id,
                    'affiliate_id' => $affiliateIds[$index]
                ]);
            }

            foreach (array_rand($affiliateIds, min(5, count($affiliateIds))) as $index) {
                DB::table('jobs_rec_qualifications')->insert([
                    'job_id' => $job->id,
                    'affiliate_id' => $affiliateIds[$index]
                ]);
            }
        }

        DB::commit();
    }
}
