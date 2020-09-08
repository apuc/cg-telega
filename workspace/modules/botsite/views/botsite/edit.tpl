{assign var="url" value="{'botsite/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->id, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->id}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/bot-site/update/{$model->id}">
        <div class="form-group">
            <label for="site_id">Site_id:</label>
            <input type="text" name="site_id" id="site_id" class="form-control" value="{$model->site_id}" required="required" />
        </div>

        <div class="form-group">
            <label for="bot_id">Bot_id:</label>
            <input type="text" name="bot_id" id="bot_id" class="form-control" value="{$model->bot_id}" required="required" />
        </div>


        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>