<?php

namespace Sprobe\Acl\Commands;

use Illuminate\Console\Command;
use Sprobe\Acl\Models\Group;

class CreateGroup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acl:make-group {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new Group in the database.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $group = (new Group)->findOrCreate($this->argument('name'));

        $this->info("Group `{$group->name}` created");
    }
}
