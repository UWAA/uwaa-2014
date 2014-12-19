<?php namespace UWAA;
//
// Custom Admin Meta Box API
// V 1.0
// Inspiration:
// http://www.wproots.com/ultimate-guide-to-meta-boxes-in-wordpress/
// https://github.com/JeffreyWay/Easy-WordPress-Custom-Post-Types
//////////////



class CustomPostData {

    protected $meta_box;
    protected $id;

    static $prefix = "mb_";

    // Create Meta Boxes based on input

    public function __construct($id, $options) {
        if(!is_admin()) {
            return;
        }

        $this->meta_box = $options;
        $this->id = $id;

        add_action ('add_meta_boxes', array(&$this, 'add'));
        add_action( 'save_post', array(&$this, 'save'));

    }

    //Add meta boxes for multiple post types
    public function add() {
        foreach ($this->meta_box['pages'] as $page) {
            add_meta_box($this->id, $this->meta_box['title'], array(&$this,
                'show') , $page, $this->meta_box['context'], $this->meta_box['priority']);
        }
    }

    //Callback to show selected fields
    public function show($post) {
        wp_nonce_field($this->id, $this->id.'_nonce' );


        

        echo '<table class="form-table">';
        foreach ($this->meta_box['fields'] as $field) {
            extract($field);
            $id = self::$prefix . $id;
            $value = self::get($field['id']);          
            

        // Input Type Array
        $lookup = array(
        "text" => "<input type=\"text\" name=\"$id\" value=\"$value\" class=\"widefat\" />",
        "textarea" => "<textarea name='$id' class='widefat' rows='10'>$value</textarea>",
        "checkbox" => "<input type='checkbox' name='$id' value='$name' />",
        "select" => $type == 'select' ? $this->renderSelect($id, $options, $value) : '' ,
        "file" => "<input type='file' name='$id' id='$id' />"
        
        );
        

            if (empty($value) && !sizeof(self::get($field['id'], false))) {
                $value = isset($field['default']) ? $default : '';
            }

                echo '<tr>', '<th style="width:20%"><label for="', $id, '">', $name, '</label></th>', '<td>';

                echo $lookup[is_array($type) ? $type[0] : $type];
                
                if (isset($desc)) {
                echo '&nbsp;<span class="description">' . $desc . '</span>';
                }
                echo '</td></tr>';
        }
        echo '</table>';
        //
    }


    public function save($post_id) {

    //no nonce?  no saving this post...
    if (!isset($_POST[$this->id .'_nonce'])  || !wp_verify_nonce($_POST[$this->id .'_nonce'], $this->id ) ) {
        return $post_id;
    }

    //Don't run for autosaves
    if (defined('DOING_AUTOSAVE')  && DOING_AUTOSAVE ) {
        return $post_id;
    }

    //Check user perms
    if ('page' == $_POST['post_type']) {

        if( !current_user_can ('edit_page', $post_id)){
            return $post_id;
        }
    } else {

        if(!current_user_can('edit_post', $post_id)){
            return $post_id;
        }
    }

    

    foreach ($this->meta_box['fields'] as $field) {
        $name = self::$prefix . $field['id'];
        $sanitize_callback = (isset($field['sanitize_callback'])) ? $field['sanitize_callback'] : '';
        if (isset($_POST[$name])) {  //LATER- Add File Uploads If Needed
            $old = self::get($field['id'], true, $post_id);
            $new = $_POST[$name];
            if ($new != $old) {
                self::set($field['id'], $new, $post_id, $sanitize_callback);
            } 
        } elseif ($field['type'] == 'checkbox') {
            self::set($field['id'], 'false', $post_id, $sanitize_callback);
        } else {
            self::delete($field['id'], $name);
        }
    }


    }//end public function save

    private function get($name, $single = true, $post_id = null ) {
        global $post;
        return get_post_meta(isset($post_id) ? $post_id : $post->ID, self::$prefix . $name, $single);
    }

    private function set ($name, $new, $post_id = null, $sanitize_callback = '') {
        global $post;

        $id = (isset($post_id)) ? $post_id : $post->ID;
        $meta_key = self::$prefix . $name;
        $new = ($sanitize_callback != '' && is_callable($sanitize_callback)) ? call_user_func($sanitize_callback, $new, $meta_key, $id) : $new;
        return update_post_meta($id, $meta_key, $new);
    }

    private function delete($name, $post_id= null) {
        global $post;
        return delete_post_meta(isset($post_id) ? $post_id : $post->ID, self::$prefix . $name);

    }

    private function renderSelect($id, $options, $value) {

        $return = "<select name=\"$id\" id=\"$id\">";
        foreach ($options as $opt_value=>$opt_name):
            $return .= "<option ". selected($value, $opt_value, false)." value=\"$opt_value\">$opt_name</option>";
        endforeach;
        $return .= "</select></br>";

        return $return;

    }


};  






