# README
This document contains a install guide and the basic usage of the module monolog-prettifier.  
The goal of the module is a prettified version of the exception log string. 
As with version [6.1](https://docs.oxid-esales.com/developer/en/6.1/system_architecture/logging.html) the Shop is using the project [monolog](https://github.com/Seldaek/monolog) to log messages. 
Those messages are shrinked to one line per message and makes it difficult to read.


## Installation

```bash
composer require michaelkeiluweit/monolog-prettifier
```
Activate the module in the shop admin.  

## Usage

There are two ways to call the module
- frontend
- administration area (backend)

### Frontend
Make sure that your current (logged in) user has admin rights.
Call it by URL: `https://oxdev.de/?cl=mkemonologprettifier`
If you get redirected, check the rights of your current user.

### Backend
During activating the module a new menue entry is added. 
You'll find it in the navigation under "Services" -> "Monolog Prettifier".
