<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class panel extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		// load helpers
		$this->load->helper('form');
		
		// load libraries
		$this->load->library('form_validation');
		
		// load models
		$this->load->model('user_model');
		$this->load->model('ticket_model');
	}
	
	/**
	 * Home page.
	 */
	public function index()
	{
		// redirect user to login page if not logged in yet
		if(!$this->isOnline())
			redirect('panel/login', 'refresh');
		
		// create the data object
		$data = new stdClass();
		
		// get user
		$user = $this->user_model->get_user($this->session->userdata('user_id'));
		
		// get user rank
		$user_rank = $this->get_permission($user->user_rank);
		
		if($user_rank == 'is_owner')
		{
			$tickets    = $this->get_tickets();
			$my_tickets = $this->get_tickets($user->id);
		}
		else
			$my_tickets = $this->get_tickets($user->id);
		
		// prepare some data
		$data->user_id    = $this->session->userdata('user_id');
		$data->user_rank  = $user_rank;
		$data->my_tickets = $my_tickets;
		
		if($user_rank == 'is_owner')
			$data->tickets = $tickets;
		
		// pass data to view
		$this->getHeader('پنل', 'page_home');
		$this->load->view('panel/panel', $data);
		$this->getFooter();
	}
	
	/**
	 * Login page.
	 */
	public function login()
	{
		// redirect to home page if user already logged in
		if($this->isOnline())
			redirect('/');
		
		// create the data object
		$data = new stdClass();
		
		// set validation rules
		$this->form_validation->set_rules('email', 'ایمیل', 'required|valid_email');
		$this->form_validation->set_rules('password', 'پسورد', 'required');
		
		if($this->form_validation->run() == false)
		{
			// validation not ok, send validation errors to the view
			$this->getHeader('پنل - ورود', 'page_login');
			$this->load->view('panel/login/login');
			$this->getFooter();
		}
		else
		{
			// set variables from the form
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			
			if($this->user_model->user_login($email, $password))
			{
				$user_id = $this->user_model->get_user_id_by_email($email);
				$user    = $this->user_model->get_user($user_id);
				
				// set session user datas
				$_SESSION['user_id']    = (int)$user->id;
				$_SESSION['user_email'] = (string)$user->user_email;
				$_SESSION['logged_in']  = (bool)true;
				
				// user login ok
				$this->getHeader('پنل - ورود', 'page_login');
				$this->load->view('panel/login/login_success');
				$this->getFooter();
			}
			else
			{
				// login failed
				$data->error = 'ایمیل و رمز عبور مطابقت ندارند.';
				
				// send error to the view
				$this->getHeader('پنل - ورود', 'page_login');
				$this->load->view('panel/login/login', $data);
				$this->getFooter();
			}
		}
	}
	
	/**
	 * Register page.
	 */
	public function register()
	{
		// redirect user to login page if not logged in yet
		if(!$this->isOnline())
			redirect('panel/login', 'refresh');
		
		// get current user
		$user = $this->user_model->get_user($this->session->userdata('user_id'));
		
		// redirect to home page if user dosen't have permission
		if($this->get_permission($user->user_rank) != 'is_owner')
			redirect('/');
		
		// create the data object
		$data = new stdClass();
		
		// set validation rules
		$this->form_validation->set_rules('first_name', 'نام', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('last_name', 'نام خانوادگی', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('email', 'ایمیل', 'trim|required|valid_email|is_unique[users.user_email]');
		$this->form_validation->set_rules('password', 'پسورد', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password2', 'تایید پسورد', 'trim|required|min_length[6]|matches[password]');
		
		if($this->form_validation->run() === false)
		{
			// validation not ok, send validation errors to the view
			$this->getHeader('پنل - ثبت کاربر', 'page_register');
			$this->load->view('panel/register/register');
			$this->getFooter();
		}
		else
		{
			// set variables from the form
			$first_name = $this->input->post('first_name');
			$last_name  = $this->input->post('last_name');
			$email      = $this->input->post('email');
			$password   = $this->input->post('password');
			$role       = $this->input->post('role');
			
			if($this->user_model->create_user($first_name, $last_name, $email, $password, $role))
			{
				// prepare some data
				$data->first_name = $first_name;
				$data->last_name  = $last_name;
				$data->email      = $email;
				$data->password   = $password;
				$data->role       = $this->get_permission($role);
				
				// user creation ok
				$this->getHeader('پنل - ثبت کاربر', 'page_register');
				$this->load->view('panel/register/register_success', $data);
				$this->getFooter();
			}
			else
			{
				// user creation failed, this should never happen
				$data->error = 'خطایی رخ داده است لطفا مجددا امتحان کنید.';
				
				// send error to the view
				$this->getHeader('پنل - ثبت کاربر', 'page_register');
				$this->load->view('panel/register/register', $data);
				$this->getFooter();
			}
		}
	}
	
	/**
	 * Logout page.
	 */
	public function logout()
	{	
		if($this->isOnline())
		{
			// remove session datas
			foreach($_SESSION as $key => $value)
				unset($_SESSION[$key]);
			
			// user logout ok
			$this->getHeader('پنل - خروج', 'page_logout');
			$this->load->view('panel/logout/logout_success');
			$this->getFooter();
		}
		else
		{
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
		}
	}
	
	/**
	 * Add ticket page.
	 */
	public function addticket()
	{
		// redirect user to login page if not logged in yet
		if(!$this->isOnline())
			redirect('panel/login', 'refresh');
		
		// get current user
		$user = $this->user_model->get_user($this->session->userdata('user_id'));
		
		// redirect to home page if user dosen't have permission
		if($this->get_permission($user->user_rank) != 'is_owner')
			redirect('/');
		
		// create the data object
		$data = new stdClass();
		
		// list of Iran's cities library
		require_once('application/libraries/cities.php');
		
		// page data
		$data->provinces = $provinces;
		$data->cities    = $cities;
		
		// set validation rules
		$this->form_validation->set_rules('ticket_owner', 'صاحب بلیط', 'trim|required|callback_ticket_owner_check');
		$this->form_validation->set_rules('travel_date', 'تاریخ سفر', 'required');
		
		if($this->form_validation->run() === false)
		{
			$this->getHeader('پنل - ثبت بلیط', 'page_addticket');
			$this->load->view('panel/ticket/addticket', $data);
			$this->getFooter();
		}
		else
		{
			// set variables from the form
			$ticket_owner_id         = $this->user_model->get_user_id_by_email($this->input->post('ticket_owner'));
			$ticket_origin           = $this->input->post('ticket_origin');
			$ticket_origin_city      = $this->input->post('ticket_origin_city');
			$ticket_destination      = $this->input->post('ticket_destination');
			$ticket_destination_city = $this->input->post('ticket_destination_city');
			$ticket_travel_date      = $this->input->post('travel_date');
			
			if($this->ticket_model->add_ticket($ticket_owner_id, $this->session->userdata('user_id'), $ticket_origin, $ticket_origin_city, $ticket_destination, $ticket_destination_city, $ticket_travel_date))
			{
				// get ticket owner account
				$ticket_owner = $this->user_model->get_user($ticket_owner_id);
				
				// get current account
				$user = $this->user_model->get_user($this->session->userdata('user_id'));
				
				// prepare some data
				$data->ticket_owner_name           = $ticket_owner->user_fname;
				$data->ticket_owner_last_name      = $ticket_owner->user_lname;
				$data->ticket_owner_email          = $ticket_owner->user_email;
				$data->ticket_origin               = $provinces[$ticket_origin];
				$data->ticket_origin_city          = $cities[$ticket_origin][$ticket_origin_city];
				$data->ticket_destination          = $provinces[$ticket_destination];
				$data->ticket_destination_city     = $cities[$ticket_origin][$ticket_destination_city];
				$data->ticket_travel_date          = $ticket_travel_date;
				$data->ticket_registrant_name      = $user->user_fname;
				$data->ticket_registrant_last_name = $user->user_lname;
				
				// ticket add ok
				$this->getHeader('پنل - ثبت بلیط', 'page_addticket');
				$this->load->view('panel/ticket/addticket_success', $data);
				$this->getFooter();
			}
			else
			{
				// ticket add failed, this should never happen
				$data->error = 'خطایی رخ داده است لطفا مجددا امتحان کنید.';
				
				// send error to the view
				$this->getHeader('پنل - ثبت بلیط', 'page_addticket');
				$this->load->view('panel/ticket/addticket', $data);
				$this->getFooter();
			}
		}
	}
	
	/**
	 * Validate ticket owner
	 */
	public function ticket_owner_check($str)
	{
		if($this->user_model->get_user_id_by_email($str))
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('ticket_owner_check', 'فیلد {field} باید حاوی ایمیل معتبر یکی از کاربران باشد.');
			return false;
		}
	}
	
	/**
	 * Get tickets
	 */
	private function get_tickets($user = -1)
	{
		if($user == -1)
			$tickets = $this->ticket_model->get_tickets();
		else
			$tickets = $this->ticket_model->get_tickets($user);
		
		if($tickets)
		{
			// list of Iran's cities library
			require('application/libraries/cities.php');
			
			foreach($tickets as $key => $value)
			{
				// save ticket owner id
				$tickets[$key]['ticket_owner_id'] = $tickets[$key]['ticket_owner'];
				
				// format ticket owner
				$user = $this->user_model->get_user($tickets[$key]['ticket_owner']);
				$tickets[$key]['ticket_owner'] = $user->user_fname . ' ' . $user->user_lname;
				
				// save ticket owner email
				$tickets[$key]['ticket_owner_email'] = $user->user_email;
				
				// format ticket registrant
				$user = $this->user_model->get_user($tickets[$key]['ticket_registrant']);
				$tickets[$key]['ticket_registrant'] = $user->user_fname . ' ' . $user->user_lname;
				
				// format ticket origin
				$ticket_origin      = $tickets[$key]['ticket_origin'];
				$ticket_origin_city = $tickets[$key]['ticket_origin_city'];
				
				$tickets[$key]['ticket_origin']      = $provinces[$ticket_origin];
				$tickets[$key]['ticket_origin_city'] = $cities[$ticket_origin][$ticket_origin_city];
				
				// format ticket destination
				$ticket_destination      = $tickets[$key]['ticket_destination'];
				$ticket_destination_city = $tickets[$key]['ticket_destination_city'];
				
				$tickets[$key]['ticket_destination']      = $provinces[$ticket_destination];
				$tickets[$key]['ticket_destination_city'] = $cities[$ticket_destination][$ticket_destination_city];
			}
			
			return $tickets;
		}
		else
		{
			return 'هیچ سفری یافت نشد.';
		}
	}
	
	/**
	 * Sample page.
	 */
	public function sample()
	{
		// redirect user to login page if not logged in yet
		if(!$this->isOnline())
			redirect('panel/login', 'refresh');
		
		// get current user
		$user = $this->user_model->get_user($this->session->userdata('user_id'));
		
		// redirect to home page if user dosen't have permission
		if($this->get_permission($user->user_rank) != 'is_owner')
			redirect('/');
		
		// create the data object
		$data = new stdClass();
		
		$data->samples = $this->user_model->get_samples();
		
		// set validation rules
		$this->form_validation->set_rules('first_name', 'نام', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('last_name', 'نام خانوادگی', 'trim|required|alpha_numeric');
		
		if($this->form_validation->run() === false)
		{
			// validation not ok, send validation errors to the view
			$this->getHeader('پنل - سمپل', 'page_sample');
			$this->load->view('panel/sample/sample', $data);
			$this->getFooter();
		}
		else
		{
			// set variables from the form
			$first_name = $this->input->post('first_name');
			$last_name  = $this->input->post('last_name');
			
			if($this->user_model->create_sample($first_name, $last_name))
			{
				// prepare some data
				$data->first_name = $first_name;
				$data->last_name  = $last_name;
				
				// user creation ok
				$this->getHeader('پنل - سمپل', 'page_sample');
				$this->load->view('panel/sample/sample_success', $data);
				$this->getFooter();
			}
			else
			{
				// user creation failed, this should never happen
				$data->error = 'خطایی رخ داده است لطفا مجددا امتحان کنید.';
				
				// send error to the view
				$this->getHeader('پنل - سمپل', 'page_sample');
				$this->load->view('panel/sample/sample', $data);
				$this->getFooter();
			}
		}
	}

	/**
	 * Get current user rank
	 */
	private function get_permission($rank_id = 0)
	{
		switch($rank_id)
		{
			case 1:
				return 'is_user';
				break;
			case 2:
				return 'is_donator';
				break;
			case 3:
				return 'is_moderator';
				break;
			case 4:
				return 'is_administrator';
				break;
			case 5:
				return 'is_owner';
				break;
			default:
				return 'is_guest';
		}
	}
	
	/**
	 * Get current user online status
	 */
	private function isOnline()
	{
		if($this->session->userdata('logged_in'))
			return true;
		else
			return false;
	}
	
	/**
	 * Get header
	 */
	private function getHeader($title = '', $class = 'page_default', $css = null, $js = null)
	{
		$header_data = array(
			'page_title' => $title,
			'page_css'   => $css,
			'page_js'    => $js,
			'page_class' => $class,
			'isOnline'   => $this->isOnline()
		);
		
		// push more data if user is already logged in
		if($this->isOnline())
		{
			// get user
			$user = $this->user_model->get_user($this->session->userdata('user_id'));
			
			$header_data['user_fname']    = $user->user_fname;
			$header_data['user_lname']    = $user->user_lname;
			$header_data['user_rankID']   = $user->user_rank;
			$header_data['user_rankName'] = $this->get_permission($user->user_rank);
		}
		
		return $this->load->view('header', $header_data);
	}
	
	/**
	 * Get footer
	 */
	private function getFooter()
	{
		return $this->load->view('footer');
	}
}
