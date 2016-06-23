	
	<ul id="mainnav" class="nav nav-pills">
		<li role="presentation"<?php echo $func->get_page() === NULL ? ' class="active"' : ''; ?>><a href="<?php echo $func->get_home(); ?>">Welcome</a></li>
        <li role="presentation"<?php echo $func->get_page() === 'add' ? ' class="active"' : ''; ?>><a href="<?php echo $func->get_home(); ?>/?page=add">Add A Word</a></li>
        <li role="presentation"<?php echo $func->get_page() === 'list' ? ' class="active"' : ''; ?>><a href="<?php echo $func->get_home(); ?>/?page=list">Word List</a></li>
        <li role="presentation"<?php echo $func->get_page() === 'resource' ? ' class="active"' : ''; ?>><a href="<?php echo $func->get_home(); ?>/?page=resource">Resources</a></li>
    </ul>
