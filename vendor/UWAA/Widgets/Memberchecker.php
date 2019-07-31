<?php namespace UWAA\Widgets;

/**
 * UWAA Memberchecker  @TODO
 * Places a Login form for showing content only to UWAA Members.
 * To Be Implemented after launch.
 */

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\SessionHandlerProxy;

class MemberChecker extends \WP_Widget
{

  const ID    = 'uwaa-memberchecker';
  const TITLE = 'UWAA MemberChecker';
  const DESC  = 'Puts a MemberChecker widget on to pages, enableing Members to see custom content.';


function __construct()
  {
      parent::__construct(
      $id      = self::ID,
      $name    = self::TITLE,
      $options = array(
        'description' => self::DESC,
        'classname'   => self::ID
      )
    );
      $this->UI = new \UWAA\View\UI;

  }




}