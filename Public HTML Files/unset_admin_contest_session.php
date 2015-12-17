<?php

					
									session_start();
									if($_SESSION["logged_in"] != 1 || $_SESSION['Admin'] != 1){
										header('Location: home.php');
									}
								
									$email = $_SESSION["email"];
									session_unset($_SESSION['Sport']);
									session_unset($_SESSION['Team-A']);
									session_unset($_SESSION['Team-B']);
									$_SESSION["logged_in"] = 1;
									$_SESSION['Admin'] = 1;
									$_SESSION["email"] = $email;
									header('Location: adminhome.php');
?>