<!DOCTYPE html>
<html>

<head>
	<title>Currency Converter</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="jumbotron text-center">
		<h1>Welcome to Our Currency Conversion Site</h1>
	</div>

	<div class="container center_div">
		<form method="post" action="">

			<label for="originalAmount"> Enter the amount you would like to convert: </label>
			<input class="form-control" type="number" id="originalAmount" name="originalAmount" value="1" min="1" step="0.01">

			<div class="form-group">
				<select class="form-control" name="originalCurrency" id="originalCurrency">
					<option value="USD">USD</option>
					<option value="EUR">EUR</option>
					<option value="JPY">JPY</option>
					<option value="GBP">GBP</option>
					<option value="AUD">AUD</option>
					<option value="CAD">CAD</option>
					<option value="CHF">CHF</option>
					<option value="CNY">CNY</option>
					<option value="HKD">HKD</option>
					<option value="NZD">NZD</option>
				</select> <br>
			</div>

			<label for="convertedCurrency"> Select the currency you would like to convert to: </label>
			<div class="form-group">
				<select class="form-control" name="convertedCurrency" id="convertedCurrency">
					<option value="USD">USD</option>
					<option value="EUR">EUR</option>
					<option value="JPY">JPY</option>
					<option value="GBP">GBP</option>
					<option value="AUD">AUD</option>
					<option value="CAD">CAD</option>
					<option value="CHF">CHF</option>
					<option value="CNY">CNY</option>
					<option value="HKD">HKD</option>
					<option value="NZD">NZD</option>
				</select> <br>
			</div>

			<input type="submit" name="action" value="Convert">
		</form>
	</div>

	<?php

	if (isset($_POST['action']) == "Convert") {

		$data = [
			'licenseKey' => "KEYABC123",
			'originalCurrency' => $_POST['originalCurrency'],
			'convertedCurrency' => $_POST['convertedCurrency'],
			'originalAmount'   => $_POST['originalAmount'],
		];

		$data = json_encode($data);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "http://localhost/CurrencyConverterAPI/CurrencyConversionService/api/authentication/");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/json',
			'Accept:application/json',
			'Content-Length:' . strlen($data),
		));

		$token = curl_exec($ch);

		try {
			$token = json_decode($token, true);
		} catch (Exception $e) {
			return;
		}

		if (!array_key_exists("Token", $token)) {
			return;
		}

		curl_setopt($ch, CURLOPT_URL, "http://localhost/CurrencyConverterAPI/CurrencyConversionService/api/conversion/");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/json',
			'Accept:application/json',
			'Content-Length:' . strlen($data),
			"Authorization: Bearer {$token['Token']}"
		));

		$result = json_decode(curl_exec($ch), true);
		curl_close($ch);

		echo "<br>
			<div class='container center_div'>
				<p class='text-left'>
					Converted $" . $_POST['originalAmount'] . " " . $_POST['originalCurrency'] . " to $" . $result['ConvertedAmount'] . " " . $_POST['convertedCurrency'] . "
				</p>
			</div>
	";
	}
	?>
</body>

</html>