<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <% base_tag %>
	  <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> | My Parish </title>
	  $MetaTags(false)            
   	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <% require themedCSS('app') %>
    <link rel="shortcut icon" href="$ThemeDir/images/favicon.ico" />
  </head>
  <body>
    
    
      <% include Header %>      
        <div class="main">
          <div class="grid-container">        	
          $Layout
          </div> <!-- div class="grid-container" -->            
        </div> <!-- div class="main" -->	      
      <% include Footer %>
    
    

    <script src="$ThemeDir/js/app.js"></script>
  </body>
</html>
