<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PhilippineBarangaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!DB::table('philippine_barangays')->count()) {
            
            $sql = file_get_contents(__DIR__ . '/sql/philippine_barangays.sql');
            if (! str_contains($sql, ['DELETE', 'TRUNCATE'])) {
                throw new Exception('Invalid sql file. This will not empty the tables first.');
            }
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            foreach ($statements as $stmt) {
                DB::statement($stmt);
            }
        }
    }
}
