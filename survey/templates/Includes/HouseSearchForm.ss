	
    <% if $IncludeFormTag %>
        <form $AttributesHTML>
    <% end_if %>
        <fieldset>
            <% if $Legend %><legend>$Legend</legend><% end_if %>

            <div class="grid-x grid-padding-x">
				<div class="large-10  cell">
                <% with $FieldMap %>
					<div class="grid-x grid-padding-x">
                    <% with $Status %>
                        <div class="large-6 cell">
                            <label for="$ID">$Title</label> $Field
                        </div>
                    <% end_with %>
                    <% with $HoldsRationCard %>
                        <div class="large-6 cell">
                            <label>Ration card holder</label>
                             $Field 
                        </div>
                    <% end_with %>
                    </div>
                    <div class="grid-x grid-padding-x">
                    <% with $CardType %>
                        <div class="large-6 cell">
                            <label for="$ID">$Title</label> $Field
                        </div>
                    <% end_with %>
                    <% with $Type %>                        
                        <div class="large-6 cell">
                            <label for="$ID">$Title</label> $Field
                        </div>
                    <% end_with %>
					</div>
                <% end_with %>
                
				</div>
                <% if $Actions %>                    
                        <% loop $Actions %>
                            <div class="large-2 cell">
                                <div class="Actions">
                                    <label>&nbsp;</label>
                                    $addExtraClass('button')
                                </div>
                            </div>                            
                        <% end_loop %>                    
                <% end_if %>

            </div>
        </fieldset>
    <% if $IncludeFormTag %>
        </form>
    <% end_if %>

