{assign var="url" value="{'site/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->id, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->id}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/site/update/{$model->id}">
        <div class="form-group">
            <label for="site_name">Site_name:</label>
            <input type="text" name="site_name" id="site_name" class="form-control" value="{$model->site_name}" required="required" />
        </div>

        <div class="form-group">
            <label for="url">Url:</label>
            <input type="text" name="url" id="url" class="form-control" value="{$model->url}" required="required" />
        </div>


        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>