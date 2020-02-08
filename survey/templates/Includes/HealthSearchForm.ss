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
						<div class="row">
							<% with $Blind %>
								<div class="large-4 columns">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							<% with $Deaf %>
								<div class="large-4 columns">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							<% with $Dumb %>
								<div class="large-4 columns">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							
						</div>	
						<div class="row">
							<% with $OtherPhsicalDisability %>
								<div class="large-4 columns">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							
							
							<% with $MentalDisability %>
								<div class="large-4 columns">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							
							<% with $HearthDisease %>
								<div class="large-4 columns">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
						</div>						
						<div class="row">
							
							<% with $Diabetes %>
								<div class="large-4 columns">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							
							<% with $Cancer %>
								<div class="large-4 columns">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							
							<% with $BloodPressure %>
								<div class="large-4 columns">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
						</div>
						<div class="row">
							
							<% with $Alcoholic %>
								<div class="large-4 columns">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
							
							<% with $OtherDisease %>
								<div class="large-8 columns">
								$Field<label for="$ID">$Title</label>
								</div>
							<% end_with %>
						</div>
						
						<% end_with %>              

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
