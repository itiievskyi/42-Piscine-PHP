<?php
	if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] && $_POST['submit'] == "OK"
	&& file_exists('../htdocs/private/passwd')) {
		$users_db = unserialize(file_get_contents('../htdocs/private/passwd'));
		$exist = false;
		foreach ($users_db as $key => $value) {
			if ($value['login'] === $_POST['login'] && $value['passwd'] === hash('whirlpool', $_POST['oldpw'])) {
				$exist = true;
				$users_db[$key]['passwd'] = hash('whirlpool', $_POST['newpw']);
			}
		}
		if ($exist) {
			file_put_contents('../htdocs/private/passwd', serialize($users_db));
			echo "OK\n";
		} else {
			echo "ERROR\n";
		}
	} else {
		echo "ERROR\n";
	}
?>
