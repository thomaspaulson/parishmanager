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
						<div class="grid-x grid-padding-x">
							<div class="large-4 cell">
							$Fields.fieldByName('Code[]')
							</div>
							<div class="large-4 cell">
								$Fields.fieldByName('Subject[]')									
							</div>
							<div class="large-4 cell">																	
								$Fields.fieldByName('Status[]')																		
							</div>									
						</div>
						<div class="grid-x grid-padding-x">
							<div class="large-4 cell">
							$Fields.fieldByName('Code[]')
							</div>
							<div class="large-4 cell">
								$Fields.fieldByName('Subject[]')									
							</div>
							<div class="large-4 cell">																	
								$Fields.fieldByName('Status[]')																		
							</div>									
						</div>
						<div class="grid-x grid-padding-x">
							<div class="large-4 cell">
							$Fields.fieldByName('Code[]')
							</div>
							<div class="large-4 cell">
								$Fields.fieldByName('Subject[]')									
							</div>
							<div class="large-4 cell">																	
								$Fields.fieldByName('Status[]')																		
							</div>									
						</div>
						<div class="grid-x grid-padding-x">
							<div class="large-4 cell">
							$Fields.fieldByName('Code[]')
							</div>
							<div class="large-4 cell">
								$Fields.fieldByName('Subject[]')									
							</div>
							<div class="large-4 cell">																	
								$Fields.fieldByName('Status[]')																		
							</div>									
						</div>
						<div class="grid-x grid-padding-x">
							<div class="large-4 cell">
							$Fields.fieldByName('Code[]')
							</div>
							<div class="large-4 cell">
								$Fields.fieldByName('Subject[]')									
							</div>
							<div class="large-4 cell">																	
								$Fields.fieldByName('Status[]')																		
							</div>									
						</div>
						<div class="grid-x grid-padding-x">
							<div class="large-4 cell">
							$Fields.fieldByName('Code[]')
							</div>
							<div class="large-4 cell">
								$Fields.fieldByName('Subject[]')									
							</div>
							<div class="large-4 cell">																	
								$Fields.fieldByName('Status[]')																		
							</div>									
						</div>
						<div class="grid-x grid-padding-x">
							<div class="large-4 cell">
							$Fields.fieldByName('Code[]')
							</div>
							<div class="large-4 cell">
								$Fields.fieldByName('Subject[]')									
							</div>
							<div class="large-4 cell">																	
								$Fields.fieldByName('Status[]')																		
							</div>									
						</div>
						<div class="grid-x grid-padding-x">
							<div class="large-4 cell">
							$Fields.fieldByName('Code[]')
							</div>
							<div class="large-4 cell">
								$Fields.fieldByName('Subject[]')									
							</div>
							<div class="large-4 cell">																	
								$Fields.fieldByName('Status[]')																		
							</div>									
						</div>
					$Fields.fieldByName('RedirectURL')
					$Fields.fieldByName('SecurityID')
					$Fields.fieldByName('FamilyMemberID')					
						
					
					
                    <% if $Actions %>
                        <div class="grid-x grid-padding-x Actions">
                        	<div class="large-12 cell">
                            <% loop $Actions %>                                
									$addExtraClass('button')                                
                            <% end_loop %>
                            </div>
                        </div>
                    <% end_if %>
                    
                    </fieldset>
                <% if $IncludeFormTag %>
                </form>
                <% end_if %>
