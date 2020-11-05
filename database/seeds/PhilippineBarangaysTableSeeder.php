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
            ini_set('memory_limit', '-1');
            $sql = file_get_contents(__DIR__ . '/sql/philippine_barangays.sql');
            
            $sql = file_get_contents('C:\Users\Web developer PC\Desktop\ASLukbanWebsite\database\seeds\sql/philippine_barangays.sql');
            $array = explode(';',$sql);
            foreach(array_chunk($array,1000) as $lists){
                foreach($lists as $list){
                    DB::unprepared(DB::raw($list.';'));
                }
            }           
            
        }
    }
}
