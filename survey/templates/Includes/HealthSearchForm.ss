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

                    
						<% with $FieldMap %>
						<div class="grid-x grid-padding-x">
							<% with $Blind %>
								<div class="large-4 cell">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							<% with $Deaf %>
								<div class="large-4 cell">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							<% with $Dumb %>
								<div class="large-4 cell">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							
						</div>	
						<div class="grid-x grid-padding-x">
							<% with $OtherPhsicalDisability %>
								<div class="large-4 cell">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							
							
							<% with $MentalDisability %>
								<div class="large-4 cell">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							
							<% with $HearthDisease %>
								<div class="large-4 cell">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
						</div>						
						<div class="grid-x grid-padding-x">
							
							<% with $Diabetes %>
								<div class="large-4 cell">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							
							<% with $Cancer %>
								<div class="large-4 cell">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							
							<% with $BloodPressure %>
								<div class="large-4 cell">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
						</div>
						<div class="grid-x grid-padding-x">
							
							<% with $Alcoholic %>
								<div class="large-4 cell">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>

							
							<% with $OtherDisease %>
								<div class="large-8 cell">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>

						</div>
						
						<% end_with %>              



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

