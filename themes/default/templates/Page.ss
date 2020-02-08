<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <% base_tag %>
    <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; My Survey</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <%-- require themedCSS('app') --%>
    <% require themedCSS('style') %>
    <script src="{$ThemeDir}/js/modernizr.js"></script>
  </head>
  <body>

	<header class="header">
      <div class="row">
          <div class="large-4 large-centered columns">
              <h1 class="login"><a href="$BaseHref">Cochin Diocese</a></h1>
          </div>
      </div>
	</header>
		


    <div class="row main">
      <div class="large-6 large-centered columns">
        $Form
        $Content
      </div>
    </div>

    <% include Footer %>

    <script src="{$ThemeDir}/js/jquery.min.js"></script>
    <script src="{$ThemeDir}/js/foundation.min.js"></script>
    <script src="{$ThemeDir}/js/app.js"></script>
  </body>
</html>
