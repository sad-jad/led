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
        $users = ['سجاد پیله‌ور' => 'zohancity@gmail.com', 'دانیال فرزین' => 'danial.farzin101@gmail.com', 'محمدپویا ابراهیم‌آبادی' => 'amirpouya8513@gmail.com'];
        foreach($users as $name => $email){
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
            ]);
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
                'type' => 'icon',
                'path' => $src,
            ]);
        }

        //برد‌ها
        $boards = [
            'bluepill' => 'assets/img/board/bluepill_stm32.png',
            'nucleo-f466re' => 'assets/img/board/nucleo-f466re_stm32.png',
        ];
        foreach($boards as $name => $src){
            $findedMicro = Micro::where('name', $name)->first();
            if(isset($findedMicro)){
                $createdBoard = Board::create([
                    'name' => $name,
                    'type' => 'main',
                    'micro_id' => $src,
                ]);
                Img::create([
                    'typable_id' => $createdBoard->id,
                    'typable_type' => Board::class,
                    'type' => 'icon',
                    'path' => $src,
                ]);
            }
        }

    }
}
