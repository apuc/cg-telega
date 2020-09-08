{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
{*<div class="h1">{$h1}</div>*}

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/Bot/create">
        <div class="form-group">
            <label for="bot_username">Bot_username:</label>
            <input type="text" name="bot_username" id="bot_username" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="api_token">Api_token:</label>
            <input type="text" name="api_token" id="api_token" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="webhook_url">Webhook_url:</label>
            <input type="text" name="webhook_url" id="webhook_url" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="is_available">Is_available:</label>
            <input type="text" name="is_available" id="is_available" class="form-control"  required="required" />
        </div>


        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>