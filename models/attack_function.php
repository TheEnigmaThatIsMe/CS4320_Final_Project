<?php
	function Attack($data1,$data2)//data1 is start's id,data2 is default's id
	{
		//this part should be in model
		/*$query1="select * from country where country_id= {$data1}"; 
		$query2="select * from country where country_id= {$data2}"; 
		$conn=("host= dbname= user=  password= "); 
		$db = pg_connect($conn);   
		if (!$db) {
			echo "Error:Unable to open database\n";
		}
		$data1=pg_query($db,$query1);
		$data2=pg_query($db,$query2);
		*/
		$row1 = pg_fetch_row($data1);
		$row2 = pg_fetch_row($data2);
		if($row1[3]>1)//check if the start's num_of_troops is more than 1
		{
			if($row1[3]>=4)//if the start's num_of_troops >=4 then you will have 3 dices
			{	
				for($i=1;$i<4;$i++)
				{
					$x[i]=rand(1,6);
				}
				$max1=array_search(max($x),$x);//find the maximum
			}
			else if($row1[3]=3)//if the start's num_of_troops =3 then you will have 2 dices
			{
				for($i=1;$i<3;$i++)
				{
					$x[i]=rand(1,6);
				}
				if($x[1]>$x[2]) $max1=$x[1];
				else $max1=$x[2];	
			}
			else //if the start's num_of_troops =2 then you will have 1 dice
			{ 
				$max1=rand(1,6);
			}
		
			if($row2[3]>=2)//if the default's num_of_troops >=2 then you will have 2 dices
			{	
				for($i=1;$i<3;$i++)
				{
					$y[i]=rand(1,6);
				}
				if($y[1]>$y[2]) $max2=$y[1];
				else $max2=$y[2];
			}
			else $max2=rand(1,6);//if the start's num_of_troops =1 then you will have 1 dice	
		}
		else return 0;//0 represent you cannot attack
		
		if(max1>max2)
		{
			/*	update the database, you can put the code in model
			$query_update2="update country set num_of_troops={$row2[3]-1} where occupied_by={$row2[4]}";
			pg_query($db,$query_update2);
			*/
			/*if(($row2[3]-1)==0) 
			{
			    //should put it in model
				$query_update_country="update country set occupied_by={row1[4]} where country_id={$data2}";
				$query_update_startplayer="delete";
				$query_update_defaultplayer="add";
				pg_query($db,$query_update_country);
				pg_query($db,$query_update_startplayer);
				pg_query($db,$query_update_defaultplayer);
				
				echo "how many armies you want to move?"//use javascript
		        if($x>$row1[3]) $x=$row1[3];//x is the value you want to move
                if($x<=0) $x=1;		      
			    //update the database, you can put the code in model
			    $query_update1="update country set num_of_troops={$row1[3]-$x} where country_id={$data1}";
				$query_update2="update country set num_of_troops={$x} where country_id={$data2}";
				pg_query($db,$query_update1);
				pg_query($db,$query_update2);
				
				drawcard($row1[4]);
			}
			else 
			{
				echo "do you want to attack again?"//use javascript
				if ($y='yes') attack($data1,$data2);
				else return 2;//2 represent end the attack
			}*/
			retrun 1; //1 represent the attacker win this fight
		}
		else
		{
			/*update the database, you can put the code in model
		    $query_update1="update country set num_of_troops={$row1[3]-1} where country_id={$data1}";			
			pg_query($db,$query_update1);
			*/
			return 2//2 represent defender win this fight
		}
	}
?>