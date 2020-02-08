<!doctype html>
<html class="no-js" lang="en">
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

	<%--
    <div id="myParish">
        <div class="row">
            <div class="large-12 columns">
                <h3>My Parish</h3>
            </div>
        </div>
        <div class="row">
            <div class="large-4 columns">
                <h5>Search your parish.</h5>
                    <form>
                        <input type="text" name="YourParish" id="YourParish" class="text ui-autocomplete-input" placeholder="Type your parish name">
                    </form>
            </div>
            <div class="large-8 columns">
                <p>
                    <% loop $MyParishes %>
                        <a href="parish/myparish/$ID?BackURL=$Top.RedirectURL" class="size-12">$Title, $Location</a>
                        <% if not $Last %> <span class="size-12">/</span> <% end_if %>
                    <% end_loop %>
                    <br>choose your parish, if listed above<br>
                </p>
            </div>

        </div>
    </div>
	--%>
	
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
  </body>
</html>
