DROP TABLE IF EXISTS risk.log CASCADE;
DROP TABLE IF EXISTS risk.authentication CASCADE;
DROP TABLE IF EXISTS risk.user_info CASCADE;
DROP TABLE IF EXISTS risk.gameSetup CASCADE;
DROP TABLE IF EXISTS risk.player CASCADE;
DROP TABLE IF EXISTS risk.country CASCADE;
DROP TABLE IF EXISTS risk.adjcountry CASCADE;
DROP TABLE IF EXISTS risk.riskCards CASCADE;
DROP TABLE IF EXISTS risk.gameState CASCADE;
DROP SCHEMA IF EXISTS risk CASCADE;

CREATE SCHEMA risk;

SET search_path = risk;

-- Table: user_info
-- Columns:
--    username          - The username for the account, supplied during registration.
--    registration_date - The date the user registered. Set automatically.
--    description       - A user-supplied description.
CREATE TABLE user_info (
        username                VARCHAR(30) PRIMARY KEY,
        registration_date       TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        description             VARCHAR(500)
);

-- Table: authentication
-- Columns:
--    username      - The username tied to the authentication info.
--    password_hash - The hash of the user's password + salt. Expected to be SHA1.
--    salt          - The salt to use. Expected to be a SHA1 hash of a random input.
CREATE TABLE authentication (
        username        VARCHAR(30) PRIMARY KEY,
        password_hash   CHAR(40) NOT NULL,
        salt            CHAR(40) NOT NULL,
        FOREIGN KEY (username) REFERENCES user_info(username)
);

CREATE TABLE gameSetup (
	gameID serial PRIMARY KEY,
	gameName varchar(20) NOT NULL,
	gameState varchar(10) default 'open'
);

CREATE TABLE player (
	user_id  integer PRIMARY KEY,
	name character varying(25) NOT NULL,
	FOREIGN KEY (name) REFERENCES user_info(username),
	color character varying(15) NOT NULL,
	army_at_turn_num integer,
	risk_card_turn_in_count integer,
	gameID serial,
		FOREIGN KEY (gameID) REFERENCES gameSetup(gameID)
);

CREATE TABLE country (
    country_id  integer PRIMARY KEY,
    country_name character varying(25) NOT NULL,
    continent_name character varying(25) NOT NULL,
    num_of_troops character varying(25),
    occupied_by integer,
	 FOREIGN KEY (occupied_by) REFERENCES player(user_id)
);

CREATE TABLE adjcountry (
    country_id integer, 
	FOREIGN KEY (country_id) REFERENCES country(country_id),
    adjacent_to integer,
	 FOREIGN KEY (adjacent_to)REFERENCES country(country_id),
    PRIMARY KEY(country_id, adjacent_to)
);

CREATE TABLE riskCards (
    card_type character varying(25),
    card_ID  integer PRIMARY KEY,
    owner_ID integer,
	 FOREIGN KEY (owner_ID) REFERENCES player(user_id)
);

CREATE TABLE gameState (
   user_id integer,
	FOREIGN KEY (user_id) REFERENCES player(user_id),  
   stage_of_turn integer, --1 = Trade in Cards/Place new troops, 2 = Moving troops, 3 = Attacking, 4 = End of turn 
  PRIMARY KEY(user_id)
);
