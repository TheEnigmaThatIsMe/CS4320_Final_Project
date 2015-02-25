<?php
    if( isset($_POST['function_call']) ) {
	
        switch($_POST['function_call']) {
           case 'mapState':
				mapState();
                break;
			case 'gameState':
				gameState();
				break;
			case 'move':
				move();
				break;
			case 'endPhase':
				endPhase($_POST['phase'], $_POST['id']);
				break;
			case 'reinforce':
				reinforce($_POST['territory_id'], $_POST['color']);
				break;
		}
	}

	function endPhase($phase, $id) {
		$db = getDBConn();

		if($phase == "Reinforce"){
			$query = "UPDATE risk.gamestate SET stage_of_turn = 2 WHERE user_id = $1";
		} else if($phase == "Attack"){
			$query = "UPDATE risk.gamestate SET stage_of_turn = 3 WHERE user_id = $1";
		} else if($phase == "Fortify"){
			$query = "UPDATE risk.gamestate SET stage_of_turn = 4 WHERE user_id = $1";
		}
		
		pg_prepare($db, "updatePhase", $query);
		pg_execute($db, "updatePhase", array($id));
		
		if($phase == "Fortify")
			endTurn($id);
			
		pg_close($db);
	}
	
	function endTurn($id) {
		$db = getDBConn();
		
		$query = "SELECT user_id FROM risk.gamestate";
		$result = pg_query($db, $query) or die(pg_last_error());
		
		$resultArr = pg_fetch_all($result);
		$low = $id;
		foreach($resultArr as $array){
			if($array['user_id'] < $low)
				$low = $array['user_id'];
			if($id < $array['user_id']){
				$low = $array['user_id'];
				break;
			}
		}
		
		$query = "UPDATE risk.gamestate SET stage_of_turn = 1 WHERE user_id = $low";
		pg_query($db, $query) or die(pg_last_error());
		
		pg_close($db);
	}
	
    function gameState() {
		$db = getDBConn();
				
		$query =  "SELECT user_id, name, stage_of_turn, color FROM risk.player NATURAL JOIN risk.gamestate WHERE stage_of_turn != 4";
		$result = pg_query($db, $query) or die(pg_last_error());
								
		$array = pg_fetch_array($result);
		echo json_encode($array);
											
		pg_close($db);
	}
    
    function mapState() { 
        $db = getDBConn();
    
		$query = "SELECT * FROM risk.country AS c, risk.player AS p WHERE c.occupied_by = p.user_id";
		$result = pg_query($db, $query) or die(pg_last_error());
	
		$array = array();
		$tempArray = array();
		while($row = pg_fetch_array($result)) {
			$tempArray = $row;
			array_push($array, $tempArray);
		}
		//print_r($array);
		
		/* 	Convert to JSON.  Example output:
			{"0":"1","country_id":"1","1":"Alaska","country_name":"Alaska","2":"North America","continent_name":"North America","3":null,"num_of_troops":null,"4":null,"occupied_by":null}
		*/
		echo json_encode($array);

		pg_close($db);
	}
    
	function reinforce($country_id, $player_color){
		$db = getDBConn();
		
		$country_id = htmlspecialchars($country_id);
		
		$query = "SELECT color FROM risk.player WHERE user_id = (SELECT occupied_by FROM risk.country WHERE country_id = $1)";
		pg_prepare($db, "getTerritoryOwnerColor", $query);
		$result = pg_execute($db, "getTerritoryOwnerColor", array($country_id));
		$result = pg_fetch_row($result);
		
		$player_color = htmlspecialchars($player_color);
		if($result[0] == $player_color){
			$query = "SELECT num_of_troops FROM risk.country WHERE country_id = $1";
			pg_prepare($db, "getTerritoryArmyCount", $query);
			$result = pg_execute($db, "getTerritoryArmyCount", array($country_id));
			$result = pg_fetch_row($result);
			
			$query = "UPDATE risk.country SET num_of_troops = $1 WHERE country_id = $2";
			pg_prepare($db, "updateTerritoryArmy", $query);
			pg_execute($db, "updateTerritoryArmy", array($result[0]+1,$country_id));
			echo "1";
		}
		else
			echo "0";
			
		pg_close($db);
	}
    
    function getDBConn() {
        $conn=("host=dbhost-pgsql.cs.missouri.edu dbname=cs4320f14grp3 user=cs4320f14grp3  password=DL5dQFbH ") or die("unable to connect"); 
      
        return pg_connect($conn);
    }
?>
