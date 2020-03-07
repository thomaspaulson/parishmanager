<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<% base_tag %>
	<title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> | My Parish</title>
	$MetaTags(false)        
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans+Mono" rel="stylesheet">
    <% require themedCSS('app') %>
    <link rel="shortcut icon" href="$ThemeDir/images/favicon.ico" />
  </head>
  <body>
    
    
		<div class="header">	
			<div class="grid-container">
				<div class="grid-x grid-padding-x">
					<div class="large-12 cell">
					<h2><a href="/">My Parish</a></h2>
					</div>
				</div>
			</div>
		</div>

        <div class="main">
          <div class="grid-container">        	
          $Layout
          </div> <!-- div class="grid-container" -->            
        </div> <!-- div class="main" -->	      

		<div class="footer">	
			<div class="grid-container">
				<div class="grid-x grid-padding-x">
					<div class="large-12 cell">
					<h6><small>Copyrights 2014 © Diocese of Cochin</small></h6>
					</div>
				</div>
			</div> <!-- div class="grid-container" -->
		</div>
    
    

    <script src="$ThemeDir/js/app.js"></script>
  </body>
</html>
