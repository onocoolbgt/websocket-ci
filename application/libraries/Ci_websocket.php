<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Ci_websocket {
    /**
	 * CI Super Instance
	 * @var array
	 */
	private $CI;

	/**
	 * Default host var
	 * @var string
	 */
	public $host = null;

	/**
	 * Default host var
	 * @var string
	 */
	public $port = null;

	/**
	 * Default auth var
	 * @var bool
	 */
	public $auth = false;

	/**
	 * Default debug var
	 * @var bool
	 */
	public $debug = false;

	/**
	 * Auth callback informations
	 * @var array
	 */
	public $callback = array();

	/**
	 * Config vars
	 * @var array
	 */
	protected $config = array();


	/**
	 * Define allowed callbacks
	 * @var array
	 */
	protected $callback_type = array('init','open','msg', 'close','error');

    /**
	 * Class Constructor
	 * @method __construct
	 * @param array $config Configuration
	 * @return void
	 */
    public function __construct()
	{
		// Load the CI instance
		$this->CI = &get_instance();

		// Load the class helper
		$this->CI->load->helper('ci_ws');

        $this->CI->config->load('websocket');
        
		$this->config = $this->CI->config->config;

		// Config file verification
		if (empty($this->config['ci_ws'])) {
			output('fatal', 'The configuration file does not exist');
		}

		// Assign HOST value to class var
		$this->host = (!empty($this->config['ci_ws']['host'])) ? $this->config['ci_ws']['host'] : '';

		// Assign PORT value to class var
		$this->port = (!empty($this->config['ci_ws']['port'])) ? $this->config['ci_ws']['port'] : '';


		// Assign DEBUG value to class var
		$this->debug = (!empty($this->config['ci_ws']['debug'] && $this->config['ci_ws']['debug'])) ? true : false;
	}

    /**
	 * Launch the server
	 * @method run
	 * @return string
	 */
	public function run()
	{
		// Initiliaze all the necessary class
		$server = IoServer::factory(
			new HttpServer(
				new WsServer(
					new Server()
				)
			),
			$this->port,
			$this->host
		);

		// Run the socket connection !
		$server->run();
	}

    public function set_callback($type = null, array $callback = array())
	{
		// Check if we have an authorized callback given
		if (!empty($type) && in_array($type, $this->callback_type)) {

			// Verify if the method does really exists
			if (is_callable($callback)) {

				// Register callback as class var
				$this->callback[$type] = $callback;
			} else {
				output('fatal', 'Method ' . $callback[1] . ' is not defined');
			}
		}
	}
}

class Server implements MessageComponentInterface {

    protected $clients;

    public function __construct() {
		// Load the CI instance
		$this->CI = &get_instance();

        $this->clients = new SplObjectStorage;


        // We have to check if event callback must be called
        if (!empty($this->CI->ci_websocket->callback['init'])) {

            // At this moment we have to check if we have authent callback defined
            call_user_func_array($this->CI->ci_websocket->callback['init'],
                array());

            // Output
            if ($this->CI->ci_websocket->debug) {
                output('info', 'Callback init "' . $this->CI->ci_websocket->callback['init'][1] . '" called');
            }
        }
		// Output
			output('success',
				'Running server on host ' . $this->CI->ci_websocket->host . ':' . $this->CI->ci_websocket->port);

    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        // We have to check if event callback must be called
        if (!empty($this->CI->ci_websocket->callback['open'])) {

            // At this moment we have to check if we have authent callback defined
            call_user_func_array($this->CI->ci_websocket->callback['open'],
                array($this->clients,$conn));

            // Output
            if ($this->CI->ci_websocket->debug) {
                output('info', 'Callback open "' . $this->CI->ci_websocket->callback['open'][1] . '" called');
            }
        }else{
			echo "New connection! ({$conn->resourceId})\n";
		}
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // We have to check if event callback must be called
        if (!empty($this->CI->ci_websocket->callback['msg'])) {

            // At this moment we have to check if we have authent callback defined
            call_user_func_array($this->CI->ci_websocket->callback['msg'],
                array($from,$msg, $this->clients));

            // Output
            if ($this->CI->ci_websocket->debug) {
                output('info', 'Callback msg "' . $this->CI->ci_websocket->callback['msg'][1] . '" called');
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {

        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        if (!empty($this->CI->ci_websocket->callback['close'])) {

            // At this moment we have to check if we have authent callback defined
            call_user_func_array($this->CI->ci_websocket->callback['close'],
                array($this->clients,$conn));

            // Output
            if ($this->CI->ci_websocket->debug) {
                output('info', 'Callback close "' . $this->CI->ci_websocket->callback['close'][1] . '" called');
            }
        }else{
			echo "Connection ({$conn->resourceId}) has disconnected\n";
		}
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
		if (!empty($this->CI->ci_websocket->callback['error'])) {

            // At this moment we have to check if we have authent callback defined
            call_user_func_array($this->CI->ci_websocket->callback['error'],
                array($conn,$e));

            // Output
            if ($this->CI->ci_websocket->debug) {
                output('info', 'Callback error "' . $this->CI->ci_websocket->callback['error'][1] . '" called');
            }
        }else{
			echo "An error has occurred: {$e->getMessage()}\n";
		}

        $conn->close();
    }

    /**
	 * Function to send the message
	 * @method send_message
	 * @param object $user User to send
	 * @param array $message Message
	 * @param object $client Sender
	 * @return string
	 */
	protected function send_message($user = array(), $message = array(), $client = array())
	{
		// Send the message
		$user->send($message);

		// We have to check if event callback must be called
		if (!empty($this->CI->ci_websocket->callback['event'])) {

			// At this moment we have to check if we have authent callback defined
			call_user_func_array($this->CI->ci_websocket->callback['event'],
				array((valid_json($message) ? json_decode($message) : $message)));

			// Output
			if ($this->CI->ci_websocket->debug) {
				output('info', 'Callback event "' . $this->CI->ci_websocket->callback['event'][1] . '" called');
			}
		}

		// Output
		if ($this->CI->ci_websocket->debug) {
			output('info',
				'Client (' . $client->resourceId . ') send \'' . $message . '\' to (' . $user->resourceId . ')');
		}
	}
}