<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Header Formatter</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      padding: 30px;
    }
    .container {
      max-width: 700px;
      margin: auto;
      background: #fff;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    textarea {
      width: 100%;
      height: 200px;
      padding: 10px;
      font-family: monospace;
      font-size: 14px;
      margin-top: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }
    button {
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #0078D7;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #005a9e;
    }
    pre {
      background: #f4f4f4;
      padding: 10px;
      border-radius: 4px;
      white-space: pre-wrap;
    }
    label {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>HTTP Header Formatter</h2>
    <form method="POST">
      <label for="headers">Enter Raw Headers (name and value on separate lines):</label>
      <textarea name="headers" id="headers" placeholder=":method\nPOST\naccept\n*/*"><?php if (!empty($_POST['headers'])) echo htmlspecialchars($_POST['headers']); ?></textarea>
      <br>
      <button type="submit">Format Headers</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['headers'])) {
        $lines = preg_split("/\r\n|\n|\r/", trim($_POST['headers']));
        $output = '';

        for ($i = 0; $i < count($lines) - 1; $i += 2) {
            $name = trim($lines[$i]);
            $value = trim($lines[$i + 1]);

            // Add colon only if the name doesn't already end with ":"
            if (!str_ends_with($name, ':')) {
                $name .= ':';
            }

            $output .= $name . $value . "\n";
        }

        echo "<h3>Formatted Headers:</h3><pre>" . htmlspecialchars($output) . "</pre>";
    }

    // Compatibility for older PHP versions (pre-8.0)
    if (!function_exists('str_ends_with')) {
    function str_ends_with($haystack, $needle) {
        $len = strlen($needle);
        return $len === 0 || (substr($haystack, -$len) === $needle);
    }
}
    ?>
  </div>
</body>
</html>
