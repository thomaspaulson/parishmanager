
    <% if $IncludeFormTag %>
        <form $AttributesHTML>
    <% end_if %>
        <fieldset>
            <% if $Legend %><legend>$Legend</legend><% end_if %>

            <div class="grid-x grid-padding-x">
                <% with $FieldMap %>
                    <% with $Status %>
                        <div class="large-10 cell">
                            <label>Shifted from urban/rural area</label>
                            $Field
                        </div>
                    <% end_with %>

                <% end_with %>

                <% if $Actions %>                    
                        <% loop $Actions %>
                            <div class="large-2 cell">
                                <div class="Actions">                                
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

