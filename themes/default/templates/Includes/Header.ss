		<div class="header">
        <div class="grid-container">       
            <div class="top-bar">
              <div class="top-bar-left">
              <h5><a href="/"><% if $MyParish %>$MyParish.Title, $MyParish.Location <% end_if %></a></h5>
              </div>
              <div class="top-bar-right">

                <ul class="vertical medium-horizontal menu" data-responsive-menu="drilldown medium-dropdown">
                  <li>
                    <a href="#">Certificate</a>
                    <ul class="menu vertical">
                      <li><a href="birth">Birth</a></li>
                      <li><a href="death">Death</a></li>
                      <li><a href="marriage">Marriage</a></li>                    
                    </ul>
                  </li>

                  <li><a href="#">Survey Reports</a>
                      <ul class="menu vertical">
                          <li><a href="family">Family</a></li>
                          <li><a href="members">Member</a></li>
                      </ul>

                  </li>
                  <li>
                    <a href="#">Manage Survey</a>
                      <ul class="menu vertical">
                          <li><a href="family/list-records">Family</a></li>
                          <li> <a href="members/list-records">Member</a></li>
                      </ul>                                           
                  </li>

                    <li> 
                        <a href="myparish">My Parish</a>
                    </li>					  
                    <li>
                        <a href="myaccount">My Account</a>
                        <ul class="menu vertical">
                            <li><a href="Security/logout?BackURL=$RedirectURL">Signout</a></li>
                        </ul>
                    </li>                    
                </ul>
              </div>
            </div>
        </div>
		</div><!-- .class="header" -->

