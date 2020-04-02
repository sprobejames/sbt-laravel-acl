<?php

namespace Sprobe\Acl\Commands;

use Illuminate\Console\Command;
use Sprobe\Acl\Models\Permission;

class CreatePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acl:make-permission {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new Permission in the database.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $group = (new Permission)->findOrCreate($this->argument('name'));

        $this->info("Permission `{$group->name}` created");
    }
}
