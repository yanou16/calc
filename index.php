<?php
$error = '';
$x = '';
$y = '';
$result = '';
$operation = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['num1']) || empty($_POST['num2'])) {
        $error = "Enter both numbers!";
    } else {
        $x = $_POST['num1'];
        $y = $_POST['num2'];
        $operation = $_POST['operation'];

        switch($operation) {
            case 'add':
                $result = $x + $y;
                break;
            case 'subtract':
                $result = $x - $y;
                break;
            case 'multiply':
                $result = $x * $y;
                break;
            case 'divide':
                if ($y != 0) {
                    $result = $x / $y;
                } else {
                    $error = "Cannot divide by zero!";
                }
                break;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish Calculator</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .calculator {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }

        .error {
            color: #e74c3c;
            background: #ffd7d7;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .result {
            color: #27ae60;
            background: #e8f5e9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 1rem;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
        }

        form div {
            margin: 1rem 0;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #3498db;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #2980b9;
        }

        @media (max-width: 480px) {
            .calculator {
                padding: 1rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h2>Calculator</h2>
        <?php if ($error): ?>
            <div class="error"><?=$error?></div>
        <?php endif; ?>
        
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <div>
                <label for="num1">Number 1</label>
                <input type="number" value="<?=$x?>" name="num1" id="num1" required>
            </div>
            <div>
                <label for="operation">Operation</label>
                <select name="operation" id="operation">
                    <option value="add" <?=$operation=='add'?'selected':''?>>Add (+)</option>
                    <option value="subtract" <?=$operation=='subtract'?'selected':''?>>Subtract (-)</option>
                    <option value="multiply" <?=$operation=='multiply'?'selected':''?>>Multiply (×)</option>
                    <option value="divide" <?=$operation=='divide'?'selected':''?>>Divide (÷)</option>
                </select>
            </div>
            <div>
                <label for="num2">Number 2</label>
                <input type="number" value="<?=$y?>" name="num2" id="num2" required>
            </div>
            <div>
                <button type="submit">Calculate</button>
            </div>
        </form>

        <?php if ($result !== ''): ?>
            <div class="result">
                Result: <?=number_format($result, 2)?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>