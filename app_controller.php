<?php
/**
* @version        $Id: app_controller.php v1.0 13.12.2009 10:53:28 CET $
* @package        Эrgolang
* @copyright    Copyright (C) 2009 - 2013 Open Source Matters. All rights reserved.
* @license        GNU/GPL, see LICENSE.php
* Эrgolang is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
class AppController extends Controller {
// controller file
var $helpers = array('Html', 'Form', 'Javascript', 'Ajax', 'Session', 'Text');

#useful functions to trim before sending
	function whitespace(&$value, &$key){
		$key = trim($key);
		$value = trim($value);
	}


 function beforeFilter() {
		if(!empty($this->data))
		array_walk_recursive($this->data, array($this, 'whitespace'));

	 setlocale(LC_TIME,array('fr_CH.UTF-8', 'fr_CH', 'fr_FR.UTF-8', 'fr_FR'));

	 $this->Auth->authError="Vous ne pouvez pas accéder à cet espace sans être enregistré";
	 $this->Auth->loginError="Login / mot de passe incorrect";
}

     

	function view() {
	    $this->render('layout file', 'ajax');
	}


}

#######

#class to compute unique random numbers, to move in an external file eg inc.classes.php
class UniqueRand{
  var $alreadyExists = array();

  function uRand($min = NULL, $max = NULL){
    $break='false';
    while($break=='false'){
      $rand=mt_rand($min,$max);

      if(array_search($rand,$this->alreadyExists)===false){
        $this->alreadyExists[]=$rand;
        $break='stop';
      }else{
        #echo " $rand already!  ";
        #print_r($this->alreadyExists);
      }
    }
    return $rand;
  }
}

#### radeff ###
function datetime2fr($ladate) {
	$ladate=explode(" ",$ladate);
	$ladate=$ladate[0];
	$ladate=explode("-",$ladate);
	$ladate=$ladate[2]."-".$ladate[1]."-".$ladate[0];
	return $ladate;
}


function eject_non_admin() {
	if($_SESSION['Auth']['User']['role']!="administrator") { 	//non admin eject
	#if($session->read('Auth.User.role')!="Administrator") { 	//non admin eject

		/*$this->Session->setFlash(__('Action not allowed!', true));*/
		echo "<h1>Action not allowed!</h1>";
		exit;
	}


function generate_password($length){
     // A List of vowels and vowel sounds that we can insert in
     // the password string
     $vowels = array("a",  "e",  "i",  "o",  "u",  "ae",  "ou",  "io",  
                     "ea",  "ou",  "ia",  "ai"); 
     // A List of Consonants and Consonant sounds that we can insert
     // into the password string
     $consonants = array("b",  "c",  "d",  "g",  "h",  "j",  "k",  "l",  "m",
                         "n",  "p",  "r",  "s",  "t",  "u",  "v",  "w",  
                         "tr",  "cr",  "fr",  "dr",  "wr",  "pr",  "th",
                         "ch",  "ph",  "st",  "sl",  "cl");
     // For the call to rand(), saves a call to the count() function
     // on each iteration of the for loop
     $vowel_count = count($vowels);
     $consonant_count = count($consonants);
     // From $i .. $length, fill the string with alternating consonant
     // vowel pairs.
     for ($i = 0; $i < $length; ++$i) {
         $pass .= $consonants[rand(0,  $consonant_count - 1)] .
                  $vowels[rand(0,  $vowel_count - 1)];
     }
     
     // Since some of our consonants and vowels are more than one
     // character, our string can be longer than $length, use substr()
     // to truncate the string
     return substr($pass,  0,  $length);
	}
#end main class
}
#########################################


#see other http://zhugo.co.cc/2009/12/dumpexport-mysql-database-with-php-then-zip-it/
#echo CHEMIN; exit;
/* $Id: zip.lib.php,v 1.6 2002/03/30 08:24:04 loic1 Exp $ */

