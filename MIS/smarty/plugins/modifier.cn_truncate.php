<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string or inserting $etc into the middle.
 * @link     http://www.hbcms.com/
 * @author   http://www.hbcms.com/
 * @param string
 * @param integer
 * @param string
 * @param boolean $keep_first_style 是否保留第一个style
 * @return string

 * $keep_first_style 理解范例：

$s = '<A HREF="http://www.hbcms.com/"><FONT COLOR="red"><U><B>宏博<U>内容</U>管<B>理</B>系 &nbsp;统&nbsp;
<P>
<FONT SIZE="2" COLOR="blue">HBCMS</FONT> 是一个可以免费使用的内容管理系统，您甚至可以用<A HREF="http://www.hbcms.com/">她来做商业网站</A>。点这里查看详细版权说明

<BR>&nbsp;<BR>
是否有错误
<HR>
已知bug，截取：<FONT SIZE="2" COLOR="blue">乌木乌木乌<U>木乌木</U>乌木乌木乌木乌木乌木</font>有异常
<P>
希望大家改善</B></U></FONT></A>';
echo $s . '<hr><HR><HR>smarty_modifier_cn_truncate:<HR>';
echo smarty_modifier_cn_truncate($s,30,'。。。',1);
exit();
 */

function smarty_modifier_cn_truncate($string, $strlen = 20, $etc = '...',
                                  $keep_first_style = false)
{
    $strlen = $strlen*2;
    $string = trim($string);
    if ( strlen($string) <= $strlen )    {
        return $string;
    }
    $str = strip_tags($string);
    $j = 0;
    for($i=0;$i<$strlen;$i++) {
      if(ord(substr($str,$i,1))>0xa0) $j++; 
    }
    if($j%2!=0) $strlen++; 
    $rstr=substr($str,0,$strlen);
    if (strlen($str)>$strlen  ) {$rstr .= $etc;} 

    if ( $keep_first_style == true && ereg('^<(.*)>$',$string) )    {
        if ( strlen($str) <= $strlen )    {
            return $string;
        }
        $start_pos = strpos($string,substr($str,0,4));
        $end_pos = strpos($string,substr($str,-4));
        $end_pos = $end_pos+4;
        $rstr = substr($string,0,$start_pos) . $rstr . substr($string,$end_pos,strlen($string));
    }

    return $rstr; 

}

/* vim: set expandtab: */

?>