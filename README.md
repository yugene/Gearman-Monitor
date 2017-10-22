Gearman Monitor
Copyright (C) 2011 Yevgeny Yegorov
All rights reserved.

Gearman Monitor is a tool to watch [Gearman](http://gearman.org/) servers. Gearman
server version, function queue and registered workers status is available. Several
Gearman servers can be monitored at the same time. Server and function name filters
can be applied. Counters can be summed by server or function name.

### Installation ###

1. Git clone this project or download zip to your server. Configure web server.
Add Gearman servers addresses to _config.php.

2. Install Net_Gearman dependency

    - With composer (recommended)
    ```
    composer install
    ```

    - Or with pear (old school way)
    ```
    ./install.sh
    ```

3. Enjoy!
