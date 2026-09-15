<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Micro;
use App\Models\Board;
use App\Models\Img;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //کاربر‌ها
        $users = [
            [
                'name' => 'سجاد پیله‌ور',
                'email' => 'zohancity@gmail.com',
                'src' => 'assets/img/user/sad-jad.png',
            ],
            [
                'name' => 'دانیال فرزین',
                'email' => 'danial.farzin101@gmail.com',
            ],
            [
                'name' => 'محمدپویا ابراهیم‌آبادی',
                'email' => 'amirpouya8513@gmail.com',
            ]
        ];
        foreach($users as $user){
            $createdUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
            ]);
            if(isset($user['src'])) {
                Img::create([
                    'typable_id' => $createdUser->id,
                    'typable_type' => User::class,
                    'type' => Img::TYPE_ICON,
                    'path' => $user['src'],
                ]);
            }
        }

        //پروژه‌ها
        $projects = ['حضور غیاب'];
        foreach($projects as $title){
            Project::create([
                'user_id' => 1,
                'title' => $title,
            ]);
        }


        //میکرو
        $micros = [
            'stm32f103c8' => 'assets/img/micro/stm32f103c8.png',
            'stm32f446re' => 'assets/img/micro/stm32f446re.png',
        ];
        foreach($micros as $name => $src){
            $createdMicro = Micro::create([
                'name' => $name,
                'type' => 'main',
            ]);
            Img::create([
                'typable_id' => $createdMicro->id,
                'typable_type' => Micro::class,
                'type' => Img::TYPE_ICON,
                'path' => $src,
            ]);
        }

        //برد‌ها
        $boards = [
            [
                'name' => 'bluepill',
                'micro' => 'stm32f103c8',
                'src' => 'assets/img/board/bluepill_stm32.png',
            ],
            [
                'name' => 'nucleo-f446re',
                'micro' => 'stm32f446re',
                'src' => 'assets/img/board/nucleo-f446re.jpg',
            ],
        ];
        foreach($boards as $board){
            $findedMicro = Micro::where('name', $board['micro'])->first();
            if(isset($findedMicro)){
                $createdBoard = Board::create([
                    'name' => $board['name'],
                    'type' => 'main',
                    'micro_id' => $findedMicro->id,
                ]);
                Img::create([
                    'typable_id' => $createdBoard->id,
                    'typable_type' => Board::class,
                    'type' => Img::TYPE_ICON,
                    'path' => $board['src'],
                ]);
            }
        }

    }
}
