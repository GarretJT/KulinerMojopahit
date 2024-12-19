<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    // Check if the admin already exists
    $administrator = \App\User::where('email', 'danyadhi4149@gmail.com')->first();

    if (!$administrator) {
        $administrator = new \App\User;
        $administrator->name = "Administrator";
        $administrator->email = "danyadhi4149@gmail.com";
        $administrator->password = \Hash::make("password");
        $administrator->save();

        $this->command->info("User Admin berhasil diinsert");
    } else {
        $this->command->info("Admin already exists");
    }
}


}
