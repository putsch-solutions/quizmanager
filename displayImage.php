<?php

/*
 * Program: Quizzmanager
 * File: DisplayImage.php
 * Author: Sami Metoui samimetoui@gmail.com,
 * Description: display jpg image
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

$image = $_GET['image'];
header("Content-type: image/jpg");
//header('Content-transfer-encoding: binary');
//imagejpeg($image);
echo $image;
