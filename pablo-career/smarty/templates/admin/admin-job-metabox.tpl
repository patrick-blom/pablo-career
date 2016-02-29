<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
    <tbody>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="active">{WPP::_e( 'Active', 'pablo-career' )}</label>
        </th>
        <td>
            <input name="active" type="hidden" value="0">
            <input id="active" name="active" type="checkbox" value="1" {if $item.active}checked{/if}>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="languageid">{WPP::_e( 'Language', 'pablo-career' )}</label>
        </th>
        <td>
            <select name="languageid">
                {foreach ["de","nl","pl"] as $lang}
                    <option id="language_{$lang}" value="{$lang}" {if $lang == $item.languageid} selected {/if} >
                        {WPP::_e( 'language_'|cat:$lang, 'pablo-career' )}
                    </option>
                {/foreach}
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="title">{WPP::_e( 'Title', 'pablo-career' )}</label>
        </th>
        <td>
            <input id="title" name="title" type="text" style="width: 95%" value="{$item.title}"
                   size="50" class="code" placeholder="{WPP::_e( 'a rellay cool job', 'pablo-career' )}" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="description">{WPP::_e( 'Description', 'pablo-career' )}</label>
        </th>
        <td>
            {WPP::wp_editor($item.description|unescape|stripcslashes, 'description')}
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="working_hours">{WPP::_e( 'Working Hours', 'pablo-career' )}</label>
        </th>
        <td>
            <input id="working_hours" name="working_hours" type="text" style="width: 95%"
                   value="{$item.working_hours}"
                   size="50" class="code" placeholder="{WPP::_e( '8 hours a day', 'pablo-career' )}">
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="qualifications">{WPP::_e( 'Qualifications', 'pablo-career' )}</label>
        </th>
        <td>
            <input id="qualifications" name="qualifications" type="text" style="width: 95%"
                   value="{$item.qualifications}"
                   size="50" class="code" placeholder="{WPP::_e( 'IT specialist', 'pablo-career' )}">
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="requirements">{WPP::_e( 'Requirements', 'pablo-career' )}</label>
        </th>
        <td>
            <input id="requirements" name="requirements" type="text" style="width: 95%"
                   value="{$item.requirements}"
                   size="50" class="code" placeholder="{WPP::_e( 'PHP and JS', 'pablo-career' )}">
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="additional_informations">{WPP::_e( 'Additional Informations', 'pablo-career' )}</label>
        </th>
        <td>
            {WPP::wp_editor($item.additional_informations|unescape|stripcslashes, 'additional_informations')}
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="wage">{WPP::_e( 'Wage', 'pablo-career' )}</label>
        </th>
        <td>
            <input id="wage" name="wage" type="text" style="width: 95%" value="{$item.wage}"
                   size="50" class="code" placeholder="{WPP::_e( '15$/h', 'pablo-career' )}">
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="workplace">{WPP::_e( 'Workplace', 'pablo-career' )}</label>
        </th>
        <td>
            <input id="workplace" name="workplace" type="text" style="width: 95%"
                   value="{$item.workplace}"
                   size="50" class="code" placeholder="{WPP::_e( 'Brooklyn', 'pablo-career' )}">
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="branch">{WPP::_e( 'Branch', 'pablo-career' )}</label>
        </th>
        <td>
            <input id="branch" name="branch" type="text" style="width: 95%" value="{$item.branch}"
                   size="50" class="code" placeholder="{WPP::_e( 'FAIR New York', 'pablo-career' )}">
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="others">{WPP::_e( 'Others', 'pablo-career' )}</label>
        </th>
        <td>
            {WPP::wp_editor($item.others|unescape|stripcslashes, 'others')}
        </td>
    </tr>
    </tbody>
</table>



