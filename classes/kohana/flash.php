<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Manager Flash Messaging
 *
 * @package    Manager
 * @category   Base
 * @author     Dan Gibbs
 * @copyright  (c) 2012 Gold Coast Media Ltd
 */
class Kohana_Flash {
 
	/**
	 * @var  string  The default view
	 */
	public static $default_view = 'flash/default';

	/**
	 * @var  string  The default session key
	 */
	public static $session_key = 'flash';

	/**
	 * Flash message type constants
	 */
	const SUCCESS = 'success';
	const INFO    = 'info';
	const NOTICE  = 'notice';
	const WARNING = 'warning';
	const ERROR   = 'error';

	/**
	 * Set a new message
	 *
	 * @param   string  flash type
	 * @param   string  flash message
	 * @param   array   flash options
	 */
	public static function set($type, $message, $options = array())
	{
		// Existing messages
		$messages = (array) Flash::get();

		// Add a new message
		$messages[] = (object) array(
			'type'    => $type,
			'text' => $message,
			'options' => $options,
		);

		Session::instance()->set(Flash::$session_key, $messages);
	}

	/**
	 * Returns all flash messages
	 *
	 * @return  array or NULL
	 */
	public static function get()
	{
		return Session::instance()->get(Flash::$session_key);
	}

	/**
	 * Clear all flash messages
	 */
	public static function clear()
	{
		return Session::instance()->delete(Flash::$session_key);
	}

	/**
	 * Render all flash messages
	 *
	 * @param   mixed    view string or object
	 * @param   boolean  clear flash messages after render
	 * @return  string   flash message output
	 */
	public static function render($view = NULL, $clear = TRUE)
	{
		// Check flash messages are available to get
		if(($messages = Flash::get()) === NULL) {
			return NULL;
		}

		// Clear flash messages
		if($clear) {
			Flash::clear();
		}

		// Use the default view if unset
		$view === NULL AND $view = Flash::$default_view;

		if( ! $view instanceof Kohana_View) {
			$view = View::factory($view);
		}

		$view->set_global('flash', $messages);

		return $view->render();
	}

	/**
	 * Set a SUCCESS flash message
	 */
	public static function success($message)
	{
		self::set(Flash::SUCCESS, $message);
	}

	/**
	 * Sets an INFO flash message
	 */
	public static function info($message)
	{
		self::set(Flash::INFO, $message);
	}

	/**
	 * Sets a NOTICE flash message
	 */
	public static function notice($message)
	{
		self::set(Flash::NOTICE, $message);
	}

	/**
	 * Sets a WARNING flash message
	 */
	public static function warning($message)
	{
		self::set(Flash::WARNING, $message);
	}

	/**
	 * Sets an ERROR flash message
	 */
	public static function error($message)
	{
		self::set(Flash::ERROR, $message);
	}
}

