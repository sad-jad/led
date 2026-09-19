<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Micro;
use App\Models\Board;
use App\Models\Boardable;
use App\Models\Pin;
use App\Models\Pin_link;
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
                'name' => 'stlink-nucleo-f446re',
                'micro' => 'stm32f446re',
                'type' => 'programmer',
                'src' => 'assets/img/programmer/stlink-nucleo-f446re.svg',
                'pins' => [
                    [ 'name' => 'SWCLK', 'x' => 100, 'y' => 100 ],
                    [ 'name' => 'GND',   'x' => 100, 'y' => 120 ],
                    [ 'name' => 'SWDIO', 'x' => 100, 'y' => 140 ],
                    [ 'name' => 'SWO',   'x' => 100, 'y' => 160 ],
                    [ 'name' => '3V3',   'x' => 100, 'y' => 180 ],
                ],
            ],
            [
                'name' => 'bluepill',
                'micro' => 'stm32f103c8',
                'type' => 'main',
                'src' => 'assets/img/board/bluepill_stm32.png',
                'pins' => [
                    [ 'name' => 'VBAT',      'x' => 240, 'y' => 20 ],
                    [ 'name' => 'PC13',      'x' => 228, 'y' => 20 ],
                    [ 'name' => 'PC14',      'x' => 217, 'y' => 20 ],
                    [ 'name' => 'PC15',      'x' => 205, 'y' => 20 ],
                    [ 'name' => 'PA0',       'x' => 194, 'y' => 20 ],
                    [ 'name' => 'PA1',       'x' => 182, 'y' => 20 ],
                    [ 'name' => 'PA2',       'x' => 171, 'y' => 20 ],
                    [ 'name' => 'PA3',       'x' => 159, 'y' => 20 ],
                    [ 'name' => 'PA4',       'x' => 147, 'y' => 20 ],
                    [ 'name' => 'PA5',       'x' => 136, 'y' => 20 ],
                    [ 'name' => 'PA6',       'x' => 124, 'y' => 20 ],
                    [ 'name' => 'PA7',       'x' => 113, 'y' => 20 ],
                    [ 'name' => 'PB0',       'x' => 101, 'y' => 20 ],
                    [ 'name' => 'PB1',       'x' => 90,  'y' => 20 ],
                    [ 'name' => 'PB10',      'x' => 78,  'y' => 20 ],
                    [ 'name' => 'PB11',      'x' => 66,  'y' => 20 ],
                    [ 'name' => 'NRST',      'x' => 55,  'y' => 20 ],
                    [ 'name' => 'VCC3V3-1',  'x' => 43,  'y' => 20 ],
                    [ 'name' => 'GND-1',     'x' => 32,  'y' => 20 ],
                    [ 'name' => 'GND-2',     'x' => 20,  'y' => 20 ],

                    [ 'name' => 'PB12',      'x' => 240, 'y' => 236 ],
                    [ 'name' => 'PB13',      'x' => 228, 'y' => 236 ],
                    [ 'name' => 'PB14',      'x' => 217, 'y' => 236 ],
                    [ 'name' => 'PB15',      'x' => 205, 'y' => 236 ],
                    [ 'name' => 'PA8',       'x' => 194, 'y' => 236 ],
                    [ 'name' => 'PA9',       'x' => 182, 'y' => 236 ],
                    [ 'name' => 'PA10',      'x' => 171, 'y' => 236 ],
                    [ 'name' => 'PA11',      'x' => 159, 'y' => 236 ],
                    [ 'name' => 'PA12',      'x' => 147, 'y' => 236 ],
                    [ 'name' => 'PA15',      'x' => 136, 'y' => 236 ],
                    [ 'name' => 'PB3',       'x' => 124, 'y' => 236 ],
                    [ 'name' => 'PB4',       'x' => 113, 'y' => 236 ],
                    [ 'name' => 'PB5',       'x' => 101, 'y' => 236 ],
                    [ 'name' => 'PB6',       'x' => 90,  'y' => 236 ],
                    [ 'name' => 'PB7',       'x' => 78,  'y' => 236 ],
                    [ 'name' => 'PB8',       'x' => 66,  'y' => 236 ],
                    [ 'name' => 'PB9',       'x' => 55,  'y' => 236 ],
                    [ 'name' => '5V',        'x' => 43,  'y' => 236 ],
                    [ 'name' => 'GND-3',     'x' => 32,  'y' => 236 ],
                    [ 'name' => 'VCC3v3-2',  'x' => 20,  'y' => 236 ],

                    [ 'name' => 'VCC3V3-3',  'x' => 20,  'y' => 79 ],
                    [ 'name' => 'SWIO',      'x' => 20,  'y' => 113 ],
                    [ 'name' => 'SWCLK',     'x' => 20,  'y' => 146 ],
                    [ 'name' => 'GND-4',     'x' => 20,  'y' => 179 ],

                    [ 'name' => 'BOOT00',    'x' => 176, 'y' => 146 ],
                    [ 'name' => 'BOOT01',    'x' => 187, 'y' => 146 ],
                    [ 'name' => 'BOOT10',    'x' => 176, 'y' => 173 ],
                    [ 'name' => 'BOOT11',    'x' => 187, 'y' => 173 ],

                    [ 'name' => 'MICRO-USB', 'x' => 229, 'y' => 128 ],
                ],
                'programmers' => [
                    'stlink-nucleo-f446re' => [
                        // programmerPin => boardPin
                        'SWCLK' => 'SWCLK',
                        'GND' => 'GND-4',
                        'SWDIO' => 'SWIO',
                        'SWO' => 'PB3',
                        '3V3' => 'VCC3V3-3',
                    ]
                ]
            ],
        ];
        foreach($boards as $board){
            $findedMicro = Micro::where('name', $board['micro'])->first();
            if(isset($findedMicro)){
                $createdBoard = Board::create([
                    'name' => $board['name'],
                    'type' => $board['type'],
                    'micro_id' => $findedMicro->id,
                ]);
                if(isset($board['pins'])){
                    foreach($board['pins'] as $pin){
                        Pin::create([
                            'typeable_id' => $createdBoard->id,
                            'typeable_type' => Board::class,
                            'name' => $pin['name'],
                            'x' => $pin['x'],
                            'y' => $pin['y'],
                        ]);

                    }
                }
                if(isset($board['programmers'])){
                    foreach($board['programmers'] as $name => $links){
                        $findedProgrammerBoard = Board::where('type', 'programmer')->where('name', $name)->first();
                        if(isset($findedProgrammerBoard)){
                            $createdBoardable = Boardable::create([
                                'board_id' => $createdBoard->id,
                                'boardable_id' => $findedProgrammerBoard->id,
                                'boardable_type' => Board::class,
                            ]);
                            foreach($links as $programmerPinName => $boardPinName){
                                $findedProgrammerPin = Pin::where('typeable_type', 'App\Models\Board')
                                    ->where('typeable_id', $findedProgrammerBoard->id)
                                    ->where('name', $programmerPinName)
                                    ->first();
                                $findedBoardPin = Pin::where('typeable_type', 'App\Models\Board')
                                    ->where('typeable_id', $createdBoard->id)
                                    ->where('name', $boardPinName)
                                    ->first();
                                if(isset($findedProgrammerPin) && isset($findedBoardPin)){
                                    Pin_link::create([
                                        'boardable_id' => $createdBoardable->id,
                                        'pin_id' => $findedBoardPin->id,
                                        'love_id' => $findedProgrammerPin->id
                                    ]);
                                }
                            }
                        }
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