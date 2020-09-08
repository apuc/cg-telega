{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
{*<div class="h1">{$h1}</div>*}

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/site/create">
        <div class="form-group">
            <label for="site_name">Site_name:</label>
            <input type="text" name="site_name" id="site_name" class="form-control"  required="required" />
        </div>

        <div class="form-group">
            <label for="url">Url:</label>
            <input type="text" name="url" id="url" class="form-control"  required="required" />
        </div>


        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-dark" value="Submit">
        </div>
    </form>
</div>