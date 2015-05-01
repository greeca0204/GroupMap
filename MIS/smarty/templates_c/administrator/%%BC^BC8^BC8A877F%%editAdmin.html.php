<?php /* Smarty version 2.6.18, created on 2014-05-23 07:57:25
         compiled from editAdmin.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form name="fmEdit" id="fmEdit" method="post" action="admin.php?action=save" enctype="multipart/form-data">
	<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['admin']['id']; ?>
" />
	<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
		<tr>
			<td width="10%">管理员名称：</td>
			<td>
				<input name="username" id="username" value="<?php echo $this->_tpl_vars['admin']['username']; ?>
"  class="frminput" />
			</td>
		</tr>
		<tr>
			<td width="10%">密码：</td>
			<td>
				<input name="password" id="password" value="<?php echo $this->_tpl_vars['admin']['pwd']; ?>
" class="frminput"/>
			</td>
		</tr>
		<tr>
			<td width="10%">审核：</td>
			<td class="sel">
				<select name="checked" id="checked">
      				<option value="1" <?php if ($this->_tpl_vars['admin']['checked'] == 1): ?> selected="selected" <?php endif; ?>>已审核</option>
      				<option value="2" <?php if ($this->_tpl_vars['admin']['checked'] == 2): ?> selected="selected" <?php endif; ?>>未审核</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="提交">
				<input type="reset" value="重置">
			</td>
		</tr>
	</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>