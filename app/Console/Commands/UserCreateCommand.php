<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a user';

    /**
     * Execute the console command.
     */
    public function handle() {
        User::create([
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => bcrypt($this->argument('password')),           
        ]);
        $this->info('User successfully created!');
    }
}
