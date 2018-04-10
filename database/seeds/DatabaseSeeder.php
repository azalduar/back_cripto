<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('ratings')->insert([
            ['name' => 'EARLY CHILDHOOD' ],
            ['name' => 'EVERYONE' ],
            ['name' => 'EVERYONE 10+' ],
            ['name' => 'TEEN' ],
            ['name' => 'MATURE' ],
            ['name' => 'ADULTS ONLY' ],
            ['name' => 'RATING PENDING' ]
        ]);

        DB::table('tags')->insert([
            ['name' => '#PS4' ],
            ['name' => '#XD' ],
            ['name' => '#PS3' ],
            ['name' => '#XBox' ],
            ['name' => '#Microsof' ],
            ['name' => '#LinuxEsLaLey' ],
            ['name' => '#ValeVergaLaBida' ],
            ['name' => '#AlejoPongame5' ],
            ['name' => '#11Troncos' ],
            ['name' => '#NosCambiaronDeSalon' ],
            ['name' => '#LaravelBackend' ],
            ['name' => '#AngularDamier' ],

        ]);

        DB::table('categories')->insert([
            ['name' => 'Action' ],
            ['name' => 'Adventure' ],
            ['name' => 'Sports' ],
            ['name' => 'Creativity' ],
            ['name' => 'Skill' ],
            ['name' => 'Racing' ],
            ['name' => 'Casino' ],
            ['name' => 'Multiplayer' ],
            ['name' => 'Table Games' ]
        ]);

        DB::table('platforms')->insert([
            ['name' => 'PlayStation' , 'logo'=>'http://cdn2.gamedots.mx/media/gd/styles/gallerie/public/images/2014/12/pslogo.jpg'],
            ['name' => 'Xbox' , 'logo'=>'https://1.bp.blogspot.com/-OUbqDj9Rmt8/Tag4cuQkvEI/AAAAAAAAAjY/d8jkseuqK4s/w800-h800/xbox360-logo-xonly.jpg'],
            ['name' => 'Nintendo' , 'logo'=>'https://pixel2pixel.files.wordpress.com/2011/04/nintendo-logo-mario.jpg'],
            ['name' => 'PC' , 'logo'=>'http://game-smack.net/wp-content/uploads/2014/08/PC_DVD_logo-620x531.jpg'],
        ]);


        DB::table('users')->insert([
            /*['name' => 'Oscar Parra', 'avatar'=> null, 'nickname'=>'Admin', 'email' => 'oscar.parra@mixedmedia-ad.com', 'password' => bcrypt('m1x3dm3d14'), 'is_activated'=>0 ],
            ['name'=>'Oscar Parra', 'avatar'=>'https://goo.gl/Siv8ba', 'nickname'=>'Odparraj', 'email'=>'odparraj@unal.edu.co', 'password'=>bcrypt('123456'), 'is_activated'=>1],
            ['name'=>'Alejandra Zaldua', 'avatar'=>'https://goo.gl/dSeJ1C', 'nickname'=>'Dzalduar', 'email'=>'dzalduar@unal.edu.co', 'password'=>bcrypt('123456'), 'is_activated'=>1],
            ['name'=>'Edilberto Canon', 'avatar'=>'https://goo.gl/wBLRCK', 'nickname'=>'Ecanonp', 'email'=>'ecanonp@unal.edu.co', 'password'=>bcrypt('123456'), 'is_activated'=>1],
            ['name'=>'Camilo Neiva', 'avatar'=>'https://goo.gl/TrBUHo', 'nickname'=>'Jcneivaa', 'email'=>'jcneivaa@unal.edu.co', 'password'=>bcrypt('123456'), 'is_activated'=>1],
            ['name'=>'Juan Cuestas', 'avatar'=>'https://goo.gl/mjvhAU', 'nickname'=>'Jmcuestasb', 'email'=>'jmcuestasb@unal.edu.co', 'password'=>bcrypt('123456'), 'is_activated'=>1],
            ['name'=>'US1', 'avatar'=>'https://goo.gl/Mntd1R', 'nickname'=>'US1', 'email'=>'us1@t.com', 'password'=>bcrypt('123456'), 'is_activated'=>1],
            ['name'=>'US2', 'avatar'=>'https://goo.gl/Mntd1R', 'nickname'=>'US2', 'email'=>'us2@t.com', 'password'=>bcrypt('123456'), 'is_activated'=>1],
            ['name'=>'US3', 'avatar'=>'https://goo.gl/Mntd1R', 'nickname'=>'US3', 'email'=>'us3@t.com', 'password'=>bcrypt('123456'), 'is_activated'=>1],*/
            ['email'=>'cclozanoj@unal.edu.co','nickname'=>'cclozanoj','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Cristian Lozano', 'is_activated'=>1],
            ['email'=>'dcnavarreter@unal.edu.co','nickname'=>'dcnavarreter','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Diana Navarrete', 'is_activated'=>1],
            ['email'=>'dzalduar@unal.edu.co','nickname'=>'dzalduar','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Alejandra Zaldua', 'is_activated'=>1],
            ['email'=>'ecanonp@unal.edu.co','nickname'=>'ecanonp','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Edilberto Canon', 'is_activated'=>1],
            ['email'=>'jcneivaa@unal.edu.co','nickname'=>'jcneivaa','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Camilo Neiva', 'is_activated'=>1],
            ['email'=>'jmcuestasb@unal.edu.co','nickname'=>'jmcuestasb','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Juan Cuestas', 'is_activated'=>1],
            ['email'=>'joaortizro@unal.edu.co','nickname'=>'joaortizro','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Jonas Ortiz', 'is_activated'=>1],
            ['email'=>'jrmolanor@unal.edu.co','nickname'=>'jrmolanor','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Jose Molano', 'is_activated'=>1],
            ['email'=>'luealfonsoru@unal.edu.co','nickname'=>'luealfonsoru','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Luis Alfonso', 'is_activated'=>1],
            ['email'=>'odparraj@unal.edu.co','nickname'=>'odparraj','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Oscar Parra', 'is_activated'=>1],
            ['email'=>'raaramirezpe@unal.edu.co','nickname'=>'raaramirezpe','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Raul Ramirez', 'is_activated'=>1],
            ['email'=>'sablancom@unal.edu.co','nickname'=>'sablancom','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Santiago Blanco', 'is_activated'=>1],
            //['email'=>'sacastroc@unal.edu.co','nickname'=>'sacastroc','avatar'=>'https://goo.gl/Mntd1R','password'=>bcrypt('123456'),'name'=>'Sergio Castro', 'is_activated'=>1],
        ]);        

        DB::table('games')->insert([
            [
                'name' => 'Call Of Duty',
                'image' => 'https://goo.gl/HPTCzE',
                'rating_id'=> 4 
            ],
            [
                'name' => 'Super Mario',
                'image' => 'https://goo.gl/nqxEYb',
                'rating_id'=> 2
            ],
            [
                'name' => 'Crash Racing',
                'image' => 'https://goo.gl/WQkHmT',
                'rating_id'=> 2
            ],
            [
                'name' => 'Minecraft',
                'image' => 'https://goo.gl/5jk5nS',
                'rating_id'=> 2
            ],
            [
                'name' => 'Halo',
                'image' => 'https://goo.gl/J8vJKW',
                'rating_id'=> 4
            ],
            [
                'name' => 'FIFA',
                'image' => 'https://goo.gl/gpUCfv',
                'rating_id'=> 3
            ],
            [
                'name' => 'PES',
                'image' => 'https://goo.gl/fkeXCa',
                'rating_id'=> 3
            ]
            
        ]);

        DB::table('game_tag')->insert([
            [
                'game_id' => 1,
                'tag_id' => 1
            ],
            [
                'game_id' => 1,
                'tag_id' => 2
            ],
            [
                'game_id' => 1,
                'tag_id' => 3
            ],
            [
                'game_id' => 1,
                'tag_id' => 4
            ],
            [
                'game_id' => 2,
                'tag_id' => 1
            ],
            [
                'game_id' => 2,
                'tag_id' => 2
            ],
            [
                'game_id' => 2,
                'tag_id' => 3
            ],
            [
                'game_id' => 2,
                'tag_id' => 4
            ],
            [
                'game_id' => 3,
                'tag_id' => 1
            ],
            [
                'game_id' => 3,
                'tag_id' => 2
            ],
            [
                'game_id' => 3,
                'tag_id' => 3
            ],
            [
                'game_id' => 3,
                'tag_id' => 4
            ],
            [
                'game_id' => 4,
                'tag_id' => 1
            ],
            [
                'game_id' => 4,
                'tag_id' => 2
            ],
            [
                'game_id' => 4,
                'tag_id' => 3
            ],
            [
                'game_id' => 4,
                'tag_id' => 4
            ],
            [
                'game_id' => 5,
                'tag_id' => 1
            ],
            [
                'game_id' => 5,
                'tag_id' => 2
            ],
            [
                'game_id' => 5,
                'tag_id' => 3
            ],
            [
                'game_id' => 5,
                'tag_id' => 4
            ],

        ]);

        DB::table('game_user')->insert([
            [
                'game_id' => 1,
                'user_id' => 2
            ],
            [
                'game_id' => 1,
                'user_id' => 3
            ],
            [
                'game_id' => 1,
                'user_id' => 4
            ],
            [
                'game_id' => 1,
                'user_id' => 5
            ],
            [
                'game_id' => 1,
                'user_id' => 6
            ],
            [
                'game_id' => 2,
                'user_id' => 2
            ],
            [
                'game_id' => 2,
                'user_id' => 3
            ],
            [
                'game_id' => 2,
                'user_id' => 4
            ],
            [
                'game_id' => 2,
                'user_id' => 5
            ],
            [
                'game_id' => 2,
                'user_id' => 6
            ],
            [
                'game_id' => 3,
                'user_id' => 2
            ],
            [
                'game_id' => 3,
                'user_id' => 3
            ],
            [
                'game_id' => 3,
                'user_id' => 4
            ],
            [
                'game_id' => 3,
                'user_id' => 5
            ],
            [
                'game_id' => 3,
                'user_id' => 6
            ],
        ]);

        $sections= [
            ['display_name' => 'Users', 'icon' => 'glyphicon glyphicon-user', 'route' => 'admin_users'],
            ['display_name' => 'Categories', 'icon' => 'glyphicon glyphicon-link', 'route' => 'categories'],
            ['display_name' => 'Games', 'icon' => 'glyphicon glyphicon-link', 'route' => 'games'],
            ['display_name' => 'Platforms', 'icon' => 'glyphicon glyphicon-link', 'route' => 'platforms'],
            ['display_name' => 'Ratings', 'icon' => 'glyphicon glyphicon-link', 'route' => 'ratings'],
            ['display_name' => 'Tags', 'icon' => 'glyphicon glyphicon-link', 'route' => 'tags']
        ];

        DB::table('sections')->insert($sections);

        $permissions= [];

        $permissions[]= ['name' => 'sections'];

        foreach ($sections as $key => $section) {
            $permissions[]= ['name' => $section['route'].'_create'];
            $permissions[]= ['name' => $section['route'].'_read'];
            $permissions[]= ['name' => $section['route'].'_update'];
            $permissions[]= ['name' => $section['route'].'_delete'];
        }

        DB::table('permissions')->insert($permissions);      

        $assign_permisions=[];

        foreach ($permissions as $key => $value) {
            $assign_permisions[]= ['user_id' => 10,  'permission_id' => $key + 1];
        }

        DB::table('permission_user')->insert($assign_permisions);

        Db::table('roles')->insert([
            ['name'=>'admin'],
            ['name'=>'usuario']
        ]);

        DB::table('role_user')->insert([
            ['role_id'=>1, 'user_id' => 10]
        ]);

        DB::table('friendships')->insert([
            [
                'sender_id' =>2,
                'recipient_id' => 3,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ],
            [
                'sender_id' =>2,
                'recipient_id' => 4,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ],
            [
                'sender_id' =>2,
                'recipient_id' => 5,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ],
            [
                'sender_id' =>3,
                'recipient_id' => 4,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ],
            [
                'sender_id' =>3,
                'recipient_id' => 5,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ],
            [
                'sender_id' =>3,
                'recipient_id' => 6,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ],
            [
                'sender_id' =>4,
                'recipient_id' => 5,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ],
            [
                'sender_id' =>4,
                'recipient_id' => 6,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ],
            [
                'sender_id' =>5,
                'recipient_id' => 6,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ],
            [
                'sender_id' =>1,
                'recipient_id' => 2,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ],
            [
                'sender_id' =>1,
                'recipient_id' => 8,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ],
            [
                'sender_id' =>1,
                'recipient_id' => 7,
                'sender_type'=> 'App\User',
                'recipient_type'=> 'App\User',
                'status'=> 1,
            ]
        ]);
        DB::table('oauth_clients')->insert([
            [
                'user_id'=> NULL,
                'name' => 'Laravel Personal Access Client',
                'secret'=> 'XOOnvGX9QKNpWp6yXEiQvYFOs86xQ6pky3dsspff',
                'redirect'=> 'http://localhost',
                'personal_access_client'=> 1,
                'password_client'=> 0,
                'revoked'=> 0,
                'created_at'=> '2017-11-16 01:49:33',
                'updated_at'=> '2017-11-16 01:49:33'
            ],
            [
                'user_id'=> NULL,
                'name' => 'Laravel Password Grant Client',
                'secret'=> 'UKKjD5RypLr3WZ29ChN7UopPmXuh6T29v6kkJcvX',
                'redirect'=> 'http://localhost',
                'personal_access_client'=> 0,
                'password_client'=> 1,
                'revoked'=> 0,
                'created_at'=> '2017-11-16 01:49:33',
                'updated_at'=> '2017-11-16 01:49:33'
            ]
        ]);

        DB::table('oauth_personal_access_clients')->insert([
            [
                'client_id'=> 1,
                'created_at'=> '2017-11-16 01:49:33',
                'updated_at'=> '2017-11-16 01:49:33'
            ]
        ]);

        //Artisan::call('passport:install');
    }
}
