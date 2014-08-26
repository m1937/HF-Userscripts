<?php

error_reporting(E_ERROR);

/**
 *      Bootstrap Listr
 *
 *       Author:    Jan T. Sott
 *         Info:    http://github.com/idleberg/Bootstrap-Listr
 *      License:    Creative Commons Attribution-ShareAlike 3.0
 *
 *      Credits:    Greg Johnson - PHPDL lite (http://greg-j.com/phpdl/)
 *                  Na Wong - Listr (http://nadesign.net/listr/)
 *                  Joe McCullough - Stupid Table Plugin (http://joequery.github.io/Stupid-Table-Plugin/)
 */


/*** SETTINGS ***/

/* Table Styles (can be combined, e.g. 'table-hover table-striped')
 *     'table-hover' - enable a hover state on table rows (default)
 *   'table-striped' - add zebra-striping 
 *  'table-bordered' - show borders on all sides of the table and cells
 * 'table-condensed' - make tables more compact by cutting cell padding in half
 */
define('TABLE_STYLE', 'table-hover');

/* Responsive Table
 * See http://getbootstrap.com/css/#tables-responsive for details
 */
define('RESPONSIVE_TABLE', true);

// Toggle column sorting
define('ENABLE_SORT', true);

// Toggle media viewer
define('ENABLE_VIEWER', false);

/* Size of modal used for media viewer (pixel widths refer to standard theme)
 * 'modal-sm' - 300px
 *         '' - 600px
 * 'modal-lg' - 900px (default)
 */
define('MODAL_SIZE', 'modal-lg');

/* Document Icons:
 *         'none' - No icons
 *   'glyphicons' - Bootstrap glyphicons (default)
 *  'fontawesome' - Font Awesome icons
 *     'fa-files' - Font Awesome file icons
 */
define('DOC_ICONS', 'glyphicons');

/* Bootstrap Themes:
 *    'default' - http://getbootstrap.com
 * 
 *     'amelia' - http://bootswatch.com/amelia/
 *   'cerulean' - http://bootswatch.com/cerulean/
 *      'cosmo' - http://bootswatch.com/cosmo/
 *     'cyborg' - http://bootswatch.com/cyborg/
 *     'darkly' - http://bootswatch.com/darkly/
 *     'flatly' - http://bootswatch.com/flatly/
 *    'journal' - http://bootswatch.com/journal/
 *      'lumen' - http://bootswatch.com/lumen/
 *      'paper' - http://bootswatch.com/paper/ (release pending)
 *   'readable' - http://bootswatch.com/readable/
 *  'sandpaper' - http://bootswatch.com/sandpaper/ (release pending)
 *    'simplex' - http://bootswatch.com/simplex/
 *      'slate' - http://bootswatch.com/slate/
 *   'spacelab' - http://bootswatch.com/spacelab/
 *  'superhero' - http://bootswatch.com/superhero/
 *     'united' - http://bootswatch.com/united/
 *       'yeti' - http://bootswatch.com/yeti/
 *
 *    'm8tro-*' - replace * with aqua, blue, brown, green, orange, purple, red, yellow
 */
define('BOOTSTRAP_THEME', 'default');

/* Font Awesome Styles (can be combined, e.g. 'fa-lg fa-border'):
 *      'fa-fw' – fixed width (default)
 *      'fa-lg' – 33% increase
 *      'fa-2x' – 2x size
 *      'fa-3x' – 3x size
 *      'fa-4x' – 4x size
 *      'fa-5x' – 5x size
 *  'fa-border' – display border around icon
 *
 * Visit http://fontawesome.io/examples/ for further options
 */
define('FONTAWESOME_STYLE','fa-fw');

