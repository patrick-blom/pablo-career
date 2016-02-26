<div class="wrap">
	<h2>
		{WPP::_e( 'Job Offers', 'pablo-career' )}
		<a class="add-new-h2" href="{WPP::get_admin_url( WPP::get_current_blog_id(), 'admin.php?page=job_form')}">
			{WPP::_e( 'Add Job Offer', 'pablo-career' )}
		</a>
	</h2>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder">
			<div id="post-body-content">
				<div class="meta-box-sortables ui-sortable">
					<form method="post">
						<input type="hidden" name="page" value="{$smarty.request.page}"/>
						{if $joblist}
							{$joblist->prepare_items()}
							{$joblist->display()}
						{/if}
					</form>
				</div>
			</div>
		</div>
		<br class="clear">
	</div>
</div>



