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

                    <div class="row">
                            <% with $FieldMap %>
								<div class="row">
									<div class="large-4 columns">                                                                    
                                    <% with $Status %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-4 columns">
									<label>Family</label> 	
                                    <% with $HoldsRationCard %>
                                        $Field<label for="$ID">$Title</label>
                                    <% end_with %>
									</div>
									<div class="large-4 columns"> 																																		
										<% with $CardType %>
												<label for="$ID">$Title</label> $Field		
										<% end_with %>
									</div>									
                                </div>
								<div class="row">
									<div class="large-6 columns">                                                                    
                                    <% with $Type %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>
									<div class="large-6 columns">                                                                    
                                    <% with $BuildYear %>
                                        <label for="$ID">$Title</label>$Field
                                    <% end_with %>
									</div>									
								</div>
                            <% end_with %>		<%-- with $FieldMap --%>						
						
					$Fields.fieldByName('RedirectURL')
					$Fields.fieldByName('SecurityID')
					$Fields.fieldByName('FamilyID')					
					
					<% if $Fields.fieldByName('ID')	%>
						$Fields.fieldByName('ID')						
					<% end_if %>
					
                    <% if $Actions %>
                        <div class="Actions">
                        	<div class="large-12 columns">
                            <% loop $Actions %>
                                
									$addExtraClass('button')
                                
                            <% end_loop %>
                            </div>
                        </div>
                    <% end_if %>
                    </div>
                    </fieldset>
                <% if $IncludeFormTag %>
                </form>
                <% end_if %>
