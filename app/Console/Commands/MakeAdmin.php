<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    protected $signature = 'make:admin {email} {password} {name=Admin}';
    protected $description = 'Create or update the admin user (registration is disabled)';

    public function handle(): int
    {
        $user = User::updateOrCreate(
            ['email' => $this->argument('email')],
            ['name' => $this->argument('name'), 'password' => $this->argument('password')]
        );

        $user->forceFill(['is_admin' => true])->save();

        $this->info("Admin ready: {$user->email}");
        return self::SUCCESS;
    }
}
