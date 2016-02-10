Currant Pi
=========
Keep an eye on your [Raspberry Pi](https://www.raspberrypi.org/) with zero configuration <sup><sup>[\[if you've already got a web-server running\]](#installation)</sup></sup>

Currant Pi will show you current information about your Raspberry Pi's:

 * Board temperature
 * Network status
 * Uptime
 * CPU Load
 * Memory allocation
 * Available storage

[Check out the Live Demo &rarr;](http://ukube.colinwaddell.com/rpiinfo/) 

<a href="http://ukube.colinwaddell.com/rpiinfo/">
  <img src="https://raw.githubusercontent.com/ColinWaddell/CurrantPi/screenshots/img/screenshot.png" width="380"/>
</a>
 
<hr />

Installation
================================
Currant Pi with Slim Framework, using MVC Patterns, designed for coders.
If you don't have a nice experience with PHP development and Composer, please consider using the master branch.

####Setting up the server
1. Configure your favorite server to run CurrantPi. You need to fit all the dependencies to run PHP 5.5 > and Composer.

2. Clone this repo somewhere your webserver can see it, i.e.:

    ````
    git clone git@github.com:ColinWaddell/CurrantPi.git /var/www/html/currantpi
    ````
3. Run "composer install" on the folder /var/www/html/currantpi

3. Point your browser at your webserver.

Features
================================
1. Built with Slim Framework following the MVC Pattern.

2. Uses Twig Template Engine so you don't need to worry about PHP code mixed with HTML code.

3. Basic controllers inside for both rendering with Twig (BaseController) or rendering a JSON (JsonController).


Contributing
============
You can contribute to this project by [pushing to your fork and submitting a pull request](https://guides.github.com/activities/contributing-to-open-source/).

I like to try and comment on pull requests as soon as possible, but sometimes real-life gets in the way. I also may suggest some changes or improvements or alternatives. My apologies in advance if I don't automatically accept your submission.

When contributing to CurrantPi [slimmvc] you should have a basic knowledge of Design Patterns. Although you must know how to use Composer and how to make a basic application using Slim Framework.

**Code should be simple enough that any beginner with basic knowledge in web development can follow it.**

<hr />

License
=======
<p>&copy; 2016 <a href="http://colinwaddell.com/">Colin Waddell</a> under the terms of the<a href="https://github.com/ColinWaddell/RPi-Board-Info/blob/master/LICENSE.md"> MIT License.</a>