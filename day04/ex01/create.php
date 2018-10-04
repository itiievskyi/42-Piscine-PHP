<?php
	if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] && $_POST['submit'] == "OK") {
		if (!file_exists('../htdocs/')) {
			mkdir('../htdocs/');
		}
		if (!file_exists('../htdocs/private')) {
			mkdir('../htdocs/private');
		}
		$users_db = unserialize(file_get_contents('../htdocs/private/passwd'));
		$exist = false;
		foreach ($users_db as $key => $user) {
			if ($user['login'] === $_POST['login']) {
				$exist = true;
			}
		}
		if ($exist) {
			echo "ERROR\n";
		} else {
			$users_db[] = array('login' => $_POST['login'], 'passwd' => hash('whirlpool', $_POST['passwd']));
			file_put_contents('../htdocs/private/passwd', serialize($users_db));
			echo "OK\n";
		}
	} else {
		echo "ERROR\n";
	}
?>
