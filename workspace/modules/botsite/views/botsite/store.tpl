{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
{*<div class="h1">{$h1}</div>*}

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/bot-site/create">

        <div class="form-group">
            <label for="site_id">Site_id:</label>
            <select class="form-control" name="site_id" id="site_id">
                {foreach from=$bots item=bot}
                    <option value="{$bot->id}">{$bot->bot_username}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label for="bot_id">Site_id:</label>
            <select class="form-control" name="bot_id" id="bot_id">
                {foreach from=$sites item=site}
                    <option value="{$site->id}">{$site->site_name}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>