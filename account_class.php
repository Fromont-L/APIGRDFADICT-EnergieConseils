<?php

	class Account
	{
		/* Class properties (variables) */
		
		/* The ID of the logged in account (or NULL if there is no logged in account) */
		private $id;
		
		/* The name of the logged in account (or NULL if there is no logged in account) */
		private $name;

		/* TRUE if the user is authenticated, FALSE otherwise */
		private $authenticated;

		/* Détermine si le compte est Admin ou non */
		private $isAdmin;
		
		
		/* Public class methods (functions) */

		/* Pour avoir la possibilité de créer un compte, veiller à ajouter les fonctions suivantes : et si vous voulez toute la panoplie pour éditer/supprimer ajouter les fonctions suivantes : editAccount() */

		/* Add a new account to the system and return its ID (the account_id column of the accounts table) */
		public function addAccount(string $name, string $passwd): int 
		{
			/* Global $pdo object */
			global $pdo;
			
			/* Trim the strings to remove extra spaces */
			$name = trim($name);
			$passwd = trim($passwd);
			
			/* Check if the user name is valid. If not, throw an exception */
			if (!$this->isNameValid($name))
			{
				throw new Exception('Nom d\'utilisateur invalide');
			}
			
			/* Check if the password is valid. If not, throw an exception */
			if (!$this->isPasswdValid($passwd))
			{
				throw new Exception('Mot de passe invalide');
			}
			
			/* Check if an account having the same name already exists. If it does, throw an exception */
			if (!is_null($this->getIdFromName($name)))
			{
				throw new Exception('Nom d\'utilisateur indisponible');
			}
			
			/* Finally, add the new account */
			
			/* Insert query template */
			$query = 'INSERT INTO accounts (account_name, account_passwd) VALUES (:name, :passwd)';
			
			/* Password hash */
			$hash = password_hash($passwd, PASSWORD_DEFAULT);
			
			/* Values array for PDO */
			$values = array(':name' => $name, ':passwd' => $hash);
			
			/* Execute the query */
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
			   /* If there is a PDO exception, throw a standard exception */
			   throw new Exception('Database query error');
			}
			
			/* Return the new ID */
			return $pdo->lastInsertId();
		}


		/* A sanitization check for the account username */
		public function isNameValid(string $name): bool
		{
			/* Initialize the return variable */
			$valid = TRUE;
			
			/* Example check: the length must be between 8 and 16 chars */
			$len = mb_strlen($name);
			
			if (($len < 1) || ($len > 160))
			{
				$valid = FALSE;
			}
			
			/* You can add more checks here */
			
			return $valid;
		}

		/* A sanitization check for the account password */
		public function isPasswdValid(string $passwd): bool
		{
			/* Initialize the return variable */
			$valid = TRUE;
			
			/* Example check: the length must be between 8 and 16 chars */
			$len = mb_strlen($passwd);
			
			if (($len < 1) || ($len > 160))
			{
				$valid = FALSE;
			}
			
			/* You can add more checks here */
			
			return $valid;
		}

		/* Login with username and password */
		public function login(string $name, string $passwd): bool
		{
			/* Global $pdo object */
			global $pdo;	
			
			/* Trim the strings to remove extra spaces */
			$name = trim($name);
			$passwd = trim($passwd);
			
			/* Check if the user name is valid. If not, return FALSE meaning the authentication failed */
			if (!$this->isNameValid($name))
			{
				return FALSE;
			}
			
			/* Check if the password is valid. If not, return FALSE meaning the authentication failed */
			if (!$this->isPasswdValid($passwd))
			{
				return FALSE;
			}
			
			/* Look for the account in the db. Note: the account must be enabled (account_enabled = 1) */
			$query = 'SELECT * FROM accounts WHERE (account_name = :name) AND (account_enabled = 1)';
			
			/* Values array for PDO */
			$values = array(':name' => $name);
			
			/* Execute the query */
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
			   /* If there is a PDO exception, throw a standard exception */
			   throw new Exception('Database query error');
			}
			
			$row = $res->fetch(PDO::FETCH_ASSOC);
			
			/* If there is a result, we must check if the password matches using password_verify() */
			if (is_array($row))
			{
				if (password_verify($passwd, $row['account_passwd']))
				{
					/* Authentication succeeded. Set the class properties (id and name) */
					$this->id = intval($row['account_id'], 10);
					$this->name = $name;
					$this->authenticated = TRUE;
					$this->isAdmin = $row['account_is_admin'];
					
					/* Register the current Sessions on the database */
					$this->registerLoginSession();
					
					/* Finally, Return TRUE */
					return TRUE;
				}
			}
			
			/* If we are here, it means the authentication failed: return FALSE */
			return FALSE;
		}

		/* Saves the current Session ID with the account ID */
		private function registerLoginSession()
		{
			/* Global $pdo object */
			global $pdo;
			
			/* Check that a Session has been started */
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				/* 	Use a REPLACE statement to:
					- insert a new row with the session id, if it doesn't exist, or...
					- update the row having the session id, if it does exist.
				*/
				$query = 'REPLACE INTO account_sessions (session_id, account_id, login_time) VALUES (:sid, :accountId, NOW())';
				$values = array(':sid' => session_id(), ':accountId' => $this->id);
				
				/* Execute the query */
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e)
				{
				   /* If there is a PDO exception, throw a standard exception */
				   throw new Exception('Database query error');
				}
			}
		}

		/* Login using Sessions */
		public function sessionLogin(): bool
		{
			/* Global $pdo object */
			global $pdo;
			
			/* Check that the Session has been started */
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				/* 
					Query template to look for the current session ID on the account_sessions table.
					The query also make sure the Session is not older than 7 days
				*/
				$query = 
				
				'SELECT * FROM account_sessions, accounts WHERE (account_sessions.session_id = :sid) ' . 
				'AND (account_sessions.login_time >= (NOW() - INTERVAL 7 DAY)) AND (account_sessions.account_id = accounts.account_id) ' . 
				'AND (accounts.account_enabled = 1)';
				
				/* Values array for PDO */
				$values = array(':sid' => session_id());
				
				/* Execute the query */
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e)
				{
				   /* If there is a PDO exception, throw a standard exception */
				   throw new Exception('Database query error');
				}
				
				$row = $res->fetch(PDO::FETCH_ASSOC);
				
				if (is_array($row))
				{
					/* Authentication succeeded. Set the class properties (id and name) and return TRUE*/
					$this->id = intval($row['account_id'], 10);
					$this->name = $row['account_name'];
					$this->authenticated = TRUE;
					$this->isAdmin = $row['account_is_admin'];

					
					return TRUE;
				}
			}
			
			/* If we are here, the authentication failed */
			return FALSE;
		}

		/* Logout the current user */
		public function logout()
		{
			/* Global $pdo object */
			global $pdo;	
			
			/* If there is no logged in user, do nothing */
			if (is_null($this->id))
			{
				return;
			}
			
			/* Reset the account-related properties */
			$this->id = NULL;
			$this->name = NULL;
			$this->authenticated = FALSE;
			$this->isAdmin = FALSE;
			
			/* If there is an open Session, remove it from the account_sessions table */
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				/* Delete query */
				$query = 'DELETE FROM account_sessions WHERE (session_id = :sid)';
				
				/* Values array for PDO */
				$values = array(':sid' => session_id());
				
				/* Execute the query */
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
					session_destroy();
				}
				catch (PDOException $e)
				{
				   /* If there is a PDO exception, throw a standard exception */
				   throw new Exception('Database query error');
				}
			}
		}

		/* "Getter" function for the $authenticated variable
		    Returns TRUE if the remote user is authenticated */
		public function isAuthenticated(): bool
		{
			return $this->authenticated;
		}

		/* Close all account Sessions except for the current one (aka: "logout from other devices") */
		public function closeOtherSessions()
		{
			/* Global $pdo object */
			global $pdo;
			
			/* If there is no logged in user, do nothing */
			if (is_null($this->id))
			{
				return;
			}
			
			/* Check that a Session has been started */
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				/* Delete all account Sessions with session_id different from the current one */
				$query = 'DELETE FROM account_sessions WHERE (session_id != :sid) AND (account_id = :account_id)';
				
				/* Values array for PDO */
				$values = array(':sid' => session_id(), ':account_id' => $this->id);
				
				/* Execute the query */
				try
				{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e)
				{
					/* If there is a PDO exception, throw a standard exception */
					throw new Exception('Database query error');
				}
			}
		}

		public function isAdmin()
		{
			return $this->isAdmin;
		}

		/* Returns the account id having $name as name, or NULL if it's not found */
		public function getIdFromName(string $name): ?int
		{
			/* Global $pdo object */
			global $pdo;
			
			/* Since this method is public, we check $name again here */
			if (!$this->isNameValid($name))
			{
				throw new Exception('Nom d\'utilisateur invalide');
			}
			
			/* Initialize the return value. If no account is found, return NULL */
			$id = NULL;
			
			/* Search the ID on the database */
			$query = 'SELECT account_id FROM accounts WHERE (account_name = :name)';
			$values = array(':name' => $name);
			
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
			   /* If there is a PDO exception, throw a standard exception */
			   throw new Exception('Database query error');
			}
			
			$row = $res->fetch(PDO::FETCH_ASSOC);
			
			/* There is a result: get it's ID */
			if (is_array($row))
			{
				$id = intval($row['account_id'], 10);
			}
			
			return $id;
		}

		/* A sanitization check for the account ID */
		public function isIdValid(int $id): bool
		{
			/* Initialize the return variable */
			$valid = TRUE;
			
			/* Example check: the ID must be between 1 and 1000000 */
			
			if (($id < 1) || ($id > 1000000))
			{
				$valid = FALSE;
			}
			
			/* You can add more checks here */
			
			return $valid;
		}

		/* Delete an account (selected by its ID) */
		public function deleteAccount(int $id)
		{
			/* Global $pdo object */
			global $pdo;
			
			/* Check if the ID is valid */
			if (!$this->isIdValid($id))
			{
				throw new Exception('Invalid account ID');
			}
			
			/* Query template */
			$query = 'DELETE FROM accounts WHERE account_id = :id';
			
			/* Values array for PDO */
			$values = array(':id' => $id);
			
			/* Execute the query */
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
			   /* If there is a PDO exception, throw a standard exception */
			   throw new Exception('Database query error');
			}

			/* Delete the Sessions related to the account */
			$query = 'DELETE FROM account_sessions WHERE (account_id = :id)';

			/* Values array for PDO */
			$values = array(':id' => $id);

			/* Execute the query */
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
			   /* If there is a PDO exception, throw a standard exception */
			   throw new Exception('Database query error');
			}
		}
		
		
		/* Constructor */
		public function __construct()
		{
			/* Initialize the $id and $name variables to NULL */
			$this->id = NULL;
			$this->name = NULL;
			$this->authenticated = FALSE;
			$this->isAdmin = FALSE;
		}
		
		/* Destructor */
		public function __destruct()
		{
			
		}
	}
?>