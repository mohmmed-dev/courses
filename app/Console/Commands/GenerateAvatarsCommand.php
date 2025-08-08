<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Helpers\Avatars;
class GenerateAvatarsCommand extends Command
{
    protected $signature = 'avatars:generate {count=100}';
    protected $description = 'Generates a set of unique avatars and stores them in the database.';

    public function handle()
    {
        $count = $this->argument('count');
        $this->info("Generating $count avatars...");

        $multiavatar = new Avatars;

        for ($i = 0; $i < $count; $i++) {
            $svgCode = $multiavatar->generateAvatar(uniqid());
            DB::table('avatars')->insert(['svg_code' => $svgCode]);
        }

        $this->info("Avatars generated successfully!");
        return 0;
    }
}
