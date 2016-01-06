I wanted to have a simple way of checking out my Raspberry Pi's board temperature and other useful stats' so I cobbled together some php and bash to server up over [lighttpd](https://www.lighttpd.net/). 

Known Kludges
-------------
* The page takes at least 1 second to load in order to take two samples of the network Tx/Rx bit-count a second apart in order to determine the current transfer rates.

* Clearly I should be using an MVC rather than the inline-nightmare I've created.

Installation
------------
1. Clone this repo somewhere your webserver can see it.
2. Cross Fingers. 
3. Point your browser at your webserver.

 
Screenshot
----------
<img src="https://raw.githubusercontent.com/ColinWaddell/RPi-Board-Info/screenshots/img/screenshot.png?loadnew=true" align="left" width="384" >
