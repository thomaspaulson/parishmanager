<?php
$val .= '<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    ';

$val .= SSViewer::get_base_tag($val);
$val .= '
    <title>';

if ($scope->locally()->hasValue('MetaTitle', null, true)) { 
$val .= $scope->locally()->XML_val('MetaTitle', null, true);

}else { 
$val .= $scope->locally()->XML_val('Title', null, true);

}
$val .= ' &raquo; My Survey</title>

    <link rel="stylesheet" href="';

$val .= $scope->locally()->XML_val('ThemeDir', null, true);
$val .= '/jquery-ui/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="';

$val .= $scope->locally()->XML_val('ThemeDir', null, true);
$val .= '/jquery-ui/jquery-ui.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	
	';

Requirements::css('themes/default/foundation-icons/foundation-icons.css');
$val .= '	    
    ';

Requirements::themedCSS('style');
$val .= '
    <script src="';

$val .= $scope->locally()->XML_val('ThemeDir', null, true);
$val .= '/js/modernizr.js"></script>
	
  </head>
  <body>

	<header class="header">

      <div class="row">
          <div class="large-12 columns">

            <nav class="top-bar" data-topbar role="navigation">
              <ul class="title-area">
                <li class="name">
                  <h1><a href="';

$val .= $scope->locally()->XML_val('BaseHref', null, true);
$val .= '">Cochin Diocese</a></h1>
                </li>
                 <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                <li class="toggle-topbar menu-icon"><a href="' . (\Config::inst()->get('SSViewer', 'rewrite_hash_links')
	? \Convert::raw2att( preg_replace("/^(\\/)+/", "/", $_SERVER['REQUEST_URI'] ) )
	: "") . '#"><span>Menu</span></a></li>
              </ul>

              <section class="top-bar-section">

                  <!-- Right Nav Section -->
                  <ul class="right">
                      <li class="link has-dropdown"><a href="' . (\Config::inst()->get('SSViewer', 'rewrite_hash_links')
	? \Convert::raw2att( preg_replace("/^(\\/)+/", "/", $_SERVER['REQUEST_URI'] ) )
	: "") . '#">Survey Reports</a>
                          <ul class="dropdown">
                              <li class="link"><a href="family">Family</a></li>
                              <li class="link"><a href="members">Member</a></li>
                          </ul>

                      </li>
                      <li class="link">
                      <li class="link has-dropdown"><a href="' . (\Config::inst()->get('SSViewer', 'rewrite_hash_links')
	? \Convert::raw2att( preg_replace("/^(\\/)+/", "/", $_SERVER['REQUEST_URI'] ) )
	: "") . '#">Manage Survey</a>
                          <ul class="dropdown">
                              <li class="link"><a href="family/list-records">Family</a></li>
                              <li class="link"><a href="members/list-records">Member</a></li>
                          </ul>                     
                          
                      </li>
                      <li class="link">
                          <a href="myparish">My Parish</a>
                      </li>					  
                      <li class="has-dropdown">
                          <a href="myaccount">My Account</a>
                          <ul class="dropdown">
                              <li class="link"><a href="Security/logout?BackURL=';

$val .= $scope->locally()->XML_val('RedirectURL', null, true);
$val .= '">Signout</a></li>
                          </ul>
                      </li>

                  </ul>

                  <!-- Left Nav Section -->

                  <ul class="left">
                      <li class="link">
                          <a href="' . (\Config::inst()->get('SSViewer', 'rewrite_hash_links')
	? \Convert::raw2att( preg_replace("/^(\\/)+/", "/", $_SERVER['REQUEST_URI'] ) )
	: "") . '#" id="myParishHandler">
                          ';

if ($scope->locally()->hasValue('MyParish', null, true)) { 
$val .= $scope->locally()->obj('MyParish', null, true)->XML_val('Title', null, true);
$val .= ', ';

$val .= $scope->locally()->obj('MyParish', null, true)->XML_val('Location', null, true);
$val .= ' ';


}else { 
$val .= ' Select your  parish ';


}
$val .= '
                          </a>
                      </li>
                  </ul>


              </section>
            </nav>

          </div>
      </div>

	</header>

	';


$val .= '
	
    ';

$val .= $scope->locally()->XML_val('Layout', null, true);
$val .= '

    ';

$val .= SSViewer::execute_template('Footer', $scope->getItem(), array(), $scope);

$val .= '


	<div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	  <h2 id="modalTitle">Awesome. I have it.</h2>
	  <p class="lead">Your couch.  It is mine.</p>
	  <p>I\'m a cool paragraph that lives inside of an even cooler modal. Wins!</p>
	  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>
	
    ';

Requirements::javascript('themes/default/js/foundation.min.js');
$val .= '
    ';

Requirements::javascript('themes/default/js/app.js');
$val .= '
  </body>
</html>
';

