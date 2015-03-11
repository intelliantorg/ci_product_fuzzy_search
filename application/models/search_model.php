<?php
/**
 * Copyright (c) 2015 Intelliant
 *
 * Product fuzzy search module
 * 
 * The MIT License (MIT)
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 *  @author Intelliant (open.ant@intelliant.net)
 */

class Search_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_models()
    {
        // Get Search
        $search_string = preg_replace ( "/[^A-Za-z0-9]/", " ", $_POST ['query'] );
        $search_string = preg_replace("/ /","%",$search_string);

        // Check Length More Than One Character
        if (strlen ( $search_string ) >= 1 && $search_string !== ' ') {
            // Build Query
            $this->db->like('name', $search_string, 'both');
            //$query = 'SELECT * FROM product WHERE name LIKE "%' . $search_string . '%" OR name LIKE "%' . $search_string . '%"';
            // Do Search
            $result = $this->db->get('product');
            foreach ( $result->result_array () as $results ) {
                $results_array [] = $results;
            }

            // Check If We Have Results
            if (isset ( $results_array )) {
                foreach ( $results_array as $result ) {

                    // Format Output Strings And Hightlight Matches
                    $split_array = array_filter ( preg_split ( "/[\s%]+/", $search_string ) );
                    $display_name = $result ['name'];
                    foreach ( $split_array as $split ) {
                        $display_name = preg_replace ( "/" . $split . "/i", "__ " . $split . "_ ", $display_name );
                    }
                    // bug fix for highlighting the right words
                    $display_name = preg_replace("/__ /", "<b class='highlight_search'>", $display_name);
                    $display_name = preg_replace("/_ /", "</b>", $display_name);

                    $display_url = '/' . urlencode ( $result ['slug'] );

                    $name_array [] = $display_name;
                    $url_array [] = $display_url;
                }
            }
            //Append no result at the end
            $no_result = "Can't find your model? <span> Click here . . .</span>";
            $no_url = "/#";

            $name_array [] = $no_result;
            $url_array [] = $no_url;

            return array (
                'name' => $name_array,
                'url' => $url_array
            );
        }
    }
}