/**
 * Zip file creation class.
 * Makes zip files.
 *
 * Based on :
 *
 *  http://www.zend.com/codex.php?id=535&single=1
 *  By Eric Mueller <eric@themepark.com>
 *
 *  http://www.zend.com/codex.php?id=470&single=1
 *  by Denis125 <webmaster@atlant.ru>
 *
 *  a patch from Peter Listiak <mlady@users.sourceforge.net> for last modified
 *  date and time of the compressed file
 *
 * Official ZIP file format: http://www.pkware.com/appnote.txt
 *
 * @access  public
 */
class zipfile
{
    /**
     * Array to store compressed data
     *
     * @var  array    $datasec
     */
    var $datasec      = array();

    /**
     * Central directory
     *
     * @var  array    $ctrl_dir
     */
    var $ctrl_dir     = array();

    /**
     * End of central directory record
     *
     * @var  string   $eof_ctrl_dir
     */
    var $eof_ctrl_dir = "\x50\x4b\x05\x06\x00\x00\x00\x00";

    /**
     * Last offset position
     *
     * @var  integer  $old_offset
     */
    var $old_offset   = 0;


    /**
     * Converts an Unix timestamp to a four byte DOS date and time format (date
     * in high two bytes, time in low two bytes allowing magnitude comparison).
     *
     * @param  integer  the current Unix timestamp
     *
     * @return integer  the current date in a four byte DOS format
     *
     * @access private
     */
    function unix2DosTime($unixtime = 0) {
        $timearray = ($unixtime == 0) ? getdate() : getdate($unixtime);

        if ($timearray['year'] < 1980) {
        	$timearray['year']    = 1980;
        	$timearray['mon']     = 1;
        	$timearray['mday']    = 1;
        	$timearray['hours']   = 0;
        	$timearray['minutes'] = 0;
        	$timearray['seconds'] = 0;
        } // end if

        return (($timearray['year'] - 1980) << 25) | ($timearray['mon'] << 21) | ($timearray['mday'] << 16) |
                ($timearray['hours'] << 11) | ($timearray['minutes'] << 5) | ($timearray['seconds'] >> 1);
    } // end of the 'unix2DosTime()' method


    /**
     * Adds "file" to archive
     *
     * @param  string   file contents
     * @param  string   name of the file in the archive (may contains the path)
     * @param  integer  the current timestamp
     *
     * @access public
     */
    function addFile($data, $name, $time = 0)
    {
        $name     = str_replace('\\', '/', $name);

        $dtime    = dechex($this->unix2DosTime($time));
        $hexdtime = '\x' . $dtime[6] . $dtime[7]
                  . '\x' . $dtime[4] . $dtime[5]
                  . '\x' . $dtime[2] . $dtime[3]
                  . '\x' . $dtime[0] . $dtime[1];
        eval('$hexdtime = "' . $hexdtime . '";');

        $fr   = "\x50\x4b\x03\x04";
        $fr   .= "\x14\x00";            // ver needed to extract
        $fr   .= "\x00\x00";            // gen purpose bit flag
        $fr   .= "\x08\x00";            // compression method
        $fr   .= $hexdtime;             // last mod time and date

        // "local file header" segment
        $unc_len = strlen($data);
        $crc     = crc32($data);
        $zdata   = gzcompress($data);
        $zdata   = substr(substr($zdata, 0, strlen($zdata) - 4), 2); // fix crc bug
        $c_len   = strlen($zdata);
        $fr      .= pack('V', $crc);             // crc32
        $fr      .= pack('V', $c_len);           // compressed filesize
        $fr      .= pack('V', $unc_len);         // uncompressed filesize
        $fr      .= pack('v', strlen($name));    // length of filename
        $fr      .= pack('v', 0);                // extra field length
        $fr      .= $name;

        // "file data" segment
        $fr .= $zdata;

        // "data descriptor" segment (optional but necessary if archive is not
        // served as file)
        $fr .= pack('V', $crc);                 // crc32
        $fr .= pack('V', $c_len);               // compressed filesize
        $fr .= pack('V', $unc_len);             // uncompressed filesize

        // add this entry to array
        $this -> datasec[] = $fr;
        $new_offset        = strlen(implode('', $this->datasec));

        // now add to central directory record
        $cdrec = "\x50\x4b\x01\x02";
        $cdrec .= "\x00\x00";                // version made by
        $cdrec .= "\x14\x00";                // version needed to extract
        $cdrec .= "\x00\x00";                // gen purpose bit flag
        $cdrec .= "\x08\x00";                // compression method
        $cdrec .= $hexdtime;                 // last mod time & date
        $cdrec .= pack('V', $crc);           // crc32
        $cdrec .= pack('V', $c_len);         // compressed filesize
        $cdrec .= pack('V', $unc_len);       // uncompressed filesize
        $cdrec .= pack('v', strlen($name) ); // length of filename
        $cdrec .= pack('v', 0 );             // extra field length
        $cdrec .= pack('v', 0 );             // file comment length
        $cdrec .= pack('v', 0 );             // disk number start
        $cdrec .= pack('v', 0 );             // internal file attributes
        $cdrec .= pack('V', 32 );            // external file attributes - 'archive' bit set

        $cdrec .= pack('V', $this -> old_offset ); // relative offset of local header
        $this -> old_offset = $new_offset;

        $cdrec .= $name;

        // optional extra field, file comment goes here
        // save to central directory
        $this -> ctrl_dir[] = $cdrec;
    } // end of the 'addFile()' method


