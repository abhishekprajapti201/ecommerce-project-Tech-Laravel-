<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        }

        .container {
            display: flex;
            width: 800px;
            max-width: 90%;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .left {
            flex: 1;
            background: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .left img {
            width: 200px;
            max-width: 100%;
        }

        .right {
            flex: 1;
            padding: 50px;
        }

        .right h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #ff6b6b;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #ff4a4a;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: #ff6b6b;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .left {
                padding: 20px;
            }
            .right {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="left">
            <img src="https://shreemillet.fillipsoftware.com/images/shri-millet.png" alt="Logo">
        </div>
        <div class="right">
               <h2>Forgot Password</h2>
                <a href="{{ $data['links'] }}" class="back-link">Change Password</a>
        </div>
    </div>

</body>
</html>
