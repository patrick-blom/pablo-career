<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <form action="options.php" method="post" name="options">
        <h2>{WPP::_e( 'Job Offer Settings', 'pablo-career' )}</h2>
        {WPP::wp_nonce_field( 'update-options' )}
        <table class="form-table" width="100%" cellpadding="10">
            <tbody>
            <tr>
                <td scope="row" align="left">
                    <label>{WPP::_e( 'Page to display single job offer', 'pablo-career' )}</label>
                    <select name="pablo_single_page">
                        <option value="-1" {if !$single_page_id}selected{/if}>
                            {WPP::_e( 'Please Choose' ,'pablo-career')}
                        </option>

                        {foreach WPP::get_all_page_ids() as $page }
                            <option value="{$page}" {if $page == $single_page_id}selected{/if}>
                                {WPP::get_the_title( $page )}
                            </option>
                        {/foreach}
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
        <input type="hidden" name="action" value="update"/>
        <input type="hidden" name="page_options" value="pablo_single_page"/>
        <input type="submit" name="Submit" value="{WPP::_e( 'Save' )}"/></form>
</div>