    /**
     * Dumps out file
     *
     * @return  string  the zipped file
     *
     * @access public
     */
    function file()
    {
        $data    = implode('', $this -> datasec);
        $ctrldir = implode('', $this -> ctrl_dir);

        return
            $data .
            $ctrldir .
            $this -> eof_ctrl_dir .
            pack('v', sizeof($this -> ctrl_dir)) .  // total # of entries "on this disk"
            pack('v', sizeof($this -> ctrl_dir)) .  // total # of entries overall
            pack('V', strlen($ctrldir)) .           // size of central dir
            pack('V', strlen($data)) .              // offset to start of central dir
            "\x00\x00";                             // .zip file comment length
    } // end of the 'file()' method

} // end of the 'zipfile' class


function urlise($chaine) { //a function to extract urls from pages
	#echo "test urlize: <br>" .$chaine ."<hr>";
	#$chaine=ereg_replace("(http://)(([[:punct:]]|[[:alnum:]]=?)*)","<a href=\"\\0\">\\0</a>",$chaine);
	$chaine = preg_replace("/(https:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a href=\"\\0\">\\0</a>",$chaine);
	$chaine=preg_replace("/(http:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a href=\"\\0\">\\0</a>",$chaine);
	//now replace emails
	if(!preg_match("/[a-zA-Z0-9]*\.[a-zA-Z0-9]*@/",$chaine)){
	#$chaine = ereg_replace('[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~]+@([.]?[a-zA-Z0-9_/-])*','<a href="mailto:\\0">\\0</a>',$chaine);
	#$chaine = preg_replace('/[-a-zA-Z0-9!#$%&\'*+/=?^_`{|}~]+@([.]?[a-zA-Z0-9_\/-])*/','<a href="mailto:\\0">\\0</a>',$chaine);
	}else {
	$chaine = preg_replace('/[-a-zA-Z0-9]*\.[-a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~]+@([.]?[a-zA-Z0-9_\/-])*/','<a href="mailto:\\0">\\0</a>',$chaine);	
	}

	echo nl2br($chaine);
}

function testsql($sql) {
		if(!$sql) {
		echo "SQL error:<br>" .$sql ."<br>" .mysql_error() ."<hr>"; 
	}
	
}
?>
