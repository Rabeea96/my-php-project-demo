<?php

class DotEnv {
    /**
     * The directory where the .env file can be located.
     *
     * @var string
     */
    protected $path;


    public function __construct(string $path) {
        // When we are not on heroku
        if (strpos($_SERVER['HTTP_HOST'], 'heroku') === FALSE) {
            if(!file_exists($path)) {
                throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
            }
        }

        $this->path = $path;
    }

    public function load() :void {

        // When we are not on heroku
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

                if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                    putenv(sprintf('%s=%s', $name, $value));
                    $_ENV[$name] = $value;
                    $_SERVER[$name] = $value;
                }
            }
        }
        else {
            // When we are on heroku, we load the .env variables by using the prefix "process.env."
            putenv('DATABASE_SERVER', process.env.DATABASE_SERVER);
            putenv('DATABASE_USER', process.env.DATABASE_USER);
            putenv('DATABASE_PASSWORD', process.env.DATABASE_PASSWORD);
            putenv('DATABASE_NAME', process.env.DATABASE_NAME);
        }
    }

}

?>