<?php
	function TradeCard($data_trade)
	{
		//$query="select * from riskCards where owner_ID={$user_id}";
		//$data=pg_query($db,$query);
		$i=0;$j=0;$k=0;
		while($row=pg_fetch_row($data_trade))
		{
			if($row[0]='infantry')
			{
				$a[$i]=$row[2];
				$i++;
			}
			else if($row[0]='cavalry')
			{
				$b[$j]=$row[2];
				$j++;
			}	
			else($row[0]='artilleryman')
			{
				$a[$k]=$row[2];
				$k++;
			}
		}
		if($i>=3)
		{
			/*$query1="update riskCards set owner_ID={0} where card_ID={$a[$i]}";
			$query2="update riskCards set owner_ID={0} where card_ID={$a[$i-1]}";
			$query3="update riskCards set owner_ID={0} where card_ID={$a[$i-2]}";
			$query_count="update player set card_count={? where user_id={$user_id}";
			pg_query($db,$query1);
			pg_query($db,$query2);
			pg_query($db,$query3);
			pg_query($db,$query_count);*/
			/*if($i>=6||$j>=3||$k>=3)
			{
				//echo "do you want to trade again?";//javascript
				//if($x='yes') tradecard(user_id);
				
				return 1;//
			}*/
			return 1;//1 represent give armies, and then update database
		}
		else if($j>=3)
		{
			/*$query1="update riskCards set owner_ID={0} where card_ID={$a[$j]}";
			$query2="update riskCards set owner_ID={0} where card_ID={$a[$j-1]}";
			$query3="update riskCards set owner_ID={0} where card_ID={$a[$j-2]}";
			$query_count="update player set card_count={? where user_id={$user_id}";
			pg_query($db,$query1);
			pg_query($db,$query2);
			pg_query($db,$query3);
			pg_query($db,$query_count);
			if($j>=6||$k>=3)
			{
				echo "do you want to trade again?";//javascript
				if($x='yes') tradecard(user_id);
				else return 1;
			}*/	
			return 1;//1 represent give armies
		}
		else if($k>=3)
		{
			/*$query1="update riskCards set owner_ID={0} where card_ID={$a[$k]}";
			$query2="update riskCards set owner_ID={0} where card_ID={$a[$k-1]}";
			$query3="update riskCards set owner_ID={0} where card_ID={$a[$k-2]}";
			$query_count="update player set card_count={? where user_id={$user_id}";
			pg_query($db,$query1);
			pg_query($db,$query2);
			pg_query($db,$query3);
			pg_query($db,$query_count);
			if($k>=6)
			{
				echo "do you want to trade again?";//javascript
				if($x='yes') tradecard(user_id);
				else return 1;
			}*/	
			return 1;//1 represent give armies
		}
		else return 2;//2 represent you cannot trade card*/
	}
?>	