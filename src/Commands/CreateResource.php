<?php

namespace Sprobe\Acl\Commands;

use Illuminate\Console\Command;
use Sprobe\Acl\Models\Resource;

class CreateResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acl:make-resource {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new Resource in the database.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $resource = (new Resource)->findOrCreate($this->argument('name'));

        $this->info("Resource `{$resource->name}` created");
    }
}
