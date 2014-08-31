Console Image Extractor
=======

Pixels image extractor to console through symfony console component.

Requirements and installation
--------------

Composer is required.
Download zip project or clone repo and run "composer install" on root folder:

```bash
composer install
```

Run and options
--------------

```bash
bin/utils image:extractor url [width]
```

Url argument is required, width argument is optional and is 60 by default.


```bash
bin/utils image:extractor --help
```

```bash
Usage:
	image:extractor url [width]

Arguments:
	url
 	width
```

Example usage:

```bash
bin/utils image:extractor https://lh4.googleusercontent.com/-bEK_wXdSd-g/AAAAAAAAAAI/AAAAAAAAAOk/Nova96CPLSY/photo.jpg
```

![alt tag](http://www.dieg0v.com/lab/console-image/example.png)

License
--------------
Distributed under the MIT license: http://www.opensource.org/licenses/mit-license.php

Copyright (c) Diego Vilariño: http://www.dieg0v.com/ - http://www.sond3.com