// External resources
   define('FONT_AWESOME', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
     define('CUSTOM_THEME', null);
    define('GOOGLE_FONT', null); // e.g. 'Open+Sans' or 'Open+Sans:400,300',700'
         define('JQUERY', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');
    define('BOOTSTRAPJS', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js');

// Browser and Device Icons
          define('FAV_ICON', ''); // 16x16 or 32x32 
       define('IPHONE_ICON', ''); // 57x57
define('IPHONE_ICON_RETINA', ''); // 114x114
         define('IPAD_ICON', ''); // 72x72
  define('IPAD_ICON_RETINA', ''); // 144x144
  define('METRO_TILE_COLOR', ''); //
  define('METRO_TILE_IMAGE', ''); // 144x144

  // OpenGraph Tags - http://ogp.me/
          define('OG_TITLE', '');
    define('OG_DESCRIPTION', '');
      define('OG_SITE_NAME', '');
         define('OG_LOCALE', '');
           define('OG_TYPE', '');
          define('OG_IMAGE', ''); 

// Display link to Bootstrap-Listr in footer
define('GIVE_KUDOS', true);

// Google Analytics ID
define('ANALYTICS_ID', ''); // UA-XXXXX-Y or UA-XXXXX-YY

// Configure optional table columns
$table_options = array (
    'size'    => true,
    'age'    => true
);

// Set sorting properties.
$sort = array(
    array('key'=>'lname',    'sort'=>'asc'), // ... this sets the initial sort "column" and order ...
    array('key'=>'size',    'sort'=>'asc') // ... for items with the same initial sort value, sort this way.
);

// Files you want to hide form the listing
$ignore_list = array(
    '.DAV',
    '.DS_Store',
    '.bzr',
    '.bzrignore',
    '.bzrtags',
    '.git',
    '.gitattributes',
    '.gitignore',
    '.gitmodules',
    '.hg',
    '.hgignore',
    '.hgtags',
    '.htaccess',
    '.htpasswd',
    '.jshintrc',
    '.npmignore',
    '.Spotlight-V100',
    '.svn',
    '__MACOSX',
    'ehthumbs.db',
    'robots.txt',
    'Thumbs.db'
);

// Hide file extension?
define('HIDE_EXTENSION', false);

/*** HTTP Header ***/
header("Content-Type: text/html; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate");


/*** DIRECTORY LOGIC ***/

// Get this folder and files name.

if (isset($_SERVER['HTTPS'])) {
    $this_protocol = "https://";
} else {
    $this_protocol = "http://";
}

$this_script = basename(__FILE__);
$this_folder = str_replace('/'.$this_script, '', $_SERVER['SCRIPT_NAME']);

$this_domain = $_SERVER['HTTP_HOST'];
$dir_name = explode("/", $this_folder);
    
// Declare vars used beyond this point.
$file_list = array();
$folder_list = array();
$total_size = 0;

if (DOC_ICONS == "glyphicons") { 
    $icon_tag = 'span';
} else if (DOC_ICONS == "fontawesome" || DOC_ICONS == "fa-files") { 
    $icon_tag = 'i';
}

if (DOC_ICONS == 'fontawesome') {
    $filetype = array(
        'archive'   => array('7z','ace','adf','air','apk','arj','bz2','bzip','cab','d64','dmg','git','hdf','ipf','iso','fdi','gz','jar','lha','lzh','lz','lzma','pak','phar','pkg','pimp','rar','safariextz','sfx','sit','sitx','sqx','sublime-package','swm','tar','tgz','wim','wsz','xar','zip'),
        'apple'     => array('app','ipa','ipsw','saver'),
        'audio'     => array('aac','ac3','aif','aiff','au','caf','flac','it','m4a','m4p','med','mid','mo3','mod','mp1','mp2','mp3','mpc','ned','ra','ram','oga','ogg','oma','s3m','sid','umx','wav','webma','wv','xm'),
        'calendar'  => array('icbu','ics'),
        'config'    => array('cfg','conf','ini','htaccess','htpasswd','plist','sublime-settings','xpy'),
        'contact'   => array('abbu','contact','oab','pab','vcard','vcf'),
        'database'  => array('bde','crp','db','db2','db3','dbb','dbf','dbk','dbs','dbx','edb','fdb','frm','fw','fw2','fw3','gdb','itdb','mdb','ndb','nsf','rdb','sas7mdb','sql','sqlite','tdb','wdb'),
        'doc'       => array('abw','doc','docm','docs','docx','dot','key','numbers','odb','odf','odg','odp','odt','ods','otg','otp','ots','ott','pages','pdf','pot','ppt','pptx','sdb','sdc','sdd','sdw','sxi','wp','wp4','wp5','wp6','wp7','wpd','xls','xlsx','xps'),
        'downloads' => array('!bt','!qb','!ut','crdownload','download','opdownload','part'),
        'ebook'     => array('aeh','azw','ceb','chm','epub','fb2','ibooks','kf8','lit','lrf','lrx','mobi','pdb','pdg','prc','xeb'),
        'email'     => array('eml','emlx','mbox','msg','pst'),
        'feed'      => array('atom','rss'),
        'font'      => array('eot','fon','otf','pfm','ttf','woff'),
        'image'     => array('ai','bmp','cdr','emf','eps','gif','icns','ico','jp2','jpe','jpeg','jpg','jpx','pcx','pict','png','psd','psp','svg','tga','tif','tiff','webp','wmf'),
        'link'      => array('lnk','url','webloc'),
        'linux'     => array('bin','deb','rpm'),
        'palette'   => array('ase','clm','clr','gpl'),
        'raw'       => array('3fr','ari','arw','bay','cap','cr2','crw','dcs','dcr','dnf','dng','eip','erf','fff','iiq','k25','kdc','mdc','mef','mof','mrw','nef','nrw','obm','orf','pef','ptx','pxn','r3d','raf','raw','rwl','rw2','rwz','sr2','srf','srw','x3f'),
        'script'    => array('ahk','as','asp','aspx','bat','c','cfm','clj','cmd','cpp','css','el','erb','g','hml','java','js','json','jsp','less','nsh','nsi','php','php3','pl','py','rb','rhtml','sass','scala','scm','scpt','scptd','scss','sh','shtml','wsh','xml','yml'),
        'text'      => array('ans','asc','ascii','csv','diz','latex','log','markdown','md','nfo','rst','rtf','tex','text','txt'),
        'video'     => array('3g2','3gp','3gp2','3gpp','asf','avi','bik','bup','divx','flv','ifo','m4v','mkv','mkv','mov','mp4','mpeg','mpg','rm','rv','ogv','qt','smk','swf','vob','webm','wmv','xvid'),
        'website'   => array('htm','html','mhtml','mht','xht','xhtml'),
        'windows'   => array('dll','exe','msi','pif','ps1','scr','sys')
    );
    $home = "<i class=\"fa fa-home fa-lg fa-fw\"></i> ";
} else if (DOC_ICONS == 'fa-files'){
    $filetype = array(
        'archive'    => array('7z','ace','adf','air','apk','arj','bz2','bzip','cab','d64','dmg','git','hdf','ipf','iso','fdi','gz','jar','lha','lzh','lz','lzma','pak','phar','pkg','pimp','rar','safariextz','sfx','sit','sitx','sqx','sublime-package','swm','tar','tgz','wim','wsz','xar','zip'),
        'audio'      => array('aac','ac3','aif','aiff','au','caf','flac','it','m4a','m4p','med','mid','mo3','mod','mp1','mp2','mp3','mpc','ned','ra','ram','oga','ogg','oma','s3m','sid','umx','wav','webma','wv','xm'),
        'excel'      => array('xls','xlsx','numbers'),
        'image'      => array('ai','bmp','cdr','emf','eps','gif','icns','ico','jp2','jpe','jpeg','jpg','jpx','pcx','pict','png','psd','psp','svg','tga','tif','tiff','webp','wmf'),
        'pdf'        => array('pdf'),
        'powerpoint' => array('pot','ppt','pptx','key'),
        'script'     => array('ahk','as','asp','aspx','bat','c','cfm','clj','cmd','cpp','css','el','erb','g','hml','java','js','json','jsp','less','nsh','nsi','php','php3','pl','py','rb','rhtml','sass','scala','scm','scpt','scptd','scss','sh','shtml','wsh','xml','yml'),
        'text'       => array('ans','asc','ascii','csv','diz','latex','log','markdown','md','nfo','rst','rtf','tex','text','txt'),
        'video'      => array('3g2','3gp','3gp2','3gpp','asf','avi','bik','bup','divx','flv','ifo','m4v','mkv','mkv','mov','mp4','mpeg','mpg','rm','rv','ogv','qt','smk','swf','vob','webm','wmv','xvid'),
        'word'       => array('doc','docm','docs','docx','dot','pages'),
    );
    $home = "<i class=\"fa fa-home fa-lg fa-fw\"></i> ";
} else {
    if (DOC_ICONS == 'glyphicons') {
        $home = "<span class=\"glyphicon glyphicon-home\"></span>";
    } else {
        $home = $this_domain;
    }    
}
if (ENABLE_VIEWER) {
    $audio_files     = array('m4a','mp3','oga','ogg','webma','wav');
    $image_files     = array('gif','ico','jpe','jpeg','jpg','png','svg','webp');
    $quicktime_files = array('3g2','3gp','3gp2','3gpp','mov','qt');
    $source_files    = array('applescript','bat','cmd','css','hml','jade','js','json','less','markdown','md','pl','py','rb','rst','sass','scss','sh','txt','xml','yml');
    $video_files     = array('mp4','m4v','ogv','webm');
}

if (CUSTOM_THEME) {
    $bootstrap_cdn = CUSTOM_THEME;
} else {
    $cdn_pre = '//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/';
    $cdn_post = '/bootstrap.min.css';
    $bootswatch = array('amelia','cerulean','cosmo','cyborg','darkly','flatly','journal','lumen','paper','readable','sandstone','simplex','slate','spacelab','superhero','united','yeti');
    $m8tro = array('m8tro-aqua','m8tro-blue','m8tro-brown','m8tro-green','m8tro-orange','m8tro-purple','m8tro-red','m8tro-yellow');

    if (in_array(BOOTSTRAP_THEME, $bootswatch)) {
        $bootstrap_cdn = '//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/'.BOOTSTRAP_THEME.'/bootstrap.min.css';
    } else if (in_array(BOOTSTRAP_THEME, $m8tro)) {
        $bootstrap_cdn = '//idleberg.github.io/m8tro-listr/'.BOOTSTRAP_THEME.'.min.css';
    } else {
        $bootstrap_cdn = '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css';
    }
}

// Count optional columns
$table_count = 0;
foreach($table_options as $value)
{
  if($value === true)
    $table_count++;
}

// Open the current directory...
if ($handle = opendir('.'))
{
    // ...start scanning through it.
    while (false !== ($file = readdir($handle)))
    {
        // Make sure we don't list this folder,file or their links.
        if ($file != "." && $file != ".." && $file != $this_script && !in_array($file, $ignore_list) && (substr($file, 0, 1) != '.'))
        {
            // Get file info.
            $info                  =    pathinfo($file);
            // Organize file info.
            $item['name']          =     $info['filename'];
            $item['lname']         =     strtolower($info['filename']);
            $item['bname']         =     $info['basename'];
            $item['lbname']        =     strtolower($info['basename']);
            if (isset($info['extension'])) {
                $item['ext']       =     $info['extension'];
                $item['lext']      =     strtolower($info['extension']);
            } else {
                if(!isset($info['extension'])) $item['ext'] = '.';
            }

            if (DOC_ICONS == 'fontawesome') {
                $folder_icon = 'fa fa-folder ' . FONTAWESOME_STYLE;
                if(in_array($item['lext'], $filetype['archive'])){
                    $item['class'] = 'fa fa-archive ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['apple'])){
                    $item['class'] = 'fa fa-apple ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['audio'])){
                    $item['class'] = 'fa fa-music ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['calendar'])){
                    $item['class'] = 'fa fa-calendar ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['config'])){
                    $item['class'] = 'fa fa-cogs ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['contact'])){
                    $item['class'] = 'fa fa-group ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['database'])){
                    $item['class'] = 'fa fa-database ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['doc'])){
                    $item['class'] = 'fa fa-file-text ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['downloads'])){
                    $item['class'] = 'fa fa-cloud-download ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['ebook'])){
                    $item['class'] = 'fa fa-book ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['email'])){
                    $item['class'] = 'fa fa-envelope ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['feed'])){
                    $item['class'] = 'fa fa-rss ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['font'])){
                    $item['class'] = 'fa fa-font ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['image'])){
                    $item['class'] = 'fa fa-picture-o ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['link'])){
                    $item['class'] = 'fa fa-link ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['linux'])){
                    $item['class'] = 'fa fa-linux ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['palette'])){
                    $item['class'] = 'fa fa-tasks ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['raw'])){
                    $item['class'] = 'fa fa-camera ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['script'])){
                    $item['class'] = 'fa fa-code ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['text'])){
                    $item['class'] = 'fa fa-file-text-o ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['video'])){
                    $item['class'] = 'fa fa-film ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['website'])){
                    $item['class'] = 'fa fa-globe ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['windows'])){
                    $item['class'] = 'fa fa-windows ' . FONTAWESOME_STYLE;
                }else{
                    $item['class'] = 'fa fa-file-o ' . FONTAWESOME_STYLE;        
                }
            } else if (DOC_ICONS == 'fa-files') {
                $folder_icon = 'fa fa-folder ' . FONTAWESOME_STYLE;
                if(in_array($item['lext'], $filetype['archive'])){
                    $item['class'] = 'fa fa-file-archive-o ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['audio'])){
                    $item['class'] = 'fa fa-file-audio-o ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['excel'])){
                    $item['class'] = 'fa fa-file-excel-o ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['image'])){
                    $item['class'] = 'fa fa-file-image-o ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['pdf'])){
                    $item['class'] = 'fa fa-file-pdf-o ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['powerpoint'])){
                    $item['class'] = 'fa fa-file-powerpoint-o ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['script'])){
                    $item['class'] = 'fa fa-file-code-o ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['text'])){
                    $item['class'] = 'fa fa-file-text-o ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['video'])){
                    $item['class'] = 'fa fa-file-video-o ' . FONTAWESOME_STYLE;
                }elseif(in_array($item['lext'], $filetype['word'])){
                    $item['class'] = 'fa fa-file-word-o ' . FONTAWESOME_STYLE;
                }else{
                    $item['class'] = 'fa fa-file-o ' . FONTAWESOME_STYLE;        
                }
            } else {
                $folder_icon   = 'glyphicon glyphicon-folder-close';
                $item['class'] = 'glyphicon glyphicon-file';
            }

            if ($table_options['size'] || $table_options['age'])
                $stat          =    stat($file); // ... slow, but faster than using filemtime() & filesize() instead.

            if ($table_options['size']) {
                $item['bytes'] =    $stat['size'];
                $item['size']  =    bytes_to_string($stat['size'], 2);
            }

            if ($table_options['age']) {
                $item['mtime'] =    $stat['mtime'];
            }
            
            // Add files to the file list...
            if(is_dir($info['basename'])){
                array_push($folder_list, $item);
            }
            // ...and folders to the folder list.
            else{
                array_push($file_list, $item);
            }
            // Clear stat() cache to free up memory (not really needed).
            clearstatcache();
            // Add this items file size to this folders total size
            $total_size += $item['bytes'];
        }
    }
    // Close the directory when finished.
    closedir($handle);
}
// Sort folder list.
if($folder_list)
    $folder_list = php_multisort($folder_list, $sort);
// Sort file list.
if($file_list)
    $file_list = php_multisort($file_list, $sort);
// Calculate the total folder size (fix: total size cannont display while there is no folder inside the directory)
if($file_list && $folder_list || $file_list)
    $total_size = bytes_to_string($total_size, 2);

$total_folders = count($folder_list);
$total_files = count($file_list);

if ($total_folders > 0){
    if ($total_folders > 1){
        $funit = 'folders';
    }else{
        $funit = 'folder';
    }
    $contained = $total_folders.' '.$funit;
}
if ($total_files > 0){
    if($total_files > 1){
        $iunit = 'files';
    }else{
        $iunit = 'file';
    }
    if (isset($contained)){
        $contained .= ' and '.$total_files.' '.$iunit;
    }else{
        $contained = $total_files.' '.$iunit;    
    }
    $contained = $contained.', '.$total_size['num'].' '.$total_size['str'].' in total';
}

/*** FUNCTIONS ***/

/**
 *    http://us.php.net/manual/en/function.array-multisort.php#83117
 */
 
function php_multisort($data,$keys)
{
    foreach ($data as $key => $row)
    {
        foreach ($keys as $k)
        {
            $cols[$k['key']][$key] = $row[$k['key']];
        }
    }
    $idkeys = array_keys($data);
    $i=0;
    $sort=null;
    foreach ($keys as $k)
    {
        if($i>0){$sort.=',';}
        $sort.='$cols['.$k['key'].']';
        if(isset($k['sort'])){$sort.=',SORT_'.strtoupper($k['sort']);}
        if(isset($k['type'])){$sort.=',SORT_'.strtoupper($k['type']);}
        $i++;
    }
    $sort .= ',$idkeys';
    $sort = 'array_multisort('.$sort.');';
    eval($sort);
    foreach($idkeys as $idkey)
    {
        $result[$idkey]=$data[$idkey];
    }
    return $result;
} 

/**
 *    @ http://us3.php.net/manual/en/function.filesize.php#84652
 */
function bytes_to_string($size, $precision = 0) {
    $sizes = array('YB', 'ZB', 'EB', 'PB', 'TB', 'GB', 'MB', 'KB', 'bytes');
    $total = count($sizes);
    while($total-- && $size > 1024) $size /= 1024;
    $return['num'] = round($size, $precision);
    $return['str'] = $sizes[$total];
    return $return;
}

/**
 *    @ http://us.php.net/manual/en/function.time.php#71342
 */
function time_ago($timestamp, $recursive = 0)
{
    $current_time = time();
    $difference = $current_time - $timestamp;
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);
    for ($val = sizeof($lengths) - 1; ($val >= 0) && (($number = $difference / $lengths[$val]) <= 1); $val--);
    if ($val < 0) $val = 0;
    $new_time = $current_time - ($difference % $lengths[$val]);
    $number = floor($number);
    if($number != 1)
    {
        $periods[$val] .= "s";
    }
    $text = sprintf("%d %s ", $number, $periods[$val]);   
    
    if (($recursive == 1) && ($val >= 1) && (($current_time - $new_time) > 0))
    {
        $text .= time_ago($new_time);
    }
    return $text;
}


/*** HTML LOGIC ***/

// Set HTML header
$header = "  <meta charset=\"utf-8\">" . PHP_EOL;
$header = $header."  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=yes\">" . PHP_EOL;
$header = $header."  <meta name=\"generator\" content=\"Bootstrap Listr\" />" . PHP_EOL;
$header = $header."  <title>Index of ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."</title>" . PHP_EOL;
if (FAV_ICON) $header = $header."  <link rel=\"shortcut icon\" href=\"".FAV_ICON."\" />" . PHP_EOL;
if (IPHONE_ICON) $header = $header."  <link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"".IPHONE_ICON."\" />" . PHP_EOL;
if (IPHONE_ICON_RETINA) $header = $header."  <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"".IPHONE_ICON_RETINA."\" />" . PHP_EOL;
if (IPAD_ICON) $header = $header."  <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"".IPAD_ICON."\" />" . PHP_EOL;
if (IPAD_ICON_RETINA) $header = $header."  <link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"".IPAD_ICON_RETINA."\" />" . PHP_EOL;
if (METRO_TILE_COLOR) $header = $header."  <meta name=\"msapplication-TileColor\" content=\"#".METRO_TILE_COLOR."\" />" . PHP_EOL;
if (METRO_TILE_IMAGE) $header = $header."  <meta name=\"msapplication-TileImage\" content=\"#".METRO_TILE_IMAGE."\" />" . PHP_EOL;
if (OG_TITLE) $header = $header."  <meta property=\"og:title\" content=\"".OG_TITLE."\" />" . PHP_EOL;
if (OG_DESCRIPTION) $header = $header."  <meta property=\"og:description\" content=\"".OG_DESCRIPTION."\" />" . PHP_EOL;
if (OG_SITE_NAME) $header = $header."  <meta property=\"og:site_name\" content=\"".OG_SITE_NAME."\" />" . PHP_EOL;
if (OG_LOCALE) $header = $header."  <meta property=\"og:locale\" content=\"".OG_LOCALE."\" />" . PHP_EOL;
if (OG_TYPE) $header = $header."  <meta property=\"og:type\" content=\"".OG_TYPE."\" />" . PHP_EOL;
if (OG_IMAGE) $header = $header."  <meta property=\"og:image\" content=\"".OG_IMAGE."\" />" . PHP_EOL;

$header = $header."  <link rel=\"stylesheet\" href=\"$bootstrap_cdn\" />" . PHP_EOL;
if (DOC_ICONS == "fontawesome" || DOC_ICONS == "fa-files") {
    $header = $header."  <link rel=\"stylesheet\" href=\"".FONT_AWESOME."\" />" . PHP_EOL;
}
$modal_css = null;
if (ENABLE_VIEWER) {
    $modal_css = ".modal img{display:block;margin:0 auto;max-width:100%}.modal video,.modal audio{width:100%}.viewer-wrapper{position:relative;padding-bottom:56.25%;height:0},.viewer-wrapper embed,.viewer-wrapper object{position:absolute;top:0;left:0;width:100%;height:100%}";
}
$header = $header."  <style type=\"text/css\">th{cursor:pointer}".$modal_css."</style>" . PHP_EOL;
if (GOOGLE_FONT) {
$header = $header."  <link href=\"//fonts.googleapis.com/css?family=".GOOGLE_FONT."\" rel=\"stylesheet\" type=\"text/css\">" . PHP_EOL;
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
   <link rel="stylesheet" href="bootstrap-responsive.min.css">
   <link rel="stylesheet" href="bootstrap.min.css">
   
   <title>Display Directory Contents</title>
   <style>
     *{
         padding:0;
         margin:0;
     }

	#container{
		padding:30px;
	}
  

   </style>

</head>
<body>

   <div id="container">
       <?php
         // opens this directory
         $myDirectory = opendir(".");

         // gets each entry
         while($entryName = readdir($myDirectory)) {
           $dirArray[] = $entryName;
         }

         // finds extention of file
         function findexts ($filename)
         {
           $filename = strtolower($filename) ;
           $exts = split("[/\\.]", $filename) ;
           $n = count($exts)-1;
           $exts = $exts[$n];
           return strtoupper($exts);
         }

         // closes directory
         closedir($myDirectory);

         //  counts elements in array
         $indexCount   = count($dirArray);

         // sorts files
         sort($dirArray);

         // print 'em
         print("<h1>Directory Contents</h1>");
         print("<table width='100%' cellspacing='10' class='table'>
                 <tr>
                   <td class='head'>Filename</td>
                   <td class='head'>Type</td>
                   <td class='head'>Size</td></tr>\n");

         // loops through the array of files and print them all
         for($index=0; $index < $indexCount; $index++) {
               if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
					if (findexts($dirArray[$index]) == strtoupper($dirArray[$index])) {
						echo "<tr><td><a href='$dirArray[$index]'>$dirArray[$index]/</a></td>"."<td> Folder </td>"."<td>".round(filesize($dirArray[$index])/1000,2)." Mb"."</td>"."</tr>\n";
					}else{
						echo "<tr><td><a href='$dirArray[$index]'>$dirArray[$index]</a></td>"."<td>".findexts($dirArray[$index])."</td>"."<td>".round(filesize($dirArray[$index])/1000,2)." Mb"."</td>"."</tr>\n";
					}
           	   }
         }
         echo "</table>\n";
       ?>
   </div>

</body>
</html>}
