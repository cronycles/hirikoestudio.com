<?php

use Illuminate\Database\Seeder;

class LocalesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('locales')->delete();

        DB::table('locales')->insert(array(
                array(
                    'code' => 'es',
                    'culture_code' => 'es_ES',
                    'name' => json_encode([
                        "en" => "Spanish",
                        "es" => "Español",
                        "eu" => "Español"
                    ]),
                    'default' => true,
                    'enabled' => true,
                    'visible' => true,
                    'auth_visible' => true,
                ),
                array(
                    'code' => 'eu',
                    'culture_code' => 'eu_ES',
                    'name' => json_encode([
                        "en" => "Basque",
                        "es" => "Euskera",
                        "eu" => "Euskara"
                    ]),
                    'default' => false,
                    'enabled' => false,
                    'visible' => true,
                    'auth_visible' => false,
                ),
                array(
                    'code' => 'en',
                    'culture_code' => 'en_EU',
                    'name' => json_encode([
                        "en" => "English",
                        "es" => "Inglés",
                        "eu" => "Inglés"
                    ]),
                    'default' => false,
                    'enabled' => false,
                    'visible' => true,
                    'auth_visible' => false,
                )
            )
        );
    }
}
