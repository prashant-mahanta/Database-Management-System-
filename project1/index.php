
<!DOCTYPE html>
<head><title>Railway Reservation System</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
    <script src="typeahead.min.js"></script>
    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?from=%QUERY',
        limit : 10
    });
});
    </script>

    <style type="text/css">
.bs-example{
  font-family: sans-serif;
  position: relative;
  margin: 50px;
}
.typeahead, .tt-query, .tt-hint {
  border: 2px solid #CCCCCC;
  border-radius: 8px;
  font-size: 24px;
  height: 30px;
  line-height: 30px;
  outline: medium none;
  padding: 8px 12px;
  width: 396px;
}
.typeahead {
  background-color: #FFFFFF;
}
.typeahead:focus {
  border: 2px solid #0097CF;
}
.tt-query {
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
  color: #999999;
}
.tt-dropdown-menu {
  background-color: #FFFFFF;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 8px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  margin-top: 12px;
  padding: 8px 0;
  width: 422px;
}
.tt-suggestion {
  font-size: 24px;
  line-height: 24px;
  padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
  background-color: #0097CF;
  color: #FFFFFF;
}
.tt-suggestion p {
  margin: 0;
}
</style>


</head>

<body background="./img/back2.jpg">
	<table><td width="2000" height="50" bgcolor="cyan"><h1><center>Train Reservation System</center></h1></td></table>


  <table><tr>
<!--Ticket Booking-->
  <td>

  	<form action="bookticket.php" method="post">
  	<div><h2 style="color:red">From Station:</h2>

     <input type="text" name="type" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="from" required>

  	<div><h2 style="color:red">To Station:</h2>
     <input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="to" required>

  	<h2>Date of Journey: </h2>
    <input type="text" name="date1" id="date1" alt="date" class="IP_calendar" title="d/m/Y" required/>
  	<input type="submit">
  	</form>

  </td>
<!--Cancellation of Ticket-->
  <td><center>
   <center><h2 style="color:red">Ticket Cancellation</h2></center>

   <form action="cancellation.php" method="post">
     <h3 style="color:red">Pnr Number:</h3>
     <input type="number" name="pnr" min="1000000000" max="9999999999"class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Pnr Number" required>
     <br><br>
     <button type="submit" class="btn btn-danger">Cancel</button>
  </form>

</center>
  </td>

</tr></table>

</body>
</html>
