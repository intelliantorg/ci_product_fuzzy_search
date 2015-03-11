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

/**
 * @see Testimonial::index();
 * @var $testimonial
 * @var $title
 */
?>
<html>
<head>
    <title><?php echo $title ?> - CodeIgniter 2 Tutorial</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <style>
        section {
            margin: 20px auto 0;
            width: 83.33%;
        }
        .testimonial_text {
            float: left;
            height: auto;
            margin-right: 5%;
            margin-top: 0;
            width: 55%;
        }
        p {
            color: #7b7c7c;
            font-family: sans-serif;
            font-size: 16px;
        }
        .testimonial_video {
            float: right;
            height: auto;
            overflow: hidden;
            width: 40%;
        }
    </style>
    <script>
        $(document).ready(function() {

            // Live Search
            // On Search Submit and Get Results
            function search() {
                var query_value = $('input#search').val();
                var controller = "search";
                var base_url = document.location.origin;
                //$('b#search-string').html(query_value);
                if (query_value !== '') {
                    $.ajax({
                        type: "POST",
                        url: base_url + "/" + controller + "/searchbar",
                        data: {query: query_value},
                        cache: false,
                        success: function (result) {
                            var container = $("ul#search-results");
                            if (result) {
                                container.html(result);
                            }
                        }
                    });
                }
                return false;
            }

            $("input#search").on("keyup", function (e) {
                // Set Timeout
                clearTimeout($.data(this, 'timer'));

                // Set Search String
                var search_string = $(this).val();

                // Do Search
                if (search_string == '') {
                    $("ul#search-results").fadeOut();
                    $('h4#search-results-text').fadeOut();
                } else {
                    $("ul#search-results").fadeIn();
                    $('h4#search-results-text').fadeIn();
                    $(this).data('timer', setTimeout(search, 100));
                }
            });
        });
    </script>
</head>
<body>
<div class="search <?php echo ($this->uri->uri_string () != '') ? 'inner_banner' : ''?>">
    <form id="search-form">
        <input type="search" id="search" autocomplete="off" placeholder="Start Type Here" />
        <ul id="search-results"></ul>
    </form>
</div>
</body>
</html>