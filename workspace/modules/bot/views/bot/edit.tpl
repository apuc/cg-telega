{assign var="url" value="{'bot/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->id, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->id}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/Bot/update/{$model->id}">
        <div class="form-group">
            <label for="bot_username">Bot_username:</label>
            <input type="text" name="bot_username" id="bot_username" class="form-control" value="{$model->bot_username}" required="required" />
        </div>

        <div class="form-group">
            <label for="api_token">Api_token:</label>
            <input type="text" name="api_token" id="api_token" class="form-control" value="{$model->api_token}" required="required" />
        </div>

        <div class="form-group">
            <label for="webhook_url">Webhook_url:</label>
            <input type="text" name="webhook_url" id="webhook_url" class="form-control" value="{$model->webhook_url}" required="required" />
        </div>

        <div class="form-group">
            <label for="is_available">Is_available:</label>
            <input type="text" name="is_available" id="is_available" class="form-control" value="{$model->is_available}" required="required" />
        </div>


        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>