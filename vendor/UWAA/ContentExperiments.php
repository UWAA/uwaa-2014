<?php namespace UWAA;



class ContentExperiments
{

  PRIVATE $bayAreaPages; 

  function __construct()
  {
    
    $this->bayAreaPages = array('16376', '2825');  //Values correspond to the two pages for the content experiment
    
    add_action('wp_head', array( $this, 'bayAreaListSignUp' ));
    
  }

  public function bayAreaListSignUp () {

    if (is_single($this->bayAreaPages) ){

    $tag = <<<EOT
<!-- Google Analytics Content Experiment code -->
<script>function utmx_section(){}function utmx(){}(function(){var
k='2823890-0',d=document,l=d.location,c=d.cookie;
if(l.search.indexOf('utm_expid='+k)>0)return;
function f(n){if(c){var i=c.indexOf(n+'=');if(i>-1){var j=c.
indexOf(';',i);return escape(c.substring(i+n.length+1,j<0?c.
length:j))}}}var x=f('__utmx'),xx=f('__utmxx'),h=l.hash;d.write(
'<sc'+'ript src="'+'http'+(l.protocol=='https:'?'s://ssl':
'://www')+'.google-analytics.com/ga_exp.js?'+'utmxkey='+k+
'&utmx='+(x?x:'')+'&utmxx='+(xx?xx:'')+'&utmxtime='+new Date().
valueOf()+(h?'&utmxhash='+escape(h.substr(1)):'')+
'" type="text/javascript" charset="utf-8"><\/sc'+'ript>')})();
</script><script>utmx('url','A/B');</script>
<!-- End of Google Analytics Content Experiment code -->
EOT;

echo $tag;

}
  }
   
}