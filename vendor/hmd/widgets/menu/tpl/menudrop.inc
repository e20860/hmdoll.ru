  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $v['name']; ?></a>
    <div class="dropdown-menu">
		<?php foreach($v['childs'] as $dk=>$di): ?>
			<a class="dropdown-item" href="<?php echo $di['link'] ?>"><?php echo $di['name']; ?></a>
		<?php endforeach; ?>
    </div>
  </li>