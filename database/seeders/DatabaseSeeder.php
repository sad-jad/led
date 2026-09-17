<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Micro;
use App\Models\Board;
use App\Models\State;
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
            ],
            [
                'name' => 'محمد حمیدیان‌فر',
                'email' => 'mohammdhamidianfar@gmail.com',
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
        $projects = ['حضور غیاب', 'سیم‌کارت'];
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
                'states' => [
                    'VBAT', 'PC13', 'PC14', 'PC15', 'PA0', 'PA1', 'PA2',  'PA3',  'PA4',  'PA5',  'PA6', 'PA7', 'PB0', 'PB1', 'PB10', 'PB11', 'NRST', 'VCC3V3-1', 'GND-1', 'GND-2',
                    'PB12', 'PB13', 'PB14', 'PB15', 'PA8', 'PA9', 'PA10', 'PA11', 'PA12', 'PA15', 'PB3', 'PB4', 'PB5', 'PB6', 'PB7',  'PB8',  'PB9',  '5V',       'GND-3', 'VCC3v3-2',
                    'VCC3V3-3', 'SWIO', 'SWCLK', 'GND-4',
                    'BOOT0', 'BOOT1', 'BOOT0-BOOT1', 'BOOT',
                    'MICRO-USB', 'RESET'
                ]
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
                if(isset($board['states'])){
                    foreach($board['states'] as $state){
                        State::create([
                            'typable_id' => $createdBoard->id,
                            'typable_type' => Board::class,
                            'name' => $state,
                        ]);
                    }
                }
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
