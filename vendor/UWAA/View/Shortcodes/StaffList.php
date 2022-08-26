<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class StaffList
{

    const DATAURL = "https://staff.washington.edu/bperick/staff/stafflist.json";


    function __construct()
    {
        
        add_shortcode('staff-list', array($this, 'addStaffList'));
        
    }
    


    public  function addStaffList( $atts, $content="" ) {        

        $request = wp_remote_get( self::DATAURL);

        if($request['response']['code'] == 200){
            $staffPayload = json_decode( $request['body']);

            $staff = $staffPayload->StaffList;

            
             usort($staff, array($this, 'departmentSort'));
             
            $content .= '<h2 class="uwaa-team-name">Leadership</h2>';

            $department = null;
            foreach ($staff as $staffer ) {

                

                if($department && $staffer->Department != $department)
                {
                    $content .= '<h2 class="uwaa-team-name">'.$staffer->Department.'</h2>';
                }
                
                $content .= sprintf( '<p class="uwaa-staff"><strong>%1$s %2$s</strong></br>%3$s</br><a href="mailto:%4$s">%4$s</a>', $staffer->First, $staffer->Last, $staffer->Position, $staffer->Email);

                $department = $staffer->Department;
                }  

                return $content;
            
            
        } else {
            return new WP_Error( 'broke', __( "I've fallen and can't get up" ) );            
        }
        

    }

    private function departmentSort($a, $b)
    {
        
        if ($a->DepartmentOrder > $b->DepartmentOrder) return 1;
        elseif ($a->DepartmentOrder < $b->DepartmentOrder) return -1;
        
        if ($a->StaffOrder > $b->StaffOrder) return 1;
        elseif ($a->StaffOrder < $b->StaffOrder) return -1;

        else return 0;
        
        
    }

    
        

}