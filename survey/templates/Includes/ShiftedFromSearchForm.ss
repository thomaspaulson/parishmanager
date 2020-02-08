
    <% if $IncludeFormTag %>
        <form $AttributesHTML>
    <% end_if %>
        <fieldset>
            <% if $Legend %><legend>$Legend</legend><% end_if %>

            <div class="row">
                <% with $FieldMap %>
                    <% with $Status %>
                        <div class="large-10 columns">
                            <label>Shifted from urban/rural area</label>
                            $Field
                        </div>
                    <% end_with %>

                <% end_with %>

                <% if $Actions %>
                    <div class="Actions">
                        <% loop $Actions %>
                            <div class="large-2 columns">
                                $addExtraClass('button')
                            </div>
                        <% end_loop %>
                    </div>
                <% end_if %>

            </div>
        </fieldset>
    <% if $IncludeFormTag %>
        </form>
    <% end_if %>

