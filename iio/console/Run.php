<?php 

/**
 *  
 *  @@ To Run the command ::
 *     
 *     --- In the console, "php /path/to/Run.php <CommandKey> <Arguments>"
 *     -----> Example: "php /path/to/Run.php build:website all"
 *   
 */

/**
 *  @ List of the Commands available to the
 *    System, with the class name map ::
 */
include_once __DIR__ . '/Commands.php';

// -- Include all the available command classes ::
include_once __DIR__ . '/../app/Support/Console/Console.php';


// -- Remove the Pathname from the Input
// -- Elements ::
array_shift($argv);

/**
 *  @ Run the Command that was Called :
 */
(new ConsoleRun($argv,$commands))->run();


/**
 *  ConsoleRun Class :::
 */
class ConsoleRun {

    public function __construct(
        public $in, 
        public $available
    ){
        $this->console = new Console;
        $this->command = $this->in[0];
    }

    public function run(){

        // -- Display the CLI Title ::
        $this->console->title();

        // -- Check if Command Exists in the available
        // -- command map (if no, kill)::
        if(
            !in_array(
                $this->command, array_keys($this->available)
            )
        )
        {
            $this->console->error('Error: Command Not Found, Exiting...');
            return;
        }

        // -- If the Command Exist, Let's Run it ::
        $this->console->success('Success: Command Found, Running...');

        // -- Include the Command Class ::
        include_once __DIR__ . '/commands/' . $this->available[$this->command] . '.php';

        // -- Run the Command ::
        (new $this->available[$this->command])->handle();

        $this->console->success('Complete');

    }


}




