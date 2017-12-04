<? page::extends('_templates/orange_admin') ?>

<? page::section('section_container') ?>

<div class="row">
  <div class="col-md-6"><?=plugin::title('Dashboard','th') ?></div>
  <div class="col-md-6"></div>
</div>


<p><a href="<?=site_url('{logout}') ?>">Logout</a></p>

<p>Id: <?=user::id() ?></p>

<p>Username: <?=user::username() ?></p>

<p>Active: <?=user::is_active() ?></p>

<p>Permissions: <?=var_dump(user::permissions()) ?></p>

<p>Roles: <?=var_dump(user::roles()) ?></p>

<?=page::end() ?>