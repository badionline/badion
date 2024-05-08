<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->name = "BadiOn";
        $admin->email = "badionlineinfo@gmail.com";
        $admin->password = bcrypt('password');
        $admin->role = 1;
        $admin->save();

        //  $school = new User();
        //  $school->name = "BMU";
        //  $school->email = "bmu@gmail.com";
        //  $school->password = bcrypt('password');
        //  $school->role = 2;
        //  $school->save();

        //  $teacher = new User();
        //  $teacher->name = "BMCCA";
        //  $teacher->email = "bmcca@gmail.com";
        //  $teacher->password = bcrypt('password');
        //  $teacher->role = 2;
        //  $teacher->save();

        //  $student = new User();
        //  $student->name = "Maverick Wilderman I";
        //  $student->email = "olabadie@nicolas.com";
        //  $student->password = bcrypt('password');
        //  $student->role = 3;
        //  $student->save();

        //  $student = new User();
        //  $student->name = "Filomena Emard";
        //  $student->email = "chaz05@lemke.com";
        //  $student->password = bcrypt('password');
        //  $student->role = 3;
        //  $student->save();

        //  $student = new User();
        //  $student->name = "Cynthia Johnson II";
        //  $student->email = "braun.adela@ritchie.com";
        //  $student->password = bcrypt('password');
        //  $student->role = 3;
        //  $student->save();

        //  $student = new User();
        //  $student->name = "Miss Nelle Paucek";
        //  $student->email = "aurore58@hotmail.com";
        //  $student->password = bcrypt('password');
        //  $student->role = 3;
        //  $student->save();

        //  $student = new User();
        //  $student->name = "Mrs. Elyssa Larkin";
        //  $student->email = "alexis80@yahoo.com";
        //  $student->password = bcrypt('password');
        //  $student->role = 4;
        //  $student->save();

        //  $student = new User();
        //  $student->name = "Grayson Volkman";
        //  $student->email = "coby.cronin@morar.info";
        //  $student->password = bcrypt('password');
        //  $student->role = 4;
        //  $student->save();

        //  $student = new User();
        //  $student->name = "Noble Crist IV";
        //  $student->email = "lfranecki@mertz.net";
        //  $student->password = bcrypt('password');
        //  $student->role = 4;
        //  $student->save();

        //  $student = new User();
        //  $student->name = "Jailyn Smith V";
        //  $student->email = "aida.wilkinson@hotmail.com";
        //  $student->password = bcrypt('password');
        //  $student->role = 4;
        //  $student->save();
    }
}
