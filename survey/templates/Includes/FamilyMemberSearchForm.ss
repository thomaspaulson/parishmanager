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
					  <li class="accordion-item is-active" data-accordion-item>
						<a href="#panel1a" class="accordion-title">By Age, Gender ...</a>
						<div id="panel1a"  class="accordion-content" data-tab-content>
						<% with $FieldMap %>
						<div class="grid-x grid-padding-x">
							<% with $Name %>
								<div class="large-4 cell">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>							
							<% with $AgeForm %>
								<div class="large-4 cell">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
							<% with $AgeUpto %>
								<div class="large-4 cell">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
						</div>
						
						<div class="grid-x grid-padding-x">
							<% with $Gender %>
								<div class="large-4 cell">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>							
							<% with $BloodGroup %>
								<div class="large-4 cell">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>							
							<% with $MartialStatus %>
								<div class="large-4 cell">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>						
						</div>
						
						<div class="grid-x grid-padding-x">
							<% with $HoldsPassport %>
								<div class="large-4 cell">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
							
							<% with $HoldsBankAccount %>
								<div class="large-4 cell">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
							
							<% with $HoldsDrivingLicence %>
								<div class="large-4 cell">
								<label for="$ID">$Title</label>$Field
								</div>
							<% end_with %>
							
						</div>						
						<% end_with %>
						</div>
						</li>

					  <li class="accordion-item" data-accordion-item>
						<a href="#panel2a" class="accordion-title">By DOB</a>
						<div id="panel2a"  class="accordion-content" data-tab-content>
						<div class="grid-x grid-padding-x">
							<div class="large-6 cell">
								<div class="grid-x grid-padding-x">																
								<% with $FieldMap %>
									<div class="large-4 cell">
									<% with $Day %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
									<div class="large-4 cell">
									<% with $Month %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
									<div class="large-4 cell">
									<% with $Year %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
								<% end_with %>
								</div>
							</div>
							<div class="large-6 cell">								
							</div>	
						</div>	

						</div>
						</li>
						
					  <li class="accordion-item" data-accordion-item>
						<a href="#panel3a" class="accordion-title">By Marriage date</a>
						<div id="panel3a"  class="accordion-content" data-tab-content>
						<div class="grid-x grid-padding-x">
							<div class="large-6 cell">
								<div class="grid-x grid-padding-x">																
								<% with $FieldMap %>
									<div class="large-4 cell">
									<% with $MDay %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
									<div class="large-4 cell">
									<% with $MMonth %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
									<div class="large-4 cell">
									<% with $MYear %>
										<label for="$ID">$Title</label>$Field							
									<% end_with %>
									</div>
								<% end_with %>
								</div>
							</div>
							<div class="large-4  last cell">
								<% with $FieldMap %>
									<% with $MYearsForm %>
										<div class="large-6 cell">
										<label for="$ID">$Title</label>$Field
										</div>
									<% end_with %>
									<% with $MYearsUpto %>
										<div class="large-6 cell">
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
						<div class="grid-x grid-padding-x">
                        <div class="large-12 cell">
                            <% loop $Actions %>
                                <div class="Actions">	
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
