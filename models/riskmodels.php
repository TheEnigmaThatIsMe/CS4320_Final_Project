<?php 
	function Move($country_id1, $country_id2)
        {
         
		$conn=("host=dbhost-pgsql.cs.missouri.edu dbname = cs4320f14grp3 user = cs4320f14grp3 password = DL5dQFbH");

                $query1 = "SELECT num_of_troops FROM risk.country WHERE (country_id = $1)";
                $query2 = "SELECT num_of_troops FROM risk.country WHERE (country_id = $1)";
                $query3 = "SELECT * FROM risk.adjcountry WHERE (country_id = $1) AND (adjacent_to = $2)";

		$link = pg_connect($conn);

                pg_prepare($link,"country1",$query1);
                $data1 = pg_execute($link,"country1",array($country_id1));

                pg_prepare($link,"country2",$query2);
                $data2 = pg_execute($link,"country2",array($country_id2));

                pg_prepare($link,"checkmatch",$query3);
                $data3 = pg_execute($link,"checkmatch",array($country_id1,$country_id2));

		$result = array();
		$result1 = pg_fetch_row($data1);
		$result2 = pg_fetch_row($data2);
		$result3 = pg_fetch_row($data3);

		$result = array_merge($result1,$result2,$result3);
                pg_close($link);
		return $result;
        }


	function Updatemove($country_id1, $country_id2)
        {
		$conn=("host=dbhost-pgsql.cs.missouri.edu dbname = cs4320f14grp3 user = cs4320f14grp3 password = DL5dQFbH");
		$link = pg_connect($conn);

                $query_update1 = "UPDATE country SET num_of_troops = (SELECT num_of_troops FROM counry WHERE country_id = $1) - 1 
                                        WHERE country_id = $2";

                $query_update2 = "UPDATE country SET num_of_troops = (SELECT num_of_troops FROM counry WHERE country_id = $1) + 1 
                                        WHERE country_id = $2";

                pg_prepare($link,"update1",$query_update1);
                $data1 = pg_execute($link,"update1",array($country_id1,$country_id1);

                pg_prepare($link,"update2",$query_update2);
                $data2 = pg_execute($link,"update2",array($country_id2,$country_id2);
       
		$result = array();
                $result1 = pg_fetch_row($data1);
                $result2 = pg_fetch_row($data2);

		$result = array_merge($result1,$result2);
                pg_close($link);

		return $result;
	 }


	function Drawcard ($owner_ID, $card_ID)
        {
		$conn=("host=dbhost-pgsql.cs.missouri.edu dbname = cs4320f14grp3 user = cs4320f14grp3 password = DL5dQFbH");
                $link = pg_connect($conn);

                $query_update1 = "UPDATE riskCards SET owner_ID = $1 WHERE card_ID = $2";
                pg_prepare ($link,"update1",$query_update1);
                $data1 = pg_execute($link,"update1",array($owner_ID,$card_ID);

                $query_check = "SELECT COUNT(card_ID) FROM riskCard WHERE owner_ID = $1";
                pg_prepare ($conn,"update2",$query_update2);
                $data2 = pg_execute($link,"update2",array($owner_ID);
        
		$result = array();
                $result1 = pg_fetch_row($data1);
                $result2 = pg_fetch_row($data2);
         
                $result = array_merge($result1,$result2);
                pg_close($link);

		return $result;
	}


	function TradeCard($owner_ID)
	{
		$conn=("host=dbhost-pgsql.cs.missouri.edu dbname = cs4320f14grp3 user = cs4320f14grp3 password = DL5dQFbH");
                $link = pg_connect($conn);

		$query = "SELECT card_type FROM riskCards WHERE owner_ID = $1";
		pg_prepare ($conn,"cardtype",$query);
		$data = pg_execute($conn, "cardtype", array($owner_ID);

		$result1 = pg_fetch_row($data);
 		pg_close($link);
		
		return $result1;
?>


