                <% if $IncludeFormTag %>
                <form $AttributesHTML>
                <% end_if %>
                <% if $Message %>
                    <p id="{$FormName}_error" class="message $MessageType">$Message</p>
                <% else %>
                    <p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
                <% end_if %>

                <fieldset>
                    <% if $Legend %><legend>$Legend</legend><% end_if %>
                    
					<ul class="accordion" data-accordion>
					  <li class="accordion-navigation">
						<a href="#panel1a">by Age, Gender ...</a>
						<div id="panel1a" class="content active">
						<% with $FieldMap %>
						<div class="row">
							<% with $Name %>
								<div class="large-4 columns">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>							
							<% with $AgeForm %>
								<div class="large-4 columns">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
							<% with $AgeUpto %>
								<div class="large-4 columns">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
						</div>
						
						<div class="row">
							<% with $Gender %>
								<div class="large-4 columns">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>							
							<% with $BloodGroup %>
								<div class="large-4 columns">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>							
							<% with $MartialStatus %>
								<div class="large-4 columns">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>						
						</div>
						
						<div class="row">
							<% with $HoldsPassport %>
								<div class="large-4 columns">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
							
							<% with $HoldsBankAccount %>
								<div class="large-4 columns">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
							
							<% with $HoldsDrivingLicence %>
								<div class="large-4 columns">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
							
						</div>						
						<% end_with %>
						</div>
						</li>
						<li class="accordion-navigation">
						  <a href="#panel2a">by DOB</a>
						  <div id="panel2a" class="content">					  
						<div class="row">
							<div class="large-6 columns">
								<div class="row">																
								<% with $FieldMap %>
									<div class="large-4 columns">
									<% with $Day %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
									<div class="large-4 columns">
									<% with $Month %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
									<div class="large-4 columns">
									<% with $Year %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
								<% end_with %>
								</div>
							</div>
							<div class="large-6 columns">								
							</div>	
						</div>	

						</div>
						</li>
						
						<li class="accordion-navigation">
						  <a href="#panel3a">by Marriage date</a>
						  <div id="panel3a" class="content">					  
						<div class="row">
							<div class="large-6 columns">
								<div class="row">																
								<% with $FieldMap %>
									<div class="large-4 columns">
									<% with $MDay %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
									<div class="large-4 columns">
									<% with $MMonth %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
									<div class="large-4 columns">
									<% with $MYear %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
								<% end_with %>
								</div>
							</div>
							<div class="large-4  last columns">
								<% with $FieldMap %>
									<% with $MYearsForm %>
										<div class="large-6 columns">
										<label for="$ID">$Title</label>$Field
										</div>
									<% end_with %>
									<% with $MYearsUpto %>
										<div class="large-6 columns">
										<label for="$ID">$Title</label>$Field
										</div>
									<% end_with %>
								<% end_with %>								
								
							</div>	
						</div>	

						</div>
						</li>
						
					</ul>
					
                    <% if $Actions %>
						<div class="row">
                        <div class="Actions">
                            <% loop $Actions %>
                                <div class="large-12 columns">
                                $addExtraClass('button')
                                </div>
                            <% end_loop %>
                        </div>
						</div>		
                    <% end_if %>
                    
                    </fieldset>
                <% if $IncludeFormTag %>
                </form>
                <% end_if %>
