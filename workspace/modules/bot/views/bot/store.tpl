{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
<div class="h1">{$h1}</div>

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/bot/create">
        <div class="form-group">
            <label for="bot_username">Имя бота:</label>
            <input type="text" name="bot_username" id="bot_username" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="api_token">Api токен:</label>
            <input type="text" name="api_token" id="api_token" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="webhook_url">Адрес Webhook:</label>
            <input type="text" name="webhook_url" id="webhook_url" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="is_available">Статус:</label>
            <select class="form-control" name="is_available" id="is_available">
                {foreach from=$available_statuses key=available_status_key item=available_status}
                    <option value="{$available_status}">{$available_status_key}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label for="db_id">База данных:</label>
            <select class="form-control" name="db_id" id="db_id">
                {foreach from=$dbs item=db}
                    <option value="{$db->id}">{$db->user}:{$db->host}</option>
                {/foreach}
            </select>
        </div>


        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>