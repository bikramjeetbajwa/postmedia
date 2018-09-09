<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access	public
 * @param	string	the language line
 * @param   string  the sulfix
 * @param	array	an array of variables and values
 * @param	string	the id of the form element
 * @return	string
 */
if ( ! function_exists('cs_lang'))
{
    function cs_lang($line, $sulfix = "", $vars = array(), $id = '')
    {
        $CI =& get_instance();
        $defaultLine = $line;
        $line = $CI->lang->line($line);

        if(!empty($line)) {
            if(!empty($vars)) {
                $line = strtr($line, $vars);
            }

            if ($id != '')
            {
                $line = '<label for="'.$id.'">'.$line."</label>";
            }

            if(isset($sulfix)) {
                $line .= $sulfix;
            }
        } else {
            $line = $defaultLine;
        }


        return $line;
    }
}

// ------------------------------------------------------------------------
/* End of file cs_language_helper.php */
/* Location: ./application/helpers/cs_language_helper.php */