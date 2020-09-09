{assign var="url" value="{'botdb/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->id, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->id}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/bot-db/update/{$model->id}">
        <div class="form-group">
            <label for="host">Host:</label>
            <input type="text" name="host" id="host" class="form-control" value="{$model->host}" required="required" />
        </div>

        <div class="form-group">
            <label for="user">User:</label>
            <input type="text" name="user" id="user" class="form-control" value="{$model->user}" required="required" />
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" name="password" id="password" class="form-control" value="{$model->password}" required="required" />
        </div>

        <div class="form-group">
            <label for="database">Database:</label>
            <input type="text" name="database" id="database" class="form-control" value="{$model->database}" required="required" />
        </div>


        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>