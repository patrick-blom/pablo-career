<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2>
        {if $item.id > 0}
            {WPP::_e( 'Edit Job Offer', 'pablo-career' )}
        {else}
            {WPP::_e( 'Add Job Offer', 'pablo-career' )}
        {/if}
        <a class="add-new-h2" href="{WPP::get_admin_url( WPP::get_current_blog_id(),'admin.php?page=jobs' )}">
            {WPP::_e( 'Back to Joblist', 'pablo-career' )}
        </a>
    </h2>

    {if $notice}
        <div id="notice" class="error"><p>{$notice}</p></div>
    {/if}
    {if $message}
        <div id="message" class="updated"><p>{$message} </p></div>
    {/if}
    <form id="form" method="POST">
        <input type="hidden" name="_wpnonce" value="{WPP::wp_create_nonce( 'pablo-career-admin-nonce' )}"/>
        <input type="hidden" name="id" value="{$item.id}"/>

        <div class="metabox-holder" id="poststuff">
            <div id="post-body">
                <div id="post-body-content">
                    <input type="submit" value="{WPP::_e( 'Save' )}" id="submit" class="button-primary" name="submit">
                    <div class="clear">
                        <br/>
                    </div>
                    {*assign do_meta_boxes to unsed variable, cause mehtod returns a boolean*}
                    {assign var="metabox" value=WPP::do_meta_boxes( 'job', 'normal', $item )}
                    <input type="submit" value="{WPP::_e( 'Save' )}" id="submit" class="button-primary" name="submit">
                </div>
            </div>
        </div>
    </form>
</div>



