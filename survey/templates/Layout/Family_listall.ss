<div class="grid-x grid-padding-x">	
	<div class="large-9 medium-9 cell" id="content">
		<a href="{$Link(add-family)}?&BackURL=$RequestedURL" title="Add Family"><i class="fi-page-add"></i> Add Family</a>
		<ng-view></ng-view>

	</div><!-- div id="content" -->

	<div class="large-3 medium-3 cell" id="sidebar">
			<h3>Family</h3>
			$FamilySearchForm       
	</div>		
</div>	
