<article>
    <!-- .entry-header -->

    <div class="entry-conten job-detail-view">
        {if $job|is_array}
            <h3 class="job-heading">
                {if 'title'|array_key_exists:$job && $job.title}
                    {$job.title}
                {/if}
            </h3>
            <div class="job-description">
                {if 'description'|array_key_exists:$job && $job.description}
                    <span class="label">{WPP::_e( 'Description', 'pablo-career' )}:</span>
                    {$job.description|unescape|stripcslashes}
                {/if}
            </div>
            <div class="clear"></div>
            <div class="job-qualreqs">
                {if 'qualifications'|array_key_exists:$job && $job.qualifications}
                    <div class="job-property item">
                        <span class="label">{WPP::_e( 'Qualifications', 'pablo-career' )}:</span>
                        {$job.qualifications}
                    </div>
                {/if}
                {if 'requirements'|array_key_exists:$job && $job.requirements}
                    <div class="job-property item">
                        <span class="label">{WPP::_e( 'Requirements', 'pablo-career' )}:</span>
                        {$job.requirements}
                    </div>
                {/if}
            </div>
            <div class="clear"></div>
            <div class="job-specs">
                {if 'working_hours'|array_key_exists:$job && $job.working_hours}
                    <div class="job-property item">
                        <span class="label">{WPP::_e( 'Working Hours', 'pablo-career' )}:</span>
                        {$job.working_hours}
                    </div>
                {/if}
                {if 'wage'|array_key_exists:$job && $job.wage}
                    <div class="job-property item">
                        <span class="label">{WPP::_e( 'Wage', 'pablo-career' )}:</span>
                        {$job.wage}
                    </div>
                {/if}
                {if 'workplace'|array_key_exists:$job && $job.workplace}
                    <div class="job-property item">
                        <span class="label">{WPP::_e( 'Workplace', 'pablo-career' )}:</span>
                        {$job.workplace}
                    </div>
                {/if}
                {if 'branch'|array_key_exists:$job && $job.branch}
                    <div class="job-property item">
                        <span class="label">{WPP::_e( 'Branch', 'pablo-career' )}:</span>
                        {$job.branch}
                    </div>
                {/if}
            </div>
            <div class="clear"/>
            <div class="extra-infos">
                {if 'additional_informations'|array_key_exists:$job && $job.additional_informations}
                    <span class="label">{WPP::_e( 'Additional Informations', 'pablo-career' )}:</span>
                    <div class="job-property additional-informations">
                        {$job.additional_informations|unescape|stripcslashes}
                    </div>
                    <div class="clear"/>
                {/if}
                {if 'others'|array_key_exists:$job && $job.others}
                    <span class="label">{WPP::_e( 'Others', 'pablo-career' )}:</span>
                    <div class="job-property others">
                        {$job.others|unescape|stripcslashes}
                    </div>
                    <div class="clear"/>
                {/if}

            </div>
        {else}
            <span>{WPP::_e( 'Could not Load Job', 'pablo-career' )}</span>
        {/if}
    </div>
    <!-- .entry-content -->

    <div class="back-to-list">
        <a href="{getBackLink}"
           class="back">{WPP::_e( 'Back to Joblist','pablo-career' )}</a>
    </div>
</article>
<!-- #post-## -->
