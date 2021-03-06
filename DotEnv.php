<?php

class DotEnv {
    
    // The directory where the .env file can be located.
    protected $path;

    public function __construct(string $path) {

        // When we are not on heroku - because when we are on a remote server like heroku, then the environment variables will exist on the server
        if (strpos($_SERVER['HTTP_HOST'], 'heroku') === FALSE) {
            if(!file_exists($path)) {
                throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
            }
            $this->path = $path;
        }
    }

    public function load() :void {

        // When we are not on heroku - because when we are on a remote server like heroku, then the environment variables will exist on the server
        if (strpos($_SERVER['HTTP_HOST'], 'heroku') === FALSE) {
            
            if (!is_readable($this->path)) {
                throw new \RuntimeException(sprintf('%s file is not readable', $this->path));
            }

            $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {

                if (strpos(trim($line), '#') === 0) {
                    continue;
                }

                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);

                putenv(sprintf('%s=%s', $name, $value));
            }
        }
    }

}

?>