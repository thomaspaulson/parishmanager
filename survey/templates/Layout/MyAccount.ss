<div class="grid-x grid-padding-x">
    <div class="large-12 cell">
        <h3>$Title</h3>
        <div class="grid-x grid-padding-x main">
            <div class="large-6 cell">				
				<% with Member %>
					<% if $FirstName %>
					<div id="FirstName"><label><% _t('My.FIRSTNAME','First Name') %>:</label> <p class="readonly">$FirstName</p></div>
					<% end_if %>
					<% if $Surname %>
					<div id="Surname"><label><% _t('My.Surname','Second Name') %>:</label> <p class="readonly">$Surname</p></div>
					<% end_if %>
					<% if $Email %>
					<div id="Email"><label><% _t('My.Email','Email') %>:</label> <p class="readonly">$Email</p></div>
					<% end_if %>									
					<a href="$Top.Link(edit)">edit profile</a>
				<% end_with %>
				
            </div>
            <div class="large-6 cell">
				<ul>
					<li><a href="Security/changepassword?BackURL=$RedirectURL">Change password</a></li>
					<li><a href="Security/logout?BackURL=$RedirectURL">Signout</a></li>
				</ul>	
            </div>
        </div>
    </div>
</div>


