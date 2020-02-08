<?php
$val .= '<div class="row main">
    <div class="large-12 columns">
        <h2>Dashboard</h2>
        <div class="row main">
            <div class="large-6 columns">
                <h3>Statistics</h3>
                <ul class="tabs" data-tab>
                    <li class="tab-title active"><a href="' . (\Config::inst()->get('SSViewer', 'rewrite_hash_links')
	? \Convert::raw2att( preg_replace("/^(\\/)+/", "/", $_SERVER['REQUEST_URI'] ) )
	: "") . '#family">Family</a></li>
                    <li class="tab-title"><a href="' . (\Config::inst()->get('SSViewer', 'rewrite_hash_links')
	? \Convert::raw2att( preg_replace("/^(\\/)+/", "/", $_SERVER['REQUEST_URI'] ) )
	: "") . '#members">Members</a></li>
                </ul>
                <div class="tabs-content">
                    <div class="content active" id="family">                        
                        <p>Total no of families <br>
                        <strong>';

$val .= $scope->locally()->obj('Families', null, true)->XML_val('Count', null, true);
$val .= ' familes</strong>
                        </p>
                    </div>
                    <div class="content" id="members">                        
                        <p>Total no of members <br>
                            <strong>';

$val .= $scope->locally()->obj('FamilyMembers', null, true)->XML_val('Count', null, true);
$val .= ' members</strong>
                        </p>
                    </div>
                </div>

            </div>
            <div class="large-6 columns text-center">
                <h3>Survey reports/manage</h3>
                <div class="row">
                    <div class="large-4 columns text-center">
                        <a href="family">
                            <i class="fi-home size-72"></i>
                            <p>Family reports</p>
                        </a>
                    </div>
                    <div class="large-4 columns text-center">
                        <a href="members">
                            <i class="fi-torso size-72"></i>
                            <p>Members reports</p>
                        </a>
                    </div>
                    <div class="large-4 columns text-center">
                        <a href="family/list-records">
                            <i class="fi-page-edit size-72"></i>
                            <p>Edit survey</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="panel">
            <h3>We&rsquo;re stoked you want to try Foundation! </h3>
            <p>To get going, this file (index.html) includes some basic styles you can modify, play around with, or totally destroy to get going.</p>
            <p>Once you\'ve exhausted the fun in this document, you should check out:</p>
            <div class="row">
                <div class="large-4 medium-4 columns">
                    <p><a href="http://foundation.zurb.com/docs">Foundation Documentation</a><br />Everything you need to know about using the framework.</p>
                </div>
                <div class="large-4 medium-4 columns">
                    <p><a href="http://zurb.com/university/code-skills">Foundation Code Skills</a><br />These online courses offer you a chance to better understand how Foundation works and how you can master it to create awesome projects.</p>
                </div>
                <div class="large-4 medium-4 columns">
                    <p><a href="http://foundation.zurb.com/forum">Foundation Forum</a><br />Join the Foundation community to ask a question or show off your knowlege.</p>
                </div>
            </div>
            <div class="row">
                <div class="large-4 medium-4 medium-push-2 columns">
                    <p><a href="http://github.com/zurb/foundation">Foundation on Github</a><br />Latest code, issue reports, feature requests and more.</p>
                </div>
                <div class="large-4 medium-4 medium-pull-2 columns">
                    <p><a href="https://twitter.com/ZURBfoundation">@zurbfoundation</a><br />Ping us on Twitter if you have questions. When you build something with this we\'d love to see it (and send you a totally boss sticker).</p>
                </div>
            </div>
        </div>
        -->
    </div>
</div>


';

