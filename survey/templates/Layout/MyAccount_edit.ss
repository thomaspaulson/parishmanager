<div class="row main">
    <div class="large-12 columns">
        <h3>$Title</h3>
        <div class="row main">
            <div class="large-6 columns">
				<% if IsSuccess %>
					<p>My records updated</p>
				<% else %>
					$EditMyAccountForm
				<% end_if %>	
            </div>
            <div class="large-6 columns">
				<ul>
					<li><a href="Security/changepassword?BackURL=$RedirectURL">Change password</a></li>
					<li><a href="Security/logout?BackURL=$RedirectURL">Signout</a></li>
				</ul>	
            </div>
        </div>
    </div>
</div>


