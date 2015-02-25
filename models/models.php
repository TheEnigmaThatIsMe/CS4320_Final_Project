<?php 
	function Move($country_name1, $country_name2)
	{
		$query1 = "SELECT * FROM country WHERE (country_id = $1)";
		$query2 = "SELECT * FROM country WHERE (country_id = $2)";
		$query3 = "SELECT * FROM adjcountry WHERE (country_id = $1) AND (adjacent_to = $2)";
		
		pg_prepare($conn,"country1".$query1);
		$result1 = pg_execute($conn,"country1",array($country_name1);

		pg_prepare($conn,"country2",$query2);
		$result2 = pg_execute($conn,"country2",array($country_name2);

		pg_prepare($conn,"country3",$query3);
		$result3 = pg_execute($conn,"checkmatch",array($country_name1,$country_name2);

	}


	function Updatemove($country_name1, $country_name)
	{
		$query_update1 = "update country SET num_of_troops = (SELECT num_of_troops FROM counry WHERE country_name = $1) - 1 
                                        WHERE country_name = $2";

		$query_update2 = "update country SET num_of_troops = (SELECT num_of_troops FROM counry WHERE country_name = $1) + 1 
                                        WHERE country_name = $2";

                pg_prepare($conn,"update1",$query_update1);
		$result1 = pg_execute($conn,"update1",array($country_name1,$country_name1);

		pg_prepare($conn,"update2",$query_update2);
		$result2 = pg_execute($conn,"update2",array($country_name2,$country_name2);
	}



/*
	function Updateattack($country_name1,$country_name2)
	{
		$query1 = "SELECT * FROM country WHERE (country_id = $1)";
		$query2 = "SELECT * FROM country WHERE (country_id = $2)";
*/

	function Drawcard ($owner_ID, $card_ID)
	{
		$query_update1 = "update riskCards SET owner_ID = $1 WHERE card_ID = $2";
		pg_prepare ($conn,"update1",$query_update1);
		$result1 = pg_execute($conn,"update1",array($owner_ID,$card_ID);

		$query_check = "SELECT COUNT(card_ID) FROM riskCard WHERE owner_ID = $1";
		pg_prepare ($conn,"update2",$query_update2);
		$result2 = pg_execute($conn,"update2",array($owner_ID);
	}














