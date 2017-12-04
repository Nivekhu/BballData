<?php
$title = "Blue Ridge Music Center Event Administration";
// brmcdbconnect.php defines a database connection named $db
include "components/brmcdbconnect.php";
include "components/head.php";
include "components/contentheader.php";

function mainStart($db) {
   $heading = "Current Season";
   if (isset($_GET["season"])) {
      $heading = $_GET["season"]." Season";
   }
   if (isset($_GET["search"])) {
	  $heading = "Search for ".$_GET["search"];
   }

   $yearsList = $db->query("SELECT distinct year(begin_datetime) as season
   FROM events order by season desc");
   echo <<< MAIN_START
     <main>
        <h2>Events Summary</h2>
        <h3>$heading</h3>
             <select id="season">
                 <option value="" disabled selected>Choose Another Season</option>
MAIN_START;

    while ($yearsForSelect = $yearsList->fetch_assoc()) {
       $year = $yearsForSelect["season"];
       echo "                 <option value='$year'>$year</option>";
	}
	echo <<< THE_REST
       </select>
           <input type="text" id="searchbox" placeholder="Event Search">
           <button type="button" id="search">
           <img alt="Search" title="Search" src="images/search.png">
           </button>
           <a href="event/add" id="addevent">Add Event</a>
           <table class="eventLink">
           <thead>
           <tr>
             <th>Headline Band</th>
             <th>Date</th>
             <th>Time</th>
             <th>Tickets Sold</th>
             <th>Income</th>
             <th>Expense</th>
             <th>Net</th>
           </tr>
           </thead>\n
THE_REST;
}

//Returns a list of all unique events and all of their attributes
function getEvents($year, $db) {
	if ($events = $db->query("SELECT * FROM events
	WHERE begin_datetime LIKE '%$year%' OR end_datetime LIKE '%$year%'")) {
		return $events;
	}
	//If no events found, print the message and return Null 
	else {
		echo "<p>No Events Found<p>\n";
		return $events;
	}
}

//Returns band_name and band_id for the headline for event_id
function getHeadline($event_id, $db) {
	if ($headlines = $db->query("SELECT * FROM performances
	WHERE event_id = $event_id AND performance_type = 'Headline'")) {
		$result = $headlines->fetch_assoc()['band_id'];
		$band = $db->query("SELECT band_name, band_id FROM bands
		WHERE band_id = $result");
		return $band->fetch_assoc();
	}
	else {
		echo "<p>AN ERROR OCCURED<p>\n";
	}
}

//Returns the number of tickets sold
function getTicketSales($event_id, $db) {
	if ($tickets = $db->query("SELECT SUM(count) AS total FROM ticket_sales 
	WHERE event_id = $event_id;")) {
		return $tickets->fetch_assoc()['total'];
	}
	else {
		echo "<p>AN ERROR OCCURED<p>\n";
	}
}

//Returns the total income for an event
function getIncome($event_id, $db) {
	$total_income = 0;
	
	//Conditional to get prices from tickets
	if ($tickets = $db->query("SELECT * FROM ticket_sales WHERE event_id = $event_id")) {
		while($ticket_sales = $tickets->fetch_assoc()) {
			
			//necessary values
			$ticketType = $ticket_sales['event_ticket_type_id'];
			$ticketOutlet = $ticket_sales['ticket_sales_outlet_id'];
			$numTickets = $ticket_sales['count'];
			
			//The actual price for this ticket is ticketPrice
			$price = $db->query("SELECT price FROM ticket_prices WHERE event_id = $event_id AND event_ticket_type_id = $ticketType");
			$ticketPrice = $price->fetch_assoc()['price'];
			
			//Get the percentage to remove for the outlet
			if ($outlet = $db->query("SELECT fee FROM event_ticket_outlets WHERE ticket_sales_outlet_id = $ticketOutlet")) {
				$feeModifier = 1.0 - $outlet->fetch_assoc()['fee'];
			}
			else {
				$feeModifier = 1.0;
			}
			
			//Calculate the income from tickets and add to total_income
			$total_income += (($numTickets * $ticketPrice) * $feeModifier);
		}
	}
	//Print an error and break if empty
	else {
		echo "<p>AN ERROR OCCURED<p>\n";
		break;
	}

	//Add in 20% of merch sales
	if ($bandInfo = $db->query("SELECT SUM(merchandise_sales) AS merch
		FROM performances WHERE event_id = $event_id;")) {
			$bandMerch = $bandInfo->fetch_assoc()['merch'];
			$total_income += ($bandMerch * .2);
		}
	
	//Add in Season Ticket Allocation if any
	if ($season = $db->query("SELECT season_ticket_allocation FROM events
	WHERE event_id = $event_id")) {
		$seasonAllocation = $season->fetch_assoc()['season_ticket_allocation'];
		$total_income += $seasonAllocation;
	}
	
	return $total_income;
}

//Function to get the total expenses for an event.  
function getExpenses($event_id, $db) {
	if ($expense = $db->query("SELECT SUM(amount) AS cost FROM expenses
	WHERE event_id = $event_id")) {
		return $expense->fetch_assoc()["cost"];
	}
	else {
		echo "<p>AN ERROR OCCURED<p>\n";
	}
}

function printBody($events, $db) {
	
	//Iterate through all events and create their rows
	while ($event = $events->fetch_assoc()) {
		//event_id initialization
		$event_id = $event["event_id"];
		
		//set the date and time fields
		$begin_datetime = new DateTime($event["begin_datetime"]);
		$date = $begin_datetime->format('M j, Y');
		$time = $begin_datetime->format('g:i A');
		
		//set the headline band for this event's name and band_id for use later
		$headline = getHeadline($event_id, $db);
		$band_name = $headline['band_name'];
		$band_id = $headline['band_id'];
		
		//Get the total number of tickets sold for this event
		$tickets_sold = getTicketSales($event_id, $db);
		
		//Get the total income for the event
		$total_income = getIncome($event_id, $db);
		
		//Get the total expenses for each event
		$total_expenses = getExpenses($event_id, $db);
		
		//calculate the net
		$net = $total_income - $total_expenses;
		
		
		echo <<< ROW
			<tr event-id="$event_id">
				<td>$band_name</td>
				<td>$date</td>
				<td>$time</td>
				<td>$tickets_sold</td>
ROW;

//Necessary printf for formatting!

		printf("<td>%.2f</td>\n", $total_income);
		printf("<td>%.2f</td>\n", $total_expenses);
		printf("<td>%.2f</td>\n", $net);
		echo "</tr>\n";
		}
}

//
// This is were the main program begins execution.
//

mainStart($db);
//If we are given a search parameter
if (isset($_GET["search"])) {
	$band = $_GET["search"];
	if ($bandGet = $db->query("SELECT DISTINCT band_id FROM bands WHERE band_name LIKE '%$band%'")) {
		while ($band_id = $bandGet->fetch_assoc()['band_id']) {
			if ($performanceGet = $db->query("SELECT DISTINCT event_id FROM performances WHERE band_id = $band_id")) {
				while ($event_id = $performanceGet->fetch_assoc()['event_id']) {
					if ($events = $db->query("SELECT DISTINCT * FROM events WHERE event_id = $event_id")) {
						printBody($events, $db);
					}
				}
			}
		}
	}
}

//If we are not given a search parameter
else {
	//If we are given a season value
	if (isset($_GET["season"])) {
		$today = $_GET["season"];
	}
	//If no season set to current year
	else {
		$today = date("Y");
	}
	
	//Get the list of events
	$events = getEvents($today, $db);
	
	printBody($events, $db);
}

echo "          </table>\n";
if (isset($_GET["search"])) {
   echo "          <p>Note: Searches find all events where the search term appears
    in the name of ANY band performing at the event.</p>\n";
}
echo <<< END
          </table>
       </main>
    </div>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/home.css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="js/home.js"></script>\n
END;
include "components/footer.php";

?>