<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Waste Management - Take Your E-Waste to a Better Place</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
        }
        .parallax {
            background-image: url('images/home/bg.png');
            height: 100vh;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .content {
            position: relative;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding-left: 10%;
            color: #333;
        }
        nav {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            padding: 20px 10%;
            background-color: rgba(255, 255, 255, 0.8);
        }
        nav a {
            text-decoration: none;
            color: #333;
            margin-left: 20px;
        }
        .login-btn {
            background-color: #1a237e;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
        }
        h1 {
            font-size: 3em;
            margin-bottom: 0;
        }
        .highlight {
            color: #4CAF50;
        }
        p {
            max-width: 500px;
            margin-bottom: 30px;
        }
        .cta-btn {
            background-color: #FFA000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            cursor: pointer;
        }
        .illustration {
            position: absolute;
            right: 10%;
            bottom: 0;
            width: 40%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="parallax">
        <nav>
            <div class="logo">COMPANY NAME</div>
            <div>
                <a href="#home">Home</a>
                <a href="#products">Products</a>
                <a href="#about">About us</a>
                <a href="#login" class="login-btn">Login</a>
            </div>
        </nav>
        <div class="content">
            <h1>TAKE YOUR<br><span class="highlight">E-WASTE</span><br>TO A BETTER PLACE</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <button class="cta-btn">KNOW MORE</button>
            <img src="path/to/your/illustration.png" alt="E-Waste Illustration" class="illustration">
        </div>
    </div>

    <script>
        window.addEventListener('scroll', function() {
            let offset = window.pageYOffset;
            document.querySelector('.parallax').style.backgroundPositionY = offset * 0.7 + 'px';
        });
    </script>
</body>
</html>