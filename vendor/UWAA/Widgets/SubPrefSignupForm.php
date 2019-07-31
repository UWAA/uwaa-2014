<?php namespace UWAA\Widgets;

      /**
       * UWAA Featured Tour Sidebar Widget
       * Used to pull and display pull quote material in the sidebar for Regional Pages, Tours, Events and Stories.
       */

      class SubPrefSignupForm extends \WP_Widget
      {
          const ID    = 'uw-advancement-preference-form';
          const TITLE = 'UW Marketo SubPref Form';
          const DESC  = 'Adds a UW Marketo Subscription Signup Form to the website';
          public $subscriptionID;
          public $fromName;
          public $fromEmail;
          public $showPlaceHolders;
          public $hideLabels;
          public $returnURL;


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

          }

          /**
           * Outputs the options form on admin
           *
           * @param array $instance The widget options
           */
          public function form( $instance ) {
              // outputs the options form on admin
              // TODO for modularization
          }


          public function widget($args, $instance)
          {


              $this->subscriptionID = 997;
              $this->fromName = "UW Alumni Association";
              $this->fromEmail = "uwalumni@uw.edu";
              $this->showPlaceHolders = TRUE;
              $this->hideLabels = TRUE;
              $this->returnURL = "";

              //initialize required variables with defaults
              //iterate through instance array, matching indicies
              //if present, overwrite default.

              $content =<<<CONTENT

<script type="text/javascript" src="https://subscribe.gifts.washington.edu/Scripts/SubManBuilder/submanbuilder.js" id="uwSubscriptionManager"></script>
<script type="text/javascript">
    SUBMANBUILDER.makeIframe({
        subscriptionID: {$this->subscriptionID},           //REQUIRED: Subscription ID people will be signing up to
        fromName: "{$this->fromName}", //RECOMMENDED: From name of the confirmation email
        fromEmail: "{$this->fromEmail}",   //RECOMMENDED: From email of the confirmation email
        showPlaceHolders: {$this->showPlaceHolders},      //OPTIONAL: Show placeholder text inside the text boxes
        hideLabels: {$this->hideLabels},           //OPTIONAL: Hide form labels
        returnURL: "{$this->returnURL}",                //OPTIONAL: Confirmation page is different than sign up page
    });
</script>
CONTENT;


              echo $content;




          }

      }

    register_widget( 'UWAA\Widgets\SubPrefSignupForm' );