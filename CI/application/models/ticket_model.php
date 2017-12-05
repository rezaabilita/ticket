<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * add_ticket function.
	 */
	public function add_ticket($ticket_owner, $ticket_registrant, $ticket_origin, $ticket_origin_city, $ticket_destination, $ticket_destination_city, $ticket_date)
	{
		$data = array(
			'ticket_owner'            => $ticket_owner,
			'ticket_registrant'       => $ticket_registrant,
			'ticket_origin'           => $ticket_origin,
			'ticket_origin_city'      => $ticket_origin_city,
			'ticket_destination'      => $ticket_destination,
			'ticket_destination_city' => $ticket_destination_city,
			'ticket_date'             => $ticket_date,
			'ticket_issue_date'       => date('Y-m-j H:i:s')
		);
		
		return $this->db->insert('tickets', $data);
	}
	
	/**
	 * get_tickets function.
	 */
	public function get_tickets($ticket_owner = -1)
	{
		if($ticket_owner == -1)
		{
			$this->db->select('*')
				 ->from('tickets');
			
			return $this->db->get()->result_array();
		}
		else
		{
			$this->db->select('*')
				 ->from('tickets')
				 ->where('ticket_owner', $ticket_owner);
			
			return $this->db->get()->result_array();
		}
	}
}