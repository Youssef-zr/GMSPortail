<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GMSPortail</title>
    <style>
        .contact-message {
            background: #fff;
            padding: 15px 25px;
            border-left: 6px solid #3498db;
            text-transform: capitalize;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
        }

        h1 {
            color: #fff;
            margin-bottom: 20px
        }

        ul {
            list-style: none;
            padding-left: 0
        }

        ul li {
            margin-bottom: 10px
        }

        ul li span {
            background: #fff;
            border-radius: 5px;
            display: inline-block;
            padding: 5px 8px;
            text-align: center;
            min-width: 90px;
        }

        ul li p {
            color: #fff;
            margin-left: 8px;
            font-size: 16px;
            display: inline-block
        }

        ul li:last-of-type p {
            display: block
        }

        .d-block {
            display: block;
        }

        span.from {
            color: #3498db
        }
        p.dblock{
            line-height: 1.7
        }
    </style>
</head>

<body>

    <div class="contact-message">
        <h1>GMSPortail</h1>
        <h4>Nouveau message</h4>

        <span> ---------------------------------------------- </span>
        <ul>
            <li><strong>- Nom :</strong> {{ $information['name'] }}</li>
            <li><strong>- E-mail :</strong> {{ $information['email'] }}</li>
            <li><strong>- Numéro de téléphone :</strong> {{ $information['phone'] }}</li>
            <li><strong>- Sujet :</strong> {{ $information['subject'] }}</li>
            <li><strong class="d-block">- Message :</strong> <p class="d-block">{{ $information['msg'] }}</p></li>
        </ul>
        <span> ---------------------------------------------- </span>
        <ul>
            <li><label>Service Clients</label></li>
            <li><label>GMSPortail</label></li>
        </ul>
    </div>

</body>

</html>
