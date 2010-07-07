#!/bin/sh

#./PEAR/phpunit.php --colors tests/
./PEAR/phpunit.php --colors --bootstrap tests/Startup.php tests
