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
Currant Pi is designed to work straight out the box. To install you need to download the latest release either as a zip file, or by cloning the repo and then making it visible to your webserver.

There's a couple of routes to installing this. Follow the one which fits you best.

####Method \#1: I've already for a webserver and I'm comfortable using Git
1. Clone this repo somewhere your webserver can see it, i.e.:

    ````
    git clone git@github.com:ColinWaddell/CurrantPi.git /var/www/html/currantpi
    ````
2. Cross Fingers. 
3. Point your browser at your webserver.

####Method \#2: I've already got a webserver and I can easily drop some files into its working directory
1. [Download the latest release](https://github.com/ColinWaddell/CurrantPi/archive/master.zip)
2. Unzip the repository and move its contents to your web-root, or where ever you'd like this to live (i.e. ```/var/www/html/```)
3. Visiting Currant by popping the address of your Raspberry Pi into a web-browser (i.e. [http://raspberrypi](http://raspberrypi))


####Method \#3: I have no webserver and need full instructions
In the following instructions you can skip step ```1``` if you already have a webserver running. Please just swap out ```/var/www/html``` in the instructions with where you'd like Currant to live on your server. You can skip step ```2``` if you've no interest in creating a backup of your current web server's content.

Just copy and paste each section into a terminal on your Rasbberry Pi and hit enter. You may be asked for a password depending on your configuration.

1. First you'll need to have a webserver up and running on your Pi. The following will install and setup lighttp on your Raspberry Pi. I'm assuming you're running an installation which uses the ```apt``` distro system.
    ```
    sudo apt-get install lighttpd php5-cgi
    sudo lighttpd-enable-mod fastcgi fastcgi-php
    sudo service lighttpd force-reload
    ```

2. Next create a backup of your webserver's current content 

    ```
    sudo mv /var/www/html /var/www/html_backup
    sudo mkdir /var/www/html
    ```
    
3. Install Currant.

    ```
    cd /tmp/
    wget https://github.com/ColinWaddell/CurrantPi/archive/master.zip -O temp.zip
    unzip temp.zip
    rm temp.zip
    sudo cp -r /tmp/CurrantPi-master/* /var/www/html/
    rm -rf /tmp/CurrantPi-master
    ```
4. Visiting Currant by popping the address of your Raspberry Pi into a web-browser (i.e. [http://raspberrypi](http://raspberrypi))

> Thanks to [_FranklY](https://www.reddit.com/r/raspberry_pi/comments/3zs89i/created_a_webinterface_to_keep_on_eye_on_how_my/cype3bd) and [rafspeik](https://github.com/rafspeik) for helping with these instructions.

<hr />

API
===
You can get all the info in the form of JSON, so that you can use it in any external service or your own web application by accessing the file api.php instead of index.php

For example:

[http://raspberrypi/api.php](http://raspberrypi/api.php)
  
Contributing
============
You can contribute to this project by [pushing to your fork and submitting a pull request](https://guides.github.com/activities/contributing-to-open-source/).

I like to try and comment on pull requests as soon as possible, but sometimes real-life gets in the way. I also may suggest some changes or improvements or alternatives. My apologies in advance if I don't automatically accept your submission.

When contributing to CurrantPi keep in mind that the target audience wants to unpack the repo and have it 'just work'. Second to this I'd like the code to feel accessible enough that anyone interested can play with it. People new to programming shouldn't have to deal with fancy design patterns and abstractions. I'd like to keep the code simple *but not stupid*, clean and as readable as possible. 

**Code should be simple enough that any eager beginner can follow it.**

*If you are keen to see Currant Pi implemented using an MVC framework, please see the [SlimMVC branch](https://github.com/ColinWaddell/CurrantPi/tree/slimmvc) created by github user [sio-iago](https://github.com/sio-iago).*

<hr />

License
=======
<p>&copy; 2016 <a href="http://colinwaddell.com/">Colin Waddell</a> under the terms of the<a href="https://github.com/ColinWaddell/RPi-Board-Info/blob/master/LICENSE.md"> MIT License.</a>
