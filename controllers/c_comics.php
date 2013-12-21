<?php
class comics_controller extends base_controller 
{
	public function __construct() 
	{
		parent::__construct();

		# Make sure user is logged in if they want to use anything in this controller
		if(!$this->user) 
		{
			Router::redirect("/users/login");
		}
	}

	public function index() 
	{
		# Set up the View
		$this->template->content = View::instance('v_comics_index');
		$this->template->title   = "The Gallery";
		$client_files = Array("/css/comic-main.css");
		$this->template->client_files_head = Utils::load_client_files($client_files);
		
		# Build the query
		$q = "SELECT 
			comics.comic_id,
			comics.comic_html,
			comics.created,
			comics.user_id AS comic_user_id,
			status
			FROM comics
			WHERE comics.user_id = " . $this->user->user_id .
			" ORDER by comics.created desc";

		# Run the query
		$comics = DB::instance(DB_NAME)->select_rows($q);

		# Pass data to the View
		$this->template->content->comics = $comics;

		# Render the View
		echo $this->template;
	}
	
	public function gallery() 
	{
		# Set up the View
		$this->template->content = View::instance('v_comics_gallery');
		$this->template->title   = "The Gallery";
		$client_files = Array("/css/comic-main.css");
		$this->template->client_files_head = Utils::load_client_files($client_files);
		
		# Build the query
		$q = "SELECT 
			comics.comic_html,
			comics.created,
			comics.user_id AS comic_user_id,
			users.first_name,
			users.last_name,
			users.user_name
			FROM comics
			INNER JOIN users 
			ON comics.user_id = users.user_id
			WHERE comics.status = 'public'
			ORDER by comics.created desc";

		# Run the query
		$comics = DB::instance(DB_NAME)->select_rows($q);

		# Pass data to the View
		$this->template->content->comics = $comics;

		# Render the View
		echo $this->template;
	}

	public function create($error = NULL) 
	{
		# Setup view
		$this->template->content = View::instance('v_comics_create');
		$this->template->title   = "Create a Comic";
		$client_files = Array("/css/post.css",
				"/css/comic-main.css",
				"/css/jquery-ui.min.css");
		$this->template->client_files_head = Utils::load_client_files($client_files);

		$client_files = Array("/js/jquery-1.9.1.min.js",
				"/js/jquery-ui.min.js",
				"/js/comic-creator.js");
		$this->template->client_files_body = Utils::load_client_files($client_files);
				
		if($error)
		{
			$this->template->content->error = "Please enter something to meow about!";
		}

		# Build the query
		$q = "SELECT 
			comic_html,
			created,
			comic_id
			FROM comics
			WHERE user_id = ".$this->user->user_id.
			" ORDER BY created desc";

		# Run the query
		$comics = DB::instance(DB_NAME)->select_rows($q);

		# Pass data to the View
		$this->template->content->comics = $comics;

		# Render template
		echo $this->template;
	}

	public function p_create() 
	{
		if(!empty($_POST['comic_html']))
		{
			# Associate this post with this user
			$_POST['user_id']  = $this->user->user_id;

			# The x and y are from the image submit button
			unset($_POST['x']);	
			unset($_POST['y']);

			# Unix timestamp of when this post was created / modified
			$_POST['created']  = Time::now();
			$_POST['modified'] = Time::now();

			# Insert
			# Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
			DB::instance(DB_NAME)->insert('comics', $_POST);

			# Take user back to add post page
			echo("Saved!");
		}
		else
		{
			# User did not enter any content to be posted
			echo("Error saving.  Please try again.");
		}
	}

	public function delete($comic_id) 
	{
		# Delete this post
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND comic_id = '.$comic_id;
		DB::instance(DB_NAME)->delete('comics', $where_condition);

		# Send user back to their personal comics page
		Router::redirect("/comics/index");
	}

	public function users($search_term = NULL) 
	{
		# Set up the View
		$this->template->content = View::instance("v_comics_users");
		$this->template->title   = "Potential Prey";
		$client_files = Array("/css/users.css");
		$this->template->client_files_head = Utils::load_client_files($client_files);

		if(!$search_term)
		{
			# Build the query to get all the users except the current user
			$q = "SELECT *
				FROM users 
				WHERE user_id<>".$this->user->user_id.
				" ORDER BY first_name, last_name, user_id";
		}
		else
		{
			# A search term was provided, so search the users by email and/or name
			$q = "SELECT *
				FROM users
				WHERE (email like '%".$search_term."%'
				OR first_name like '%".$search_term."%'
				OR last_name like '%".$search_term."%'
				OR user_name like '%".$search_term."%')
				AND user_id<>".$this->user->user_id.
				" ORDER BY first_name, last_name, user_id";
		}

		# Execute the query to get all the users. 
		# Store the result array in the variable $users
		$users = DB::instance(DB_NAME)->select_rows($q);

		# No users found, but if search, display appropriate messaging.
		if(count($users) == 0 && isset($search_term))
		{			
			$this->template->content->message = "Your search did not return any results.";
		}

		# Build the query to figure out what connections does this user already have? 
		# I.e. who are they following
		/*$q = "SELECT * 
			FROM users_users
			WHERE user_id = ".$this->user->user_id;
*/
		# Execute this query with the select_array method
		# select_array will return our results in an array and use the "users_id_followed" field as the index.
		# This will come in handy when we get to the view
		# Store our results (an array) in the variable $connections
//		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

		$connections = array();

		# Pass data (users and connections) to the view
		$this->template->content->users       = $users;
		$this->template->content->connections = $connections;

		# Render the view
		echo $this->template;
	}

	public function follow($user_id_followed) 
	{
		# Prepare the data array to be inserted
		$data = Array(
			"created" => Time::now(),
			"user_id" => $this->user->user_id,
			"user_id_followed" => $user_id_followed
			);

		# Do the insert
		DB::instance(DB_NAME)->insert('users_users', $data);

		# If this call was to have user default "follow" self,
		# send them to their profile page
		# Else send back to users list page
		if($user_id_followed == $this->user->user_id)
		{
			Router::redirect("/users/profile");
		}
		else
		{
			Router::redirect("/comics/users");
		}
	}

	public function unfollow($user_id_followed) 
	{
		# Delete this connection
		$where_condition = "WHERE user_id = ".$this->user->user_id." AND user_id_followed = ".$user_id_followed;
		DB::instance(DB_NAME)->delete('users_users', $where_condition);

		# Send them back
		Router::redirect("/comics/users");
	}

	public function post_unfollow($user_id_followed) 
	{
		# Delete this connection
		$where_condition = "WHERE user_id = ".$this->user->user_id." AND user_id_followed = ".$user_id_followed;
		DB::instance(DB_NAME)->delete('users_users', $where_condition);

		# Send them back
		Router::redirect("/comics/index");
	}

	public function p_search()
	{
		# Check if actual search term was present
		if(!empty($_POST['search_term']))
		{
			# Clean search data
			$_POST = Validate::clean_data($_POST);

			# Take user back to search page with query data
			Router::redirect("/comics/users/".$_POST['search_term']);
		}
		else
		{
			# User did not enter a search query
			Router::redirect("/comics/users");
		}
	}
}
?>