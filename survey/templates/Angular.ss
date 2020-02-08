<!doctype html>
<html class="no-js" lang="en" ng-app="surveyApp">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <% base_tag %>
    <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; My Survey</title>

    <link rel="stylesheet" href="{$ThemeDir}/jquery-ui/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="{$ThemeDir}/jquery-ui/jquery-ui.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	
	<% require css('themes/default/foundation-icons/foundation-icons.css') %>	    
    <% require themedCSS('style') %>
    <script src="{$ThemeDir}/js/modernizr.js"></script>
	
  </head>
  <body>

	<header class="header">

      <div class="row">
          <div class="large-12 columns">

            <nav class="top-bar" data-topbar role="navigation">
              <ul class="title-area">
                <li class="name">
                  <h1><a href="$BaseHref">Cochin Diocese</a></h1>
                </li>
                 <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
              </ul>

              <section class="top-bar-section">

                  <!-- Right Nav Section -->
                  <ul class="right">
                      <li class="link has-dropdown"><a href="#">Survey Reports</a>
                          <ul class="dropdown">
                              <li class="link"><a href="family">Family</a></li>
                              <li class="link"><a href="members">Member</a></li>
                          </ul>

                      </li>
                      <li class="link">
                      <li class="link has-dropdown"><a href="#">Manage Survey</a>
                          <ul class="dropdown">
                              <li class="link"><a href="#!/family">Family</a></li>
                              <li class="link"><a href="#!/members">Member</a></li>
                          </ul>                     
                          
                      </li>
                      <li class="link">
                          <a href="myparish">My Parish</a>
                      </li>					  
                      <li class="has-dropdown">
                          <a href="myaccount">My Account</a>
                          <ul class="dropdown">
                              <li class="link"><a href="Security/logout?BackURL=$RedirectURL">Signout</a></li>
                          </ul>
                      </li>

                  </ul>

                  <!-- Left Nav Section -->

                  <ul class="left">
                      <li class="link">
                          <a href="#" id="myParishHandler">
                          <% if $MyParish %>$MyParish.Title, $MyParish.Location <% else %> Select your  parish <% end_if %>
                          </a>
                      </li>
                  </ul>


              </section>
            </nav>

          </div>
      </div>

	</header>				
		
    $Layout    

    <% include Footer %>

	<div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	  <h2 id="modalTitle">Awesome. I have it.</h2>
	  <p class="lead">Your couch.  It is mine.</p>
	  <p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
	  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>
	
    <% require javascript('themes/default/js/foundation.min.js') %>
    <% require javascript('themes/default/js/app.js') %>    
	  
  	<% require javascript('survey/bower_components/angular/angular.js') %>  	
  	<% require javascript('survey/bower_components/angular-route/angular-route.js') %>  	
 	
  	<% require javascript('survey/javascript/app.js') %>
  	<% require javascript('survey/javascript/modules/family/familyModule.js') %>
  	<% require javascript('survey/javascript/modules/family/controllers.js') %>
  	<% require javascript('survey/javascript/modules/member/memberModule.js') %>
  	<% require javascript('survey/javascript/modules/member/controllers.js') %>
  	
  	
  </body>
</html>
