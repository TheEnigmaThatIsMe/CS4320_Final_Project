<?php
	function DrawCard($data_freecard,$data_check)
	{
		//$query="select card_ID from riskCards where owner_ID=0";
		//$data=pg_query($db,$query);
		$i=0;
		while($row=pg_fetch_row($data_freecard))
		{
			$a[$i]=$row;
			$i++;
		}
		$n=array_rand($a);
		//$a[$n] is card_ID of chosen card
		/*update the database, you can put the code in model
   	    $query_update1="update riskCards set owner_ID={$user_id} where card_ID={$a[$n]}";			
		pg_query($db,$query_update1);
		*/	
		/*update the database, you can put the code in model
   	    $query_update2="update player set card_count={ where user_id={$user_id}";			
		pg_query($db,$query_update2);
		*/	//maybe need this
		//query_check="select count(card_ID) from player where user_id={$user_id}";
		//$data_check=pg_query($db,$query_check);
		if($data_check>=7)
		{
			//echo "you need to tradecard"//use javasript
			//if($x='yes') tradecard($user_id);	
			return 1;//tell player you must trade card
		}
		else return 2;//2 represent end this function
	}
?>
		
