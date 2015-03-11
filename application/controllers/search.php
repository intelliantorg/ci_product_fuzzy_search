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

class Search extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index($code=false, $page = 0)
    {
        $data['title'] = 'Ajax Search';

        $this->load->view('search', $data);
    }

    function searchbar() 	// Dynamic search
    {
        $this->load->model ( 'Search_model' );
        $data ['res'] = $this->Search_model->get_models (); // Get the models w.r.t input written in the bar
        $this->load->view ( 'search_result', $data );
    }
}