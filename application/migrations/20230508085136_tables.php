<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_Tables extends CI_Migration { 

    public function up() { 
 
        $dir = __DIR__.'/tables/';

        $files = scandir($dir);

        $migs = [];

        foreach($files as $file) {
            if($file == '.' || $file == '..') continue;
            $data = explode(".", $file);
            $i = substr($data[0], 0,3);
            $migs[(int) $i] = [
                'file' => $dir . $file,
                'class' => substr($data[0], 4, 100)
            ];
        }


        foreach($migs as $migration) {
            require_once($migration['file']);
            $obj = new $migration['class'];
            $obj->down();
            $obj->up();

            if(method_exists($obj, 'seeder')) {
                $obj->seeder();
            }
        } 

    }

    public function down()
    {

    }


   
}