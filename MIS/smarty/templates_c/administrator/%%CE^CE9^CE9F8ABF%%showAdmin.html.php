<?php /* Smarty version 2.6.18, created on 2014-05-23 07:57:26
         compiled from showAdmin.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form name="fmEdit" id="fmEdit" action="admin.php?action=delete" method="post">
	<table border="0" cellpadding="0" cellspacing="0" align="center" id="tb" width="100%">
		<tr>
			<td align="center" valign="middle" width="50%">管理员</td>
			<td align="center" valign="middle" width="20%">审核状态</td>
			<td align="center" valign="middle" width="10%">管理</td>
			<td align="center" valign="middle" width="20%">删除</td>
		</tr>
		<?php $_from = $this->_tpl_vars['admin']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['admin'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['admin']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['admin']):
        $this->_foreach['admin']['iteration']++;
?>
		<tr>
			<td align="center" valign="middle" width="50%"><?php echo $this->_tpl_vars['admin']['username']; ?>
</td>
			<td align="center" valign="middle" width="20%">
			<?php if ($this->_tpl_vars['admin']['checked'] == 1): ?>已审核
			<?php else: ?>未审核<?php endif; ?>
			</td>
   			<td align="center" valign="middle" width="10%">
            	<a href='admin.php?action=new&id=<?php echo $this->_tpl_vars['admin']['id']; ?>
'>修改</a>
			</td>
			<td align="center" valign="middle" class="checkbox" width="20%">
				<input type="checkbox" name="chk1[]" id="chk1" value="<?php echo $this->_tpl_vars['admin']['id']; ?>
" />
			</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr>
			<td align="center" valign="middle" colspan="3">
				<input type="submit" name="Submit" value="删除" />
			</td>
			<td align="center" valign="middle" class="checkbox" width="20%">
				全选/全不选<input type="checkbox" name="chk2" id="chk2" />
			</td>
		</tr>
		<tr>
			<td valign="middle" colspan="4"><?php echo $this->_tpl_vars['paggingbar']; ?>
</td>
		</tr>  
	</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>