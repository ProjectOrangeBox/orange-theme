<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="<?=site_url('{dashboard}') ?>" class="navbar-brand" href="#">Q</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
			<?php if (user::has_one_permission_of(['url::/admin/users::index~get','url::/admin/roles::index~get','url::/admin/permissions::index~get','url::/admin/permissions::index~get'])) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<?=pear::menu_li('url::/admin/users::index~get','/admin/users','Users') ?>
							<?=pear::menu_li('url::/admin/roles::index~get','/admin/roles/','Roles') ?>
							<?=pear::menu_li('url::/admin/permissions::index~get','/admin/permissions','Permissions') ?>
							<?=pear::menu_li('url::/admin/settings::index~get','/admin/settings','Settings') ?>
							<?=pear::menu_li('url::/admin/utilities/config_viewer::index~get','/admin/utilities/config-viewer','Config Viewer') ?>
						</ul>
				</li>
				<?php } ?>
      </ul>
			<ul class="nav navbar-nav navbar-right">
        <li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<img alt="" class="img-circle" src="https://www.gravatar.com/avatar/<?=md5(strtolower(trim(user::email()))) ?>?s=32" />
						<span class="username username-hide-on-mobile"> <?=user::username() ?></span> <span class="caret"></span>
					</a>
          <ul class="dropdown-menu">
						<li><a href="/users/edit-profile/<?=user::id() ?>"><i class="fa fa-user"></i> My Profile</a></li>
						<!--
						<li> <a href="app_calendar.html"> <i class="fa fa-calendar"></i> My Calendar </a> </li>
						<li> <a href="app_inbox.html"> <i class="fa fa-envelope-o"></i> My Inbox <span class="badge badge-danger"> 3 </span> </a> </li>
						<li> <a href="app_todo.html"> <i class="fa fa-rocket"></i> My Tasks <span class="badge badge-success"> 7 </span> </a> </li>
						<li class="divider"> </li>
						<li> <a href="#"> <i class="fa fa-lock"></i> Lock Screen </a> </li>
						-->
						<li><a href="<?=site_url('{logout}') ?>"><i class="fa fa-key"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
