<table class="table table-hover job-table">
    <thead id="table-head">
    <tr>
        <th>
			<span class="sorter">
				<a class="sort-link up dashicons dashicons-arrow-up"
                   href="{getSortUrl sort='title' direction='asc' }"></a>
				<a class="sort-link down dashicons dashicons-arrow-down"
                   href="{getSortUrl sort='title' direction='desc' }"></a>
			</span>
            <span class="title">{WPP::_e('Title','pablo-career')}</span>
        </th>
        <th>
			<span class="sorter">
				<a class="sort-link up dashicons dashicons-arrow-up"
                   href="{getSortUrl sort='workplace' direction='asc' }"></a>
				<a class="sort-link down dashicons dashicons-arrow-down"
                   href="{getSortUrl sort='workplace' direction='desc' }"></a>
			</span>
            <span class="title">{WPP::_e('Workplace','pablo-career')}</span>
        </th>
        <th>
			<span class="sorter">
				<a class="sort-link up dashicons dashicons-arrow-up"
                   href="{getSortUrl sort='branch' direction='asc' }"></a>
				<a class="sort-link down dashicons dashicons-arrow-down"
                   href="{getSortUrl sort='branch' direction='desc' }"></a>
			</span>
            <span class="title">{WPP::_e('Branch','pablo-career')}</span>
        </th>
        <th>
			<span class="sorter">
				<a class="sort-link up dashicons dashicons-arrow-up"
                   href="{getSortUrl sort='creationdate' direction='asc' }"></a>
				<a class="sort-link down dashicons dashicons dashicons-arrow-down"
                   href="{getSortUrl sort='creationdate' direction='desc' }"></a>
			</span>
            <span class="title">{WPP::_e('Creation Date','pablo-career')}</span>
        </th>
    </tr>
    </thead>
    <tbody id="table-body">
    {foreach from=$joblist item=job key=jobkey}
        <tr id="row-{$job.id} ?>">
            <td>
                <a href="{getSingleJobUrl id=$job.id }">
                    {$job.title}
                </a>
            </td>
            <td>{$job.workplace}</td>
            <td>{$job.branch}</td>
            <td>{$job.creationdate|strtotime|date_format:"d.m.Y"}</td>
        </tr>
    {/foreach}
    </tbody>
</table>