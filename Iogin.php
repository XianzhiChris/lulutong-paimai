<?php
/**
 * ��̨��½
 *
 * @version        $Id: login.php 1 8:48 2010��7��13��Z tianya $
 * @package        DedeCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(DEDEINC.'/userlogin.class.php');
if(empty($dopost)) $dopost = '';

//��ⰲװĿ¼��ȫ��
if( is_dir(dirname(__FILE__).'/../install') )
{
    if(!file_exists(dirname(__FILE__).'/../install/install_lock.txt') )
    {
      $fp = fopen(dirname(__FILE__).'/../install/install_lock.txt', 'w') or die('��װĿ¼��д��Ȩ�ޣ��޷�����д�������ļ����밲װ���ɾ����װĿ¼��');
      fwrite($fp,'ok');
      fclose($fp);
    }
    //Ϊ�˷�ֹδ֪��ȫ�����⣬ǿ�ƽ��ð�װ������ļ�
    if( file_exists("../install/index.php") ) {
        @rename("../install/index.php", "../install/index.php.bak");
    }
    if( file_exists("../install/module-install.php") ) {
        @rename("../install/module-install.php", "../install/module-install.php.bak");
    }
	$fileindex = "../install/index.html";
	if( !file_exists($fileindex) ) {
		$fp = @fopen($fileindex,'w');
		fwrite($fp,'dir');
		fclose($fp);
	}
}
�� Դ �� �� �� �� ߣ��www.SuibianLu.com���� �� ��  �� �� ��

�� Դ �� Ϊ �� �� �� ���� �� �� �� �� ƭ ����������������