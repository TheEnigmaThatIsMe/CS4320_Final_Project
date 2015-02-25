<?php
	function Move ($data1,$data2)//data1 is start's id,data2 is default's id	
	{
		//this parts should be in model
		/*$query1="select * from country where country_id= {$data1}"; 
		$query2="select * from country where country_id= {$data2}"; 
		$conn=("host= dbname= user=  password= "); 
		$db = pg_connect($conn);   
		if (!$db) {
			echo "Error:Unable to open database\n";
		}
		$data1=pg_query($db,$query1);//start country status
		$data2=pg_query($db,$query2);
		*/ 
		$row1=pg_fetch_row($data1);
		$row2=pg_fetch_row($data2);
		if($row1[3]>1)//check if the num_of_troops is more than 1
		{
			$query_adj="select * from adjcountry where country_id={$data1} and adjacent_to={$data2}";
			if(pg_query($db,$query_adj))//if two countries are adjacent
			{
				if((row1[4]==row2[4]))//if the countries belong to one player
				{
				/*	update the database, you can put the code in model
			    $query_update1="update country set num_of_troops={$row1[3]+1} where country_id={$row1[0]}";
				$query_update2="update country set num_of_troops={$row2[3]-1} where country_id={$row2[0]}";
				pg_query($db,$query_update1);
				pg_query($db,$query_update2);
				*/
					return 1;//1 represent moving request accept, then update the database in the model and update armies number in UI at view
			    }
			    else return 2;//2 represent need ask player whether like to fight
		    }
			else return 3;//3  represent cannot make the moving action
		}
		else return 3; //3 represent cannot make the moving action
	}
?>