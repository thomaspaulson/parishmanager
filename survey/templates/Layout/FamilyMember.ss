    <div class="grid-x grid-padding-x">
        <div class="large-9 medium-9 cell  small-order-1 medium-order-2"> 

            <ul class="tabs" data-tabs id="member-tabs">
                <li class="tabs-title is-active"><a href="#members" aria-selected="true">Members</a></li>
                <li class="tabs-title"><a data-tabs-target="education" href="#education">Education</a></li>
                <li class="tabs-title"><a data-tabs-target="job" href="#job">Job</a></li>
                <li class="tabs-title"><a data-tabs-target="health" href="#health">Health</a></li>
                <li class="tabs-title"><a data-tabs-target="groups" href="#groups">Groups</a></li>

            </ul>   
            <div class="tabs-content" data-tabs-content="member-tabs">
                <div class="tabs-panel is-active" id="members">
                    $FamilyMemberSearchForm	
                </div>
                <div class="tabs-panel" id="education">
                    $EducationSearchForm
                </div>
                <div class="tabs-panel" id="job">
                    $JobSearchForm
                </div>
                <div class="tabs-panel" id="health">
                    $HealthSearchForm
                </div>

                <div class="tabs-panel" id="groups">
                    $GroupsSearchForm                
                </div>

            </div>        

        </div><!-- div id="content" -->
        <div class="large-3 medium-3 cell small-order-2 medium-order-1">
            <% include FamilyMemberSideBar %>
        </div>
    </div>