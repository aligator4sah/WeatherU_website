<?php
// An example of using php-webdriver.

namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

require_once('vendor/autoload.php');

// start Chrome with 5 second timeout
$host = 'http://localhost:9515'; // this is the default
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);

// navigate to 'http://localhost/weatherU/register5.php/'
$driver->get('http://localhost/weatherU/register5.php');

// adding cookie
$driver->manage()->deleteAllCookies();

$cookie = new Cookie('cookie_name', 'cookie_value');
$driver->manage()->addCookie($cookie);

$cookies = $driver->manage()->getCookies();
print_r($cookies);

// click the link 'Home'
$link = $driver->findElement(
    WebDriverBy::id('menu_home')
);
$link->click();

// print the title of the current page
echo "The title is '" . $driver->getTitle() . "'\n";

// print the URI of the current page
echo "The current URI is '" . $driver->getCurrentURL() . "'\n";

// write 'php' in the search box
$driver->findElement(WebDriverBy::id('username'))
    ->sendKeys('123');
	
$driver->findElement(WebDriverBy::id('password'))
    ->sendKeys('123');

// submit the form
$driver->findElement(WebDriverBy::id('submit'))
    ->click(); // submit() does not work in Selenium 3 because of bug https://github.com/SeleniumHQ/selenium/issues/3398

//The following code can't run properly
// wait until the page is loaded
//$driver->wait()->until(
//   WebDriverExpectedCondition::titleContains('Weather')
//);

// wait at most 10 seconds until at least one result is shown
//$driver->wait(10)->until(
//    WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
//        WebDriverBy::className('gsc-result')
//    )
//);

// close the Chrome
//$driver->quit();
