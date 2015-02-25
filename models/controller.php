<?php
class controller
{
	function Move ($data1,$data2,$data_adj)//data1 is start's id,data2 is default's id	
	{
		//this parts should be in model
		$row1=pg_fetch_row($data1);
		$row2=pg_fetch_row($data2);
		if($row1[3]>1)//check if the num_of_troops is more than 1
		{
			//$query_adj="select * from adjcountry where country_id={$data1} and adjacent_to={$data2}";
			if($data_adj!=NULL)//if two countries are adjacent
			{
				if((row1[4]==row2[4]))//if the countries belong to one player
				{
					return 1;//1 represent moving request accept, then update the database in the model and update armies number in UI at view
			    }
			    else return 2;//2 represent need ask player whether like to fight
		    }
			else return 3;//3  represent cannot make the moving action
		}
		else return 3; //3 represent cannot make the moving action
	}

	function Attack($data1,$data2,$data_adj)//data1 is start's id,data2 is default's id
	{
		//this part should be in model
		$row1 = pg_fetch_row($data1);
		$row2 = pg_fetch_row($data2);
		if($row1[3]>1&&$data_adj!=NULL)//check if the start's num_of_troops is more than 1 and if two countries are adjacent
		{
			if((row1[4]==row2[4]))//if the countries belong to one player
			{
				return 0;//0 cannot attack
		    }
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
		
			if($row2[3]>=2)//if the default's num_of_troops >=2 then you will have 2 dice
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
			$def_troops_num=$def_troops_num-1;
			if($def_troops_num==0)
			return 1; //1 represent the attacker win this fight and could occupied the country update database and view
			else return 2;//2 represent attacker win this fight and update database and let view give window to choose if need attack again
		}
		else
		{
			return 3;//3 represent defender win this fight and update database and let view give window to choose if need attack again
		}
	}
	
	function DrawCard($data_freecard,$data_check)
	{
		$i=0;
		while($row=pg_fetch_row($data_freecard))
		{
			$a[$i]=$row;
			$i++;
		}
		$n=array_rand($a);
		if($data_check>=7)
		{
			return 1;//tell player you must trade card
		}
		else return 2;//2 represent end this function
	}
		
	function TradeCard($data_trade)
	{
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
			return 1;//1 represent give armies, and then update database
		}
		else if($j>=3)
		{
			return 1;//1 represent give armies
		}
		else if($k>=3)
		{
	
			return 1;//1 represent give armies
		}
		else return 2;//2 represent you cannot trade card*/
	}


	function Init($playerlist,$countryID)//$player list is a player ID array
	{
		$player_count=count($playerlist);
		$player_init_troops_count=(10-$player_count)*round(40*0.12);
	//for($n=1;$n<$player_count+1;$n++)
	//{}
		return $player_init_troops_count;
	/*
    
	*/
	}
/*
In UI in each player's turn
Init()
$n=$player_init_troops_count;
VIEW click get the countryID and the playerID
$n=Place_army($n);
if($n>0)
make the model update the database;
end this player's turn and enter the next in view


*/
	function Init_turn($new_troops_cards,$count_countries,$continent_occupied_count)//after each turn the player could receive some new troops to place
	{
		$new_troops_num=3;//the minimum troops number of a player could gain at the turn beginning are 3 
		for($i=0;$i<$new_troops_cards+1;$i++)
		{
			$new_troops_num=$new_troops_num+3+2*$i;
		}
		$new_troops_num=$new_troops_num+$count_countries;
		if($continent_occupied_coun==0)
		return $new_troops_num;
		else 
		{
			$new_troops_num=$new_troops_num+$continent_occupied_count*5;
			return $new_troops_num;
		}
	}

	function Place_army($troops_count)
	{
		if($troops_count>0)
		{
			$troops_count=$troops_count-1;
			return $troops_count;
		}
		else return 0;//0 represent the player has run out of their available troops
	
	}
}


/*//every turn 
   current player ID,
   TradeCard(....);
   $troops_num=init_turn(......);
   every time a click happen in UI
   get the user click country ID
   place_army($troops_num);send the results back to model
   update the database in model
   
   get user click in UI in MOVE turn
   Move(...);
   
   get user click and input from UI in attack turn
   Attack(...);
   
   May be a DrawCard(...);
   
   End turn;
   
   
   
   
   click
view get palyer input information//UI 
send IDs to model, search
model return search results back to controller
controller deal with the dataset, return the final results to model
model save the change to database
view change the vision effect base on database
*/


	