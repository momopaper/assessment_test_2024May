<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poker Card Distributor</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <h1>Poker Card Distributor</h1>
    <div>
        <label for="numPlayers">Enter number of players:</label>
        <input type="number" id="numPlayers" min="1" max="10">
        <button id="distribute" onclick="submit()">Distribute Cards</button>
    </div>
    <table id="players">
        <thead>
            <tr>
                <th>Player</th>
                <th>Cards</th>
            </tr>
        </thead>
        <tbody id='tbody'>
        </tbody>
    </table>
</body>

<script>
    function submit() {
        $("#tbody").empty();
        const numPlayers = document.getElementById("numPlayers").value;

        $.ajax({
            type: "POST",
            url: "{{ route('submit') }}",
            data: {
                'num_of_players': numPlayers
            },
            success: function(resultData) {
                resultData.forEach(player => {
                    resultHTML = '<tr><th>Player #' + player.number + '</th>'

                    var cardText = player.card.map(card => {
                        return card.symbol + card.number
                    }).join(',');

                    resultHTML = resultHTML + '<th>' + cardText + '</th>'

                    resultHTML = resultHTML + '</tr>'
                    $('#tbody').append(resultHTML)
                });
            },
            error: function(xhr, status, error) {
                alert('Irregularity occurred');
            }
        });

    }
</script>

</html>
