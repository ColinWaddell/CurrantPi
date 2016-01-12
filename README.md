CurrantPi
=========
Keep an eye on your [Raspberry Pi](https://www.raspberrypi.org/) with zero configuration <sup><sup>[\[if you've already got a web-server running\]](#install)</sup></sup>.

Currant Pi will show you current information about:

It'll show you current information about:

 * Board temperature
 * Network status
 * Uptime
 * CPU Load
 * Memory allocation
 * Available storage
 
[Plus is looks pretty.](#screenshot)


[![CurrantPi Small Screenshot](https://raw.githubusercontent.com/ColinWaddell/RPi-Board-Info/screenshots/img/screenshot_small.png)](#screenshot)
 
<hr />

<a id="install"></a>Installation
================================
CurrantPi is designed to work straight out the box. To install you need to download the latest release either as a zip file, or by cloning the repo and then make it visible to your webserver.

There's a couple of routes to installing this. Follow the one which fits you best.

####Prefered: I've already for a webserver and I'm comfortable using Git
1. Clone this repo somewhere your webserver can see it, i.e.:

    ````
    git clone git@github.com:ColinWaddell/CurrantPi.git /var/www/html/currantpi
    ````
2. Cross Fingers. 
3. Point your browser at your webserver.

####Prefered-ish: I've already got a webserver and I can easily drop some files in it's working directory
1. [Download the latest release](https://github.com/ColinWaddell/CurrantPi/archive/master.zip)
2. Unzip the repository and move its contents to your web-root, or where ever you'd like this to live (i.e. ```/var/www/html/```)
3. Visiting Currant by popping the address of your Raspberry Pi into a web-browser (i.e. [http://raspberrypi](http://raspberrypi))


####I need more that that &#8593;
You can skip step ```1``` if you already have a webserver running. Please just swap out ```/var/www/html``` in the instructions with where you'd like Currant to live on your server. You can skip step ```2``` if you've no iterest in creating a backup of your current web servers content.

Just copy and paste each section into a terminal on your Rasbberry Pi and hit enter. You may be asked for a password depending on your configuration.

1. First you'll need to have a webserver up an running on your Pi. The following will install and setup lighttp on your Raspberry Pi. I'm assuing you're running an installation which uses the ```apt``` distro system.
    ```
    sudo apt-get install lighttpd php5-cgi
    sudo lighttpd-enable-mod fastcgi fastcgi-php
    sudo service lighttpd force-reload
    ```

2. Next create a backup of your webservers current content 

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
  
Contributing
============
You can contribute to this project [pushing to your fork and submitting a pull request](https://guides.github.com/activities/contributing-to-open-source/).

At this point you're waiting on me. I'd like to at least comment on pull requests as soon as possible, but sometimes real-life gets in the way. I may suggest some changes or improvements or alternatives.

When contributing to CurrantPi keep in mind that the target audience wants to unpack the repo and (with any luck) once it's running tinker with the code. The shouldn't have to deal with fancy design patterns and abstractions. I'd like to keep code simple (but not stupid), clean and readable as possible. 

**Code should be simple enough that any eager beginner can follow it.**

*If you are keen to see Currant Pi implemented using an MVC framework, please see the [SlimMVC branch](https://github.com/ColinWaddell/CurrantPi/tree/slimmvc) created by github user [sio-iago](https://github.com/sio-iago).*

<hr />

License
=======
<p>&copy; 2016 <a href="http://colinwaddell.com/">Colin Waddell</a> under the terms of the<a href="https://github.com/ColinWaddell/RPi-Board-Info/blob/master/LICENSE.md"> MIT License.</a>

<a id="screenshot"></a>Screenshot
==========
<img src="https://raw.githubusercontent.com/ColinWaddell/RPi-Board-Info/screenshots/img/screenshot.png" width="380"/>
