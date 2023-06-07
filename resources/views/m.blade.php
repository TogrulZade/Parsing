<html>
  <head>
    <style>
      table {
        width: 100%;
        border-collapse: collapse;
      }

      th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
      }

      th {
        background-color: lightgray;
      }

      select {
        width: 100%;
        padding: 8px;
      }
    </style>
  </head>
  <body>
    <table id="product-match-table">
      <tr>
        <th>Product Name</th>
        <th>Source Name</th>
        <th>Source Product Name</th>
        <th>Match</th>
      </tr>
      <tr>
        <td>Product 1</td>
        <td>Source 1</td>
        <td>Source Product 1</td>
        <td>
          <select id="match-1">
            <option value="">Select</option>
            <option value="product-1">Product 1</option>
            <option value="product-2">Product 2</option>
            <option value="product-3">Product 3</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Product 2</td>
        <td>Source 2</td>
        <td>Source Product 2</td>
        <td>
          <select id="match-2">
            <option value="">Select</option>
            <option value="product-1">Product 1</option>
            <option value="product-2">Product 2</option>
            <option value="product-3">Product 3</option>
          </select>
        </td>
      </tr>
    </table>
    <button id="submit-matches">Submit Matches</button>

    <script>
      document.getElementById("submit-matches").addEventListener("click", function() {
        var matches = [];
        for (var i = 1; i <= 2; i++) {
          var match = document.getElementById("match-" + i).value;
          if (match) {
            matches.push(match);
          }
        }
        alert("Selected matches:", matches);
        // Send the selected matches to the server for processing
      });
    </script>
  </body>
</html>
