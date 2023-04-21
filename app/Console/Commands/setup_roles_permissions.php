<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class setup_roles_permissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup_roles_permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command basically creates the necessary roles and permissions for the application.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
        $this->info('Creating roles and permissions...');
        //check if roles and permissions exist
        $roles = [
            'admin',
            'clerk',
        ];

        $permissions = [
            'all',
            'create',
            'read',
        ];

        foreach ($roles as $role) {
            $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => $role]);
            $this->info("Role {$role->name} created");
        }

        foreach ($permissions as $permission) {
            $permission = \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
            $this->info("Permission {$permission->name} created");
        }

    }
}
