/*  Copyright 2016 Advanced Machines US, LLC.

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/*
    This snippit should be put in wp-config.php
    The purpose of it is to detect cloudfront as the user agent, 
    and if it is, set the appropriate public domain name.
    Please note that you want the backend server (the origin for the cdn)
    to have a different domain name than the public one and have that 
    set in wordpress.
*/


//  Am I being hit from AWS Cloudfront? //

if ($_SERVER['HTTP_USER_AGENT'] == 'Amazon CloudFront') {
        $_SERVER['HTTP_HOST'] = 'your-public-facing-domain.com;        // set to public domain
        $_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST'];
        define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
        define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST']);
        // $_SERVER['REQUEST_URI'] = str_replace('wordpress', 'home', $_SERVER['REQUEST_URI']);         // we don't need this right now

        // This is optional
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {          //  Might as well get the real client IP while we are at it.
                $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
}
