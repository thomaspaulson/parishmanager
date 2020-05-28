<!DOCTYPE html>
<head>
	<% base_tag %>
	<title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; Parish</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	$MetaTags(false)

   	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <% require themedCSS('app') %>

</head>
<body>
		<div class="header">
			<div class="grid-container">
				<% if $MyParish %>       				
					<h3 class="text-center">$MyParish.Title	</h3>				 	
					<p  class="text-center h5">$MyParish.Address</p>
					<p  class="text-center">Contact: $MyParish.Landline</p>
					<p  class="text-center">Diocese Of Cochin</p>
				 <% end_if %>
			</div>
		</div>

        <div class="main">
          <div class="grid-container">        	
				<% if $Title %>
					<h5>$Title</h5>
				<% end_if %> 
				$Layout				
          </div> <!-- div class="grid-container" -->            
        </div> <!-- div class="main" -->	   

		<div class="footer">
			<div class="grid-container">       
				<div class="grid-x grid-padding-x">
					<div class="large-4 cell">							
						<p>	$MyParish.Location  </p>
						<p> $Now.Format('d-m-Y')  </p>
					</div>
				</div>
			</div>
		</div>

		<div class="grid-container">       
		    <div class="grid-x grid-padding-x">
			    <div class="large-12 cell">
				<hr>
				<p>	Printed at $Now.Nice by $Member.Name  </p>
				</div>
			</div>
		</div>

	<script src="$ThemeDir/js/app.js"></script>
	<script>
		//window.onload = function(){
		//	window.print();
		//}
	</script
  
</body>
</html>
