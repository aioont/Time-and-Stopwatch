<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<style>
		* {
			font-family: Helvetica, sans-serif;
		}
		body {
			background-color: white;
			color: black;
			transition: all 0.5s;
			margin: 0;
			padding: 0;
		}

		body.dark {
			background-color: black;
			color: white;
		}

		nav {
			background-color: #333;
			overflow: hidden;
			display: flex;
			align-items: center;
		}

		nav a {
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
			font-size: 17px;
		}

		nav a:hover {
			background-color: #ddd;
			color: black;
		}

		nav button {
			background-color: #b625f5;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			margin-left: auto;
            margin-right: 20px;
		}

		nav span {
			margin-right: auto;
			margin-left: 20px;
			font-size: 17px;
			color: white;
		}

		h1 {
			font-size: 200px;
			text-align: center;
			position: absolute;
			top: 30%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
        .btn-align {
            margin-left: 2%;
        }
	</style>

	<script>
		function toggleDarkMode() {
			var body = document.querySelector("body");
			body.classList.toggle("dark");
		}

		function updateTime() {
			var timeElem = document.querySelector("#time");
			timeElem.textContent = new Date().toLocaleTimeString();
		}

		setInterval(updateTime, 1000);
	</script>
</head>
<body>
        <?php
        session_start();

        // Set timezone to UTC
        date_default_timezone_set('UTC');

        // Check if timer is set in session
        if (!isset($_SESSION['timer'])) {
            $_SESSION['timer'] = 0;
        }

        // Check if the timer is currently running
        if (isset($_SESSION['start_time']) && $_SESSION['start_time'] > 0) {
            $time_elapsed = time() - $_SESSION['start_time'];
            $_SESSION['timer'] += $time_elapsed;
            $_SESSION['start_time'] = time();
        }

        // Handle button clicks
        if (isset($_POST['start'])) {
            $_SESSION['start_time'] = time();
        } elseif (isset($_POST['pause'])) {
            $_SESSION['start_time'] = 0;
        } elseif (isset($_POST['reset'])) {
            $_SESSION['timer'] = 0;
            $_SESSION['start_time'] = 0;
        }

        // Format the timer value
        $timer = date('H:i:s', $_SESSION['timer']);

        ?>

	<nav>
		<span><?php echo "Date : " . date("m-d-Y") . "      " . date("l"); ?></span>
        <h2><?php echo $timer; ?></h2>

        <div class="btn-align">
        <form method="post">
            <?php if (!isset($_SESSION['start_time']) || $_SESSION['start_time'] == 0): ?>
                <button type="submit" name="start">Start</button>
            <?php else: ?>
                <button type="submit" name="pause">Pause</button>
            <?php endif; ?>
            <button type="submit" name="reset">Reset</button>
        </form>
            </div>
		<button onclick="toggleDarkMode()">Switch theme</button>
	</nav>

	<h1 id="time">
		<?php
			echo date("h:i:s a");
		?>
	</h1>
</body>
</html>
