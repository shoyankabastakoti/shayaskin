<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

#[Signature('admin:create {email=shoyankabastakoti4@gmail.com}')]
#[Description('Create or promote an admin account without exposing its password')]
class CreateAdminUser extends Command
{
    public function handle(): int
    {
        $email = Str::lower((string) $this->argument('email'));

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->components->error('Enter a valid email address.');

            return self::FAILURE;
        }

        $user = User::query()->firstOrNew(['email' => $email]);

        if ($user->exists) {
            $user->is_admin = true;
            $user->save();

            $this->components->info("Admin access enabled for {$email}. The existing password was not changed.");

            return self::SUCCESS;
        }

        $name = $this->ask('Admin name', Str::before($email, '@'));
        $password = $this->secret('Admin password (at least 12 characters)');

        if (! is_string($password) || mb_strlen($password) < 12) {
            $this->components->error('The password must be at least 12 characters.');

            return self::FAILURE;
        }

        $confirmation = $this->secret('Confirm admin password');

        if (! is_string($confirmation) || ! hash_equals($password, $confirmation)) {
            $this->components->error('The password confirmation did not match.');

            return self::FAILURE;
        }

        $user->name = $name;
        $user->password = Hash::make($password);
        $user->is_admin = true;
        $user->save();

        $this->components->info("Admin account created for {$email}.");

        return self::SUCCESS;
    }
}
