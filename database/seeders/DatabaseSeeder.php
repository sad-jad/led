<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Board;
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

        //برد‌ها
        $boards = [
            [
                'name' => 'necloy-2542' ,
                'type' => 'main',
                'src'  => 'assets/img/board/2542.pnggit '
            ],
            [],
                        'necloy-2542' => 'main',
            'necloy-3698' => 'main',
            'etrnet'      => 'ext',
        ];
        foreach($boards as $name => $type){
            Board::create([
                'name' => $name,
                'type' => $type,
            ]);
        }

    }
}
