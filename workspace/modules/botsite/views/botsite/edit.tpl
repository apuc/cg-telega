{assign var="url" value="{'botsite/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->id, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->id}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/bot-site/update/{$model->id}">

        <div class="form-group">
            <label for="site_id">Бот:</label>
            <select class="form-control" name="site_id" id="site_id">
                {foreach from=$bots item=bot}
                    {if $bot->id eq $model->bot->id}
                        <option selected value="{$bot->id}">{$bot->bot_username}</option>
                    {else}
                        <option value="{$bot->id}">{$bot->bot_username}</option>
                    {/if}
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label for="site">Сайт:</label>
            <select class="form-control" name="site_id" id="site_id">
                {foreach from=$sites item=site}
                    {if $site->id eq $model->site->id}
                        <option selected value="{$site->id}">{$site->site_name}</option>
                    {else}
                        <option value="{$site->id}">{$site->site_name}</option>
                    {/if}
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>