{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
{*<div class="h1">{$h1}</div>*}

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/bot-db/create">
        <div class="form-group">
            <label for="host">Host:</label>
            <input type="text" name="host" id="host" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="user">User:</label>
            <input type="text" name="user" id="user" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" name="password" id="password" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="database">Database:</label>
            <input type="text" name="database" id="database" class="form-control"  required="required" />
        </div>


        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>