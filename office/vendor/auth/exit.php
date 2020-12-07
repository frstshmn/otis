<?php
	session_start();
	session_unset();
	session_register_shutdown();
	http_response_code(200);
?>