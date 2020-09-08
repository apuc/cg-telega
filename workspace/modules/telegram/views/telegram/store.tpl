{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
{*<div class="h1">{$h1}</div>*}

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/telegram/create">
        <div class="form-group">
            <label for="bot_id">Site_id:</label>
            <select class="form-control" name="bot_id" id="bot_id">
                {foreach from=$bots item=bot}
                    <option value="{$bot->id}">{$bot->bot_username}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label for="url">Text:</label>
            <input type="text" name="text" id="text" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>