<?php namespace Berbecki\Laless;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class LalessCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'laless:compile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compiles less files';

    /**
     * Illuminate application instance.
     * 
     * @var Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Create a new Laless command instance.
     *
     * @param  Basset\Basset  $basset
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct();

        $this->app = $app;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $laless = new Laless($this->app);
        $this->line("\n<comment>Laless ".LALESS_VERSION."</comment> <info>Compiling files...</info>");
        $laless->compileLessFiles( true );
        
        if ($this->app['config']->get ( 'laless::auto_minify' )) {
        	$laless->minify();
        }
        
        $this->info("Done\n");
    }

}
