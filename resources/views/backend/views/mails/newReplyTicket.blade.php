<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GMSPortail - Réponse Ticket {{ $information['ticket_id'] }}</title>
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
    </style>
</head>

<body>

    <div class="contact-message">
        <h1>GMSPortail</h1>
        <span class="d-block">-----------------</span>
        <h4>Nouvelle réponse de : <span class="from">{{ $information['from'] }}</span></h4>

        <p>Bonjour</p>
        <p>Une nouvelle réponse vient d'être postée pour le ticket N° {{ $information['ticket_id'] }}.</p>

        <p>Cliquez sur ce lien pour afficher la réponse au ticket :</p>
        <a href="{{ $information['show_ticket_link'] }}" class="d-block"> Cliquez ici </a>

        <span> ---------------------------------------------- </span>
        <ul>
            <li><strong>- Ticket N° :</strong> {{ $information['ticket_id'] }}</li>
            <li><strong>- Sujet :</strong> {{ $information['subject'] }}</li>
            <li><strong>- Priorité :</strong> {{ $information['priority'] }}</li>
            <li><strong>- Etat :</strong> {{ $information['status'] }}</li>
        </ul>
        <span> ---------------------------------------------- </span>

        <p><span>----</span></p>
        <ul>
            <li><label>Service Clients</label></li>
            <li><label>GMSPortail</label></li>
        </ul>
    </div>

</body>

</html>
