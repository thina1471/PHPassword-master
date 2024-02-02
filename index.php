<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHPassword</title>
	<!-- Custom Resources -->
	<script type="module" src="app.js" defer></script>
	<!-- Bootstrap Packages -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
	</script>
</head>

<?php
require_once("Password.php");
require_once("Resources.php");

$RESOURCES = Resources::getInstance();
$passwordCreated = isset($_POST["min-length"]);
$passwordValue = $passwordCreated ? Password::createPassword($_POST["min-length"], $_POST["min-numbers"], $RESOURCES->getCapitals(), $RESOURCES->getLowers(), $_POST["min-specials"]) : "";
?>

<body class="container-md overflow-x-hidden overflow-y-scroll" style="user-select: none;" oncontextmenu="return true">
	<header class="my-5">
		<h1 class="display-1 text-center">PHPassword</h1>
	</header>
	<main>
		<section class="input-group">
			<input type="text" name="password-placeholder" id="password-placeholder" class="form-control"
				placeholder="Write or generate a password" value="<?php echo $passwordValue; ?>"
				data-value="<?php echo $passwordValue; ?>" minlength="15">
			<button name="password-validate"
				class=" btn btn-outline-<?php echo $passwordCreated ? "primary" : "secondary"; ?>"
				<?php echo $passwordCreated ? "" : "disabled" ?>>
				<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2"
					viewBox="0 0 16 16" focusable="false">
					<path
						d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
				</svg>
			</button>
			<button name="password-copy"
				class=" btn btn-outline-<?php echo $passwordCreated ? "primary" : "secondary"; ?>"
				<?php echo $passwordCreated ? "" : "disabled" ?>>
				<svg xmlns=" http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-back" 0
					viewBox="0 0 16 16" focusable="false">
					<path
						d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z" />
				</svg>
			</button>
			<button name="password-generate" class=" btn btn-outline-primary">
				<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
					class="bi bi-arrow-repeat" viewBox="0 0 16 16" focusable="false">
					<path
						d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
					<path fill-rule="evenodd"
						d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
				</svg>
			</button>
		</section>
		<aside name="alert-placeholder"></aside>
		<section class="my-5">
			<form name="password-parameters" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post"
				class="row cols-7 gy-5">
				<div class="input-group">
					<span class="input-group-text">Write a</span>
					<input type="number" name="min-length" id="min-length" class="form-control text-center"
						value="<?php echo $RESOURCES->getLength()?>" min="<?php echo $RESOURCES->getLength()?>"
						title="Length of the password, with a minimum of <?php echo $RESOURCES->getLength()?>" required>
					<span class="input-group-text">-characters password</span>
				</div>
				<div class="input-group">
					<span class="input-group-text">with at least</span>
					<input type="number" name="min-numbers" id="min-numbers" class="form-control text-center"
						value="<?php echo $RESOURCES->getDigits()?>" min="<?php echo $RESOURCES->getDigits()?>"
						title="Number of numerical characters, with a minimum of <?php echo $RESOURCES->getDigits()?>"
						required>
					<span class="input-group-text">numerical characters</span>
				</div>
				<div class="input-group">
					<span class="input-group-text">and</span>
					<input type="number" name="min-specials" id="min-specials" class="form-control text-center"
						value="<?php echo $RESOURCES->getSpecials()?>" min="<?php echo $RESOURCES->getSpecials()?>"
						title="Number of special characters, with a minimum of <?php echo $RESOURCES->getSpecials()?>"
						required>
					<span class="input-group-text">special characters</span>
				</div>
			</form>
		</section>
	</main>
	<footer class="container-fluid bg-body my-4 sticky-bottom">
		<p class="lead text-center">
			Made by
			<a href="https://github.com/cromega08" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
				Cromega
			</a>
		</p>
	</footer>
</body>

<style>
::-webkit-scrollbar {
	display: none;
}
</style>

</html